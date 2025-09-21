<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Ride;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'ride', 'wallet']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhere('payment_reference', 'like', "%{$search}%")
                  ->orWhere('gateway_transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get statistics
        $stats = [
            'total_transactions' => Transaction::count(),
            'total_amount' => Transaction::where('status', 'completed')->sum('amount'),
            'total_fees' => Transaction::where('status', 'completed')->sum('fee'),
            'net_amount' => Transaction::where('status', 'completed')->sum('net_amount'),
            'pending_transactions' => Transaction::where('status', 'pending')->count(),
            'failed_transactions' => Transaction::where('status', 'failed')->count(),
            'ride_payments' => Transaction::where('type', 'ride_payment')->where('status', 'completed')->sum('amount'),
            'wallet_topups' => Transaction::where('type', 'wallet_topup')->where('status', 'completed')->sum('amount'),
            'driver_earnings' => Transaction::where('type', 'driver_earning')->where('status', 'completed')->sum('amount'),
        ];

        return view('admin.payments.index', compact('transactions', 'stats'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'ride', 'wallet', 'processedBy']);
        return view('admin.payments.show', compact('transaction'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,cancelled,refunded',
            'notes' => 'nullable|string|max:500',
        ]);

        $transaction->update([
            'status' => $request->status,
            'notes' => $request->notes,
            'processed_at' => $request->status === 'completed' ? now() : null,
            'failed_at' => $request->status === 'failed' ? now() : null,
            'processed_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Transaction status updated successfully!');
    }

    public function walletManagement(Request $request)
    {
        $query = Wallet::with(['user']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $wallets = $query->orderBy('balance', 'desc')->paginate(15);

        // Get statistics
        $stats = [
            'total_wallets' => Wallet::count(),
            'total_balance' => Wallet::sum('balance'),
            'pending_balance' => Wallet::sum('pending_balance'),
            'total_earnings' => Wallet::sum('total_earnings'),
            'total_spent' => Wallet::sum('total_spent'),
            'active_wallets' => Wallet::where('status', 'active')->count(),
            'suspended_wallets' => Wallet::where('status', 'suspended')->count(),
        ];

        return view('admin.payments.wallets', compact('wallets', 'stats'));
    }

    public function walletTransactions(Wallet $wallet, Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $page = $request->get('page', 1);
        
        $transactions = $wallet->transactions()
            ->with(['user', 'ride'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        $html = view('admin.payments.wallet-transactions', compact('transactions'))->render();

        return response()->json([
            'success' => true,
            'html' => $html,
            'total_pages' => $transactions->lastPage(),
            'current_page' => $transactions->currentPage(),
            'total_records' => $transactions->total()
        ]);
    }

    public function adjustWallet(Request $request, Wallet $wallet)
    {
        $request->validate([
            'type' => 'required|in:add,deduct',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:500',
        ]);

        try {
            $amount = $request->amount;
            $type = $request->type;
            $description = $request->description;
            $previousBalance = $wallet->balance;

            // Check for insufficient balance when deducting
            if ($type === 'deduct' && $wallet->balance < $amount) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Insufficient balance for deduction. Current balance: PKR ' . number_format($wallet->balance, 2)
                    ], 400);
                }
                return redirect()->back()->with('error', 'Insufficient balance for deduction.');
            }

            // Perform the adjustment
            if ($type === 'add') {
                $transaction = $wallet->addMoney($amount, $description);
                $message = 'Amount added to wallet successfully!';
            } else {
                $transaction = $wallet->deductMoney($amount, $description);
                $message = 'Amount deducted from wallet successfully!';
            }

            // Log the adjustment
            \Log::info('Wallet balance adjusted', [
                'wallet_id' => $wallet->id,
                'user_id' => $wallet->user_id,
                'type' => $type,
                'amount' => $amount,
                'previous_balance' => $previousBalance,
                'new_balance' => $wallet->fresh()->balance,
                'adjusted_by' => auth()->id(),
                'transaction_id' => $transaction->transaction_id ?? 'N/A'
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => [
                        'new_balance' => $wallet->fresh()->balance,
                        'previous_balance' => $previousBalance,
                        'adjustment_amount' => $amount,
                        'adjustment_type' => $type,
                        'transaction_id' => $transaction->transaction_id ?? 'N/A'
                    ]
                ]);
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('Wallet adjustment failed', [
                'error' => $e->getMessage(),
                'wallet_id' => $wallet->id,
                'user_id' => $wallet->user_id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to adjust wallet balance. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to adjust wallet balance. Please try again.');
        }
    }

    public function financialReports(Request $request)
    {
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $baseQuery = Transaction::whereBetween('created_at', [$dateFrom, $dateTo])
                               ->where('status', 'completed');

        // Revenue by type
        $revenueByType = (clone $baseQuery)->selectRaw('type, SUM(amount) as total_amount, COUNT(*) as count')
                              ->groupBy('type')
                              ->get();

        // Daily revenue
        $dailyRevenue = (clone $baseQuery)->selectRaw('DATE(created_at) as date, SUM(amount) as total_amount, COUNT(*) as count')
                             ->groupByRaw('DATE(created_at)')
                             ->orderByRaw('DATE(created_at)')
                             ->get();

        // Payment method breakdown
        $paymentMethodBreakdown = (clone $baseQuery)->selectRaw('payment_method, SUM(amount) as total_amount, COUNT(*) as count')
                                       ->groupBy('payment_method')
                                       ->get();

        // Top users by spending
        $topSpenders = (clone $baseQuery)->selectRaw('user_id, SUM(amount) as total_spent, COUNT(*) as transaction_count')
                            ->with('user')
                            ->groupBy('user_id')
                            ->orderBy('total_spent', 'desc')
                            ->limit(10)
                            ->get();

        $stats = [
            'total_revenue' => $baseQuery->sum('amount'),
            'total_transactions' => $baseQuery->count(),
            'average_transaction' => $baseQuery->avg('amount'),
            'total_fees' => $baseQuery->sum('fee'),
            'net_revenue' => $baseQuery->sum('net_amount'),
        ];

        return view('admin.payments.reports', compact(
            'revenueByType', 'dailyRevenue', 'paymentMethodBreakdown', 
            'topSpenders', 'stats', 'dateFrom', 'dateTo'
        ));
    }
}
