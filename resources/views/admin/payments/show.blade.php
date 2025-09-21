@extends('layouts.admin')

@section('title', 'Transaction Details')

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
            <h1 class="text-3xl font-bold text-gray-900">Transaction Details</h1>
            <p class="text-gray-600 mt-2">View transaction information and status</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payments
            </a>
        </div>
    </div>

    <!-- Transaction Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-info-circle mr-2"></i>Transaction Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Transaction ID</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <span class="font-mono text-lg font-bold text-blue-600">{{ $transaction->transaction_id }}</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="px-4 py-3">
                            @php
                                $statusColors = [
                                    'completed' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'failed' => 'bg-red-100 text-red-800',
                                    'cancelled' => 'bg-gray-100 text-gray-800',
                                    'refunded' => 'bg-blue-100 text-blue-800',
                                ];
                                $statusColor = $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                <i class="fas fa-circle mr-2 text-xs"></i>
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                {{ $transaction->getTypeLabel() }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Created At</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            {{ $transaction->created_at->format('M d, Y H:i A') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>Financial Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="text-2xl font-bold text-green-600">PKR {{ number_format($transaction->amount, 2) }}</div>
                        <div class="text-sm text-green-700 font-medium">Transaction Amount</div>
                    </div>
                    
                    @if($transaction->fee > 0)
                    <div class="text-center p-4 bg-orange-50 rounded-lg border border-orange-200">
                        <div class="text-2xl font-bold text-orange-600">PKR {{ number_format($transaction->fee, 2) }}</div>
                        <div class="text-sm text-orange-700 font-medium">Processing Fee</div>
                    </div>
                    @endif
                    
                    <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="text-2xl font-bold text-blue-600">PKR {{ number_format($transaction->net_amount, 2) }}</div>
                        <div class="text-sm text-blue-700 font-medium">Net Amount</div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-credit-card mr-2"></i>Payment Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <i class="fas fa-{{ $transaction->payment_method === 'card' ? 'credit-card' : ($transaction->payment_method === 'cash' ? 'money-bill' : 'wallet') }} mr-2"></i>
                                {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            {{ $transaction->currency }}
                        </div>
                    </div>
                    
                    @if($transaction->payment_reference)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Reference</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg font-mono">
                            {{ $transaction->payment_reference }}
                        </div>
                    </div>
                    @endif
                    
                    @if($transaction->gateway_transaction_id)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gateway Transaction ID</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg font-mono">
                            {{ $transaction->gateway_transaction_id }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Description and Notes -->
            @if($transaction->description || $transaction->notes)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-file-text mr-2"></i>Description & Notes
                </h3>
                
                <div class="space-y-4">
                    @if($transaction->description)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            {{ $transaction->description }}
                        </div>
                    </div>
                    @endif
                    
                    @if($transaction->notes)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            {{ $transaction->notes }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Status Update Form -->
            @if($transaction->status !== 'completed' && $transaction->status !== 'refunded')
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-edit mr-2"></i>Update Status
                </h3>
                
                <form method="POST" action="{{ route('admin.payments.update-status', $transaction) }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">New Status</label>
                            <select id="status" name="status" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="pending" {{ $transaction->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ $transaction->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="failed" {{ $transaction->status === 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="cancelled" {{ $transaction->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="refunded" {{ $transaction->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
                            <textarea id="notes" name="notes" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Add notes about this status change">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
                            <i class="fas fa-save mr-2"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>

        <!-- Sidebar Information -->
        <div class="space-y-6">
            <!-- User Information -->
            @if($transaction->user)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-user mr-2"></i>User Information
                </h3>
                
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">{{ substr($transaction->user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">{{ $transaction->user->name }}</div>
                        <div class="text-sm text-gray-600">{{ $transaction->user->email }}</div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Phone:</span>
                        <span class="text-sm font-medium">{{ $transaction->user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            {{ $transaction->user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($transaction->user->status) }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Ride Information -->
            @if($transaction->ride)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-car mr-2"></i>Ride Information
                </h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Ride ID:</span>
                        <span class="text-sm font-medium font-mono">{{ $transaction->ride->ride_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            {{ $transaction->ride->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($transaction->ride->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Vehicle Type:</span>
                        <span class="text-sm font-medium">{{ ucfirst($transaction->ride->vehicle_type) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Fare:</span>
                        <span class="text-sm font-medium">PKR {{ number_format($transaction->ride->total_fare, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Created:</span>
                        <span class="text-sm font-medium">{{ $transaction->ride->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('admin.rides.show', $transaction->ride) }}" 
                       class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 text-center block">
                        <i class="fas fa-eye mr-2"></i>View Ride Details
                    </a>
                </div>
            </div>
            @endif

            <!-- Wallet Information -->
            @if($transaction->wallet)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-wallet mr-2"></i>Wallet Information
                </h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Balance:</span>
                        <span class="text-sm font-medium">PKR {{ number_format($transaction->wallet->balance, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Pending:</span>
                        <span class="text-sm font-medium">PKR {{ number_format($transaction->wallet->pending_balance, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Earned:</span>
                        <span class="text-sm font-medium">PKR {{ number_format($transaction->wallet->total_earnings, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Total Spent:</span>
                        <span class="text-sm font-medium">PKR {{ number_format($transaction->wallet->total_spent, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            {{ $transaction->wallet->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($transaction->wallet->status) }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-clock mr-2"></i>Timeline
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Transaction Created</div>
                            <div class="text-xs text-gray-600">{{ $transaction->created_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    
                    @if($transaction->processed_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Transaction Processed</div>
                            <div class="text-xs text-gray-600">{{ $transaction->processed_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($transaction->failed_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Transaction Failed</div>
                            <div class="text-xs text-gray-600">{{ $transaction->failed_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($transaction->processedBy)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Processed by {{ $transaction->processedBy->name }}</div>
                            <div class="text-xs text-gray-600">{{ $transaction->processed_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
