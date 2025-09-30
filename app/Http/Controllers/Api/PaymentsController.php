<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    public function transactions(Request $request): JsonResponse
    {
        $perPage = (int) ($request->query('per_page', 15));
        $query = Transaction::query()->with(['user:id,name,email', 'wallet:id,user_id']);

        if ($userId = $request->query('user_id')) {
            $query->where('user_id', $userId);
        }
        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }
        if ($type = $request->query('type')) {
            $query->where('type', $type);
        }

        $list = $query->orderByDesc('id')->paginate($perPage);
        return response()->json(['success' => true, 'data' => $list]);
    }

    public function show(Transaction $transaction): JsonResponse
    {
        $transaction->load(['user', 'wallet', 'ride']);
        return response()->json(['success' => true, 'data' => $transaction]);
    }

    public function adjustWallet(Request $request, Wallet $wallet): JsonResponse
    {
        $rules = [
            'amount' => 'required|numeric',
            'direction' => 'required|in:credit,debit',
            'description' => 'nullable|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        if ($request->direction === 'credit') {
            $txn = $wallet->addMoney((float) $request->amount, $request->description);
        } else {
            try {
                $txn = $wallet->deductMoney((float) $request->amount, $request->description);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
        }

        return response()->json(['success' => true, 'message' => 'Wallet adjusted', 'data' => $txn]);
    }

    public function walletTransactions(Wallet $wallet, Request $request): JsonResponse
    {
        $perPage = (int) ($request->query('per_page', 15));
        $txns = $wallet->transactions()->orderByDesc('id')->paginate($perPage);
        return response()->json(['success' => true, 'data' => $txns]);
    }

    public function financialReport(Request $request): JsonResponse
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $query = Transaction::query()->where('status', 'completed');
        if ($from) { $query->whereDate('processed_at', '>=', $from); }
        if ($to) { $query->whereDate('processed_at', '<=', $to); }

        $summary = [
            'total_amount' => (float) $query->sum('amount'),
            'total_net' => (float) $query->sum('net_amount'),
            'count' => (int) $query->count(),
            'by_type' => $query->selectRaw('type, COUNT(*) as count, SUM(net_amount) as total')
                                 ->groupBy('type')->get(),
        ];

        return response()->json(['success' => true, 'data' => $summary]);
    }
}
