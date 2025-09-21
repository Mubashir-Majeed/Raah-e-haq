@extends('layouts.admin')

@section('title', 'Payment Management')

@section('content')
<div class="fade-in">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Payment Management</h1>
            <p class="text-gray-600 mt-2">Monitor transactions, manage wallets, and track financial performance</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.payments.wallets') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-wallet mr-2"></i>Wallet Management
            </a>
            <a href="{{ route('admin.payments.reports') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-chart-line mr-2"></i>Financial Reports
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['total_transactions'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Transactions</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-credit-card text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-success" style="color: #058a0bee;">PKR {{ number_format($stats['total_amount'], 0) }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Revenue</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $stats['pending_transactions'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Pending</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">PKR {{ number_format($stats['driver_earnings'], 0) }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Driver Earnings</p>
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="stat-card rounded-2xl p-6 mb-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="GET" action="{{ route('admin.payments.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Transaction ID, user, reference..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="ride_payment" {{ request('type') === 'ride_payment' ? 'selected' : '' }}>Ride Payment</option>
                    <option value="wallet_topup" {{ request('type') === 'wallet_topup' ? 'selected' : '' }}>Wallet Top-up</option>
                    <option value="driver_earning" {{ request('type') === 'driver_earning' ? 'selected' : '' }}>Driver Earning</option>
                    <option value="refund" {{ request('type') === 'refund' ? 'selected' : '' }}>Refund</option>
                    <option value="commission" {{ request('type') === 'commission' ? 'selected' : '' }}>Commission</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                <select name="payment_method" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Methods</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="card" {{ request('payment_method') === 'card' ? 'selected' : '' }}>Card</option>
                    <option value="wallet" {{ request('payment_method') === 'wallet' ? 'selected' : '' }}>Wallet</option>
                    <option value="jazzcash" {{ request('payment_method') === 'jazzcash' ? 'selected' : '' }}>JazzCash</option>
                    <option value="easypaisa" {{ request('payment_method') === 'easypaisa' ? 'selected' : '' }}>EasyPaisa</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-primary" style="color: #011c72ff;">Transaction History</h2>
            <div class="text-sm text-gray-500">
                Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} transactions
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Transaction ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">User</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Type</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Amount</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Payment Method</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="font-semibold text-gray-900">{{ $transaction->transaction_id }}</div>
                                @if($transaction->ride)
                                    <div class="text-sm text-gray-500">{{ $transaction->ride->ride_id }}</div>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                @if($transaction->user)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-xs">{{ substr($transaction->user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $transaction->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $transaction->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $transaction->getTypeLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">PKR {{ number_format($transaction->amount, 0) }}</p>
                                    @if($transaction->fee > 0)
                                        <p class="text-xs text-gray-500">Fee: PKR {{ number_format($transaction->fee, 0) }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($transaction->status === 'completed') bg-green-100 text-green-800
                                    @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($transaction->status === 'failed') bg-red-100 text-red-800
                                    @elseif($transaction->status === 'cancelled') bg-gray-100 text-gray-800
                                    @else bg-blue-100 text-blue-800 @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm text-gray-900">{{ $transaction->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.payments.show', $transaction) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-credit-card text-4xl mb-4"></i>
                                <p>No transactions found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($transactions->hasPages())
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
