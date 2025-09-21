@extends('layouts.admin')

@section('title', 'Wallet Management')

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
            <h1 class="text-3xl font-bold text-gray-900">Wallet Management</h1>
            <p class="text-gray-600 mt-2">Manage user wallets, adjust balances, and monitor transactions</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payments
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-blue-600">{{ $stats['total_wallets'] }}</p>
                    <p class="text-sm text-gray-600 font-medium">Total Wallets</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-wallet text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-green-600">PKR {{ number_format($stats['total_balance'], 0) }}</p>
                    <p class="text-sm text-gray-600 font-medium">Total Balance</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-yellow-600">PKR {{ number_format($stats['pending_balance'], 0) }}</p>
                    <p class="text-sm text-gray-600 font-medium">Pending Balance</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-purple-600">PKR {{ number_format($stats['total_earnings'], 0) }}</p>
                    <p class="text-sm text-gray-600 font-medium">Total Earnings</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-line text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form method="GET" action="{{ route('admin.payments.wallets') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="User name, email..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="blocked" {{ request('status') === 'blocked' ? 'selected' : '' }}>Blocked</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Min Balance</label>
                <input type="number" name="min_balance" value="{{ request('min_balance') }}" 
                       placeholder="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Max Balance</label>
                <input type="number" name="max_balance" value="{{ request('max_balance') }}" 
                       placeholder="10000"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Wallets Table -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">User Wallets</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">User</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Balance</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Pending</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Total Earned</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Total Spent</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Last Updated</th>
                        <th class="text-left py-3 px-6 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wallets as $wallet)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                @if($wallet->user)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">{{ substr($wallet->user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $wallet->user->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $wallet->user->email }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-lg font-bold text-green-600">PKR {{ number_format($wallet->balance, 2) }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-yellow-600">PKR {{ number_format($wallet->pending_balance, 2) }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-blue-600">PKR {{ number_format($wallet->total_earnings, 2) }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-red-600">PKR {{ number_format($wallet->total_spent, 2) }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($wallet->status === 'active') bg-green-100 text-green-800
                                    @elseif($wallet->status === 'suspended') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($wallet->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-900">{{ $wallet->updated_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $wallet->updated_at->format('H:i') }}</div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openAdjustModal({{ $wallet->id }}, '{{ $wallet->user->name }}', {{ $wallet->balance }})" 
                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                        <i class="fas fa-edit mr-1"></i>Adjust
                                    </button>
                                    <button onclick="openTransactionsModal({{ $wallet->id }}, '{{ $wallet->user->name }}')" 
                                            class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm">
                                        <i class="fas fa-list mr-1"></i>Transactions
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 px-6 text-center text-gray-500">
                                <i class="fas fa-wallet text-4xl mb-4"></i>
                                <p>No wallets found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($wallets->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $wallets->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Adjust Wallet Modal -->
<div id="adjustModal" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[9999] flex items-center justify-center p-2">
    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-xs sm:max-w-sm max-h-[95vh] overflow-hidden transform transition-all duration-300 ease-out scale-95 opacity-0" id="adjustModalContent">
        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 text-white rounded-t-3xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-wallet text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold">Adjust Wallet Balance</h3>
                        <p class="text-blue-100 text-xs">Add or deduct money from wallet</p>
                    </div>
                </div>
                <button onclick="closeAdjustModal()" class="text-white hover:text-blue-200 transition-colors p-1 rounded-full hover:bg-white hover:bg-opacity-20">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        </div>
        
        <!-- Content -->
        <div class="overflow-y-auto max-h-[65vh]">
            <form id="adjustForm" method="POST" class="p-4">
                @csrf
                
                <!-- User Info Card -->
                <div class="mb-3 p-3 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-200">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-blue-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-600 mb-1">User</label>
                            <input type="text" id="adjustUser" readonly class="text-gray-900 font-bold bg-transparent border-none p-0 text-sm w-full">
                        </div>
                    </div>
                </div>
                
                <!-- Current Balance Card -->
                <div class="mb-4 p-3 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-wallet text-green-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Current Balance</label>
                                <input type="text" id="adjustCurrentBalance" readonly class="text-green-700 font-bold text-lg bg-transparent border-none p-0 w-full">
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Selection -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-exchange-alt mr-2 text-purple-600"></i>Select Action
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type" value="add" class="sr-only" onchange="updateActionStyle()">
                            <div id="addOption" class="p-3 border-2 border-gray-200 rounded-xl text-center transition-all duration-300 hover:border-green-400 hover:bg-green-50 hover:shadow-md">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-plus text-green-600 text-sm"></i>
                                </div>
                                <div class="font-bold text-gray-700 text-sm">Add Money</div>
                                <div class="text-xs text-gray-500 mt-1">Increase Balance</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type" value="deduct" class="sr-only" onchange="updateActionStyle()">
                            <div id="deductOption" class="p-3 border-2 border-gray-200 rounded-xl text-center transition-all duration-300 hover:border-red-400 hover:bg-red-50 hover:shadow-md">
                                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-minus text-red-600 text-sm"></i>
                                </div>
                                <div class="font-bold text-gray-700 text-sm">Deduct Money</div>
                                <div class="text-xs text-gray-500 mt-1">Decrease Balance</div>
                            </div>
                        </label>
                    </div>
                </div>
                
                <!-- Amount Input -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-money-bill-wave mr-2 text-yellow-600"></i>Amount (PKR)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold text-sm">PKR</span>
                        </div>
                        <input type="number" name="amount" step="0.01" min="0.01" required 
                               class="w-full pl-12 pr-3 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors font-bold text-lg"
                               placeholder="0.00" oninput="updateAmountPreview()" onkeyup="updateAmountPreview()">
                    </div>
                    <div id="amountPreview" class="mt-2 text-sm text-gray-600 hidden">
                        <span id="previewText"></span>
                    </div>
                </div>
                
                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-file-text mr-2 text-indigo-600"></i>Description
                    </label>
                    <textarea name="description" rows="3" 
                              class="w-full px-3 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none text-sm"
                              placeholder="Reason for adjustment (optional - e.g., Refund, Bonus, Penalty)"></textarea>
                </div>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="px-4 py-4 border-t border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50 rounded-b-3xl">
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeAdjustModal()" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all duration-200 font-semibold flex items-center text-sm">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                <button type="button" onclick="submitAdjustForm()" id="adjustSubmitBtn"
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-xl hover:from-blue-700 hover:to-indigo-800 transition-all duration-200 font-bold flex items-center shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed text-sm transform hover:scale-105 active:scale-95">
                    <i class="fas fa-wallet mr-2"></i>Update Balance
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Transactions Modal -->
<div id="transactionsModal" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[9999] flex items-center justify-center p-2">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl sm:max-w-3xl max-h-[95vh] flex flex-col transform transition-all duration-300 ease-out scale-95 opacity-0" id="transactionsModalContent">
        <!-- Header -->
        <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-t-2xl flex-shrink-0">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold flex items-center">
                    <i class="fas fa-list mr-3 text-lg"></i>
                    Wallet Transactions
                </h3>
                <button onclick="closeTransactionsModal()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Transactions Table -->
            <div class="flex-1 overflow-y-auto p-6 min-h-0">
                <div id="transactionsContent" class="h-full">
                    <!-- Transactions will be loaded here -->
                </div>
            </div>
            
            <!-- Pagination Controls -->
            <div id="transactionsPagination" class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex-shrink-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button id="prevPage" onclick="loadTransactionsPage(-1)" 
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                            <i class="fas fa-chevron-left mr-2"></i>Previous
                        </button>
                        <span id="pageInfo" class="text-sm text-gray-600 px-3 py-2 bg-white rounded-lg border">
                            Page 1 of 1
                        </span>
                        <button id="nextPage" onclick="loadTransactionsPage(1)" 
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                            Next<i class="fas fa-chevron-right ml-2"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-600">Show:</span>
                        <select id="perPageSelect" onchange="changePerPage()" 
                                class="px-3 py-2 border border-gray-300 rounded-lg text-sm bg-white">
                            <option value="10">10</option>
                            <option value="20" selected>20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <span class="text-sm text-gray-600">per page</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-2xl flex-shrink-0">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-info-circle mr-1"></i>
                    <span id="transactionsInfo">Loading transactions...</span>
                </p>
                <button onclick="closeTransactionsModal()" 
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-all duration-200 font-semibold flex items-center">
                    <i class="fas fa-times mr-2"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Ensure modals appear above everything */
#adjustModal, #transactionsModal {
    z-index: 9999 !important;
    position: fixed !important;
}

/* Ensure modal content is properly positioned */
#adjustModalContent, #transactionsModalContent {
    position: relative;
    z-index: 10000;
}

/* Custom scrollbar for transactions table */
#transactionsContent .overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

#transactionsContent .overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
}

#transactionsContent .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

#transactionsContent .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Ensure table header stays sticky */
#transactionsContent table thead {
    position: sticky;
    top: 0;
    z-index: 10;
    background: #f9fafb;
}

/* Smooth scrolling */
#transactionsContent .overflow-y-auto {
    scroll-behavior: smooth;
}
</style>

<script>
function openAdjustModal(walletId, userName, currentBalance) {
    console.log('Opening adjust modal for wallet:', walletId);
    
    // Set form data
    document.getElementById('adjustUser').value = userName;
    document.getElementById('adjustCurrentBalance').value = 'PKR ' + currentBalance.toLocaleString();
    document.getElementById('adjustForm').action = '{{ route("admin.payments.wallet-adjust", ":id") }}'.replace(':id', walletId);
    
    // Show modal
    const modal = document.getElementById('adjustModal');
    const modalContent = document.getElementById('adjustModalContent');
    
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    
    // Trigger animation
    setTimeout(() => {
        modalContent.style.transform = 'scale(1)';
        modalContent.style.opacity = '1';
    }, 10);
}

function closeAdjustModal() {
    console.log('Closing adjust modal');
    
    const modal = document.getElementById('adjustModal');
    const modalContent = document.getElementById('adjustModalContent');
    
    // Add closing animation
    modalContent.style.transform = 'scale(0.95)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.getElementById('adjustForm').reset();
        
        // Reset modal content styles
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
    }, 300);
}

// Global variables for pagination
let currentWalletId = null;
let currentPage = 1;
let perPage = 20;
let totalPages = 1;

function openTransactionsModal(walletId, userName) {
    console.log('Opening transactions modal for wallet:', walletId);
    
    // Set global variables
    currentWalletId = walletId;
    currentPage = 1;
    perPage = 20;
    
    // Show loading state
    document.getElementById('transactionsContent').innerHTML = `
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <i class="fas fa-spinner fa-spin text-2xl text-blue-600"></i>
            </div>
            <p class="text-gray-600 font-medium">Loading transactions...</p>
        </div>
    `;
    
    const modal = document.getElementById('transactionsModal');
    const modalContent = document.getElementById('transactionsModalContent');
    
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    
    // Trigger animation
    setTimeout(() => {
        modalContent.style.transform = 'scale(1)';
        modalContent.style.opacity = '1';
    }, 10);
    
    // Load transactions with pagination
    loadTransactionsPage(0);
}

function loadTransactionsPage(direction) {
    if (!currentWalletId) return;
    
    // Update current page
    if (direction !== 0) {
        currentPage += direction;
        if (currentPage < 1) currentPage = 1;
    }
    
    // Show loading state
    document.getElementById('transactionsContent').innerHTML = `
        <div class="text-center py-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full mb-3">
                <i class="fas fa-spinner fa-spin text-xl text-blue-600"></i>
            </div>
            <p class="text-gray-600">Loading page ${currentPage}...</p>
        </div>
    `;
    
    // Load transactions via AJAX with pagination
    fetch(`/admin/payments/wallets/${currentWalletId}/transactions?page=${currentPage}&per_page=${perPage}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('transactionsContent').innerHTML = data.html;
                totalPages = data.total_pages || 1;
                updatePaginationControls();
                
                // Update transactions info
                const totalRecords = data.total_records || 0;
                const currentPage = data.current_page || 1;
                const perPage = data.per_page || 20;
                const startRecord = (currentPage - 1) * perPage + 1;
                const endRecord = Math.min(currentPage * perPage, totalRecords);
                
                document.getElementById('transactionsInfo').textContent = 
                    `Showing ${startRecord} to ${endRecord} of ${totalRecords} transactions`;
            } else {
                document.getElementById('transactionsContent').innerHTML = `
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                            <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                        </div>
                        <p class="text-red-600 font-medium">Error loading transactions</p>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error loading transactions:', error);
            document.getElementById('transactionsContent').innerHTML = `
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                    </div>
                    <p class="text-red-600 font-medium">Error loading transactions</p>
                </div>
            `;
        });
}

function changePerPage() {
    perPage = parseInt(document.getElementById('perPageSelect').value);
    currentPage = 1;
    loadTransactionsPage(0);
}

function updatePaginationControls() {
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');
    const pageInfo = document.getElementById('pageInfo');
    
    // Update page info
    pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
    
    // Update button states
    prevButton.disabled = currentPage <= 1;
    nextButton.disabled = currentPage >= totalPages;
    
    // Update button styles
    if (prevButton.disabled) {
        prevButton.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        prevButton.classList.remove('opacity-50', 'cursor-not-allowed');
    }
    
    if (nextButton.disabled) {
        nextButton.classList.add('opacity-50', 'cursor-not-allowed');
    } else {
        nextButton.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}

// Adjust Modal Functions
function updateActionStyle() {
    const addOption = document.getElementById('addOption');
    const deductOption = document.getElementById('deductOption');
    const addRadio = document.querySelector('input[name="type"][value="add"]');
    const deductRadio = document.querySelector('input[name="type"][value="deduct"]');
    
    // Reset styles
    addOption.classList.remove('border-green-500', 'bg-green-100', 'ring-4', 'ring-green-200', 'shadow-lg');
    deductOption.classList.remove('border-red-500', 'bg-red-100', 'ring-4', 'ring-red-200', 'shadow-lg');
    
    // Apply selected styles
    if (addRadio.checked) {
        addOption.classList.add('border-green-500', 'bg-green-100', 'ring-4', 'ring-green-200', 'shadow-lg');
    } else if (deductRadio.checked) {
        deductOption.classList.add('border-red-500', 'bg-red-100', 'ring-4', 'ring-red-200', 'shadow-lg');
    }
    
    updateAmountPreview();
}

function updateAmountPreview() {
    const amount = parseFloat(document.querySelector('input[name="amount"]').value) || 0;
    const type = document.querySelector('input[name="type"]:checked')?.value;
    const currentBalance = parseFloat(document.getElementById('adjustCurrentBalance').value.replace(/[^\d.-]/g, '')) || 0;
    const preview = document.getElementById('amountPreview');
    const previewText = document.getElementById('previewText');
    
    if (amount > 0 && type) {
        let newBalance;
        let actionText;
        let actionColor;
        
        if (type === 'add') {
            newBalance = currentBalance + amount;
            actionText = 'Add';
            actionColor = 'text-green-600';
        } else {
            newBalance = currentBalance - amount;
            actionText = 'Deduct';
            actionColor = 'text-red-600';
        }
        
        previewText.innerHTML = `
            <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                <span class="${actionColor} font-bold text-sm">${actionText} PKR ${amount.toLocaleString()}</span>
                <span class="text-gray-600 text-sm">→</span>
                <span class="font-bold text-gray-900">PKR ${newBalance.toLocaleString()}</span>
            </div>
        `;
        preview.classList.remove('hidden');
        
        // Enable/disable submit button based on sufficient balance
        const submitBtn = document.getElementById('adjustSubmitBtn');
        if (type === 'deduct' && newBalance < 0) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            previewText.innerHTML = `
                <div class="flex items-center p-2 bg-red-50 border border-red-200 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                    <span class="text-red-600 font-semibold text-sm">Insufficient balance!</span>
                </div>
                <div class="text-xs text-red-500 mt-1">
                    Cannot deduct PKR ${amount.toLocaleString()} from PKR ${currentBalance.toLocaleString()}
                </div>
            `;
        } else {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    } else {
        preview.classList.add('hidden');
        const submitBtn = document.getElementById('adjustSubmitBtn');
        submitBtn.disabled = false;
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    }
}

function submitAdjustForm() {
    const form = document.getElementById('adjustForm');
    const submitBtn = document.getElementById('adjustSubmitBtn');
    const originalText = submitBtn.innerHTML;
    
    // Validate form
    const amount = parseFloat(document.querySelector('input[name="amount"]').value) || 0;
    const type = document.querySelector('input[name="type"]:checked')?.value;
    let description = document.querySelector('textarea[name="description"]').value.trim();
    
    console.log('Form validation data:', { amount, type, description });
    
    if (!type) {
        showToast('error', 'Please select an action (Add or Deduct)');
        return;
    }
    
    if (amount <= 0) {
        showToast('error', 'Please enter a valid amount');
        return;
    }
    
    if (!description) {
        // Provide a default description if none is given
        description = `${type === 'add' ? 'Add' : 'Deduct'} PKR ${amount} to wallet balance`;
        document.querySelector('textarea[name="description"]').value = description;
    }
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Processing...';
    
    // Get form data
    const formData = new FormData(form);
    const url = form.action;
    
    console.log('Submitting to:', url);
    console.log('Form data:', Object.fromEntries(formData));
    
    // Validate URL
    if (!url || url.includes(':id')) {
        showToast('error', 'Invalid wallet ID. Please refresh the page and try again.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        return;
    }
    
    // Submit via AJAX
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    console.log('CSRF Token:', csrfToken);
    
    if (!csrfToken) {
        showToast('error', 'CSRF token not found. Please refresh the page and try again.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        return;
    }
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            // Show success message
            showToast('success', data.message);
            
            // Update the current balance display
            if (data.data && data.data.new_balance) {
                document.getElementById('adjustCurrentBalance').value = 'PKR ' + data.data.new_balance.toLocaleString();
            }
            
            // Close modal
            closeAdjustModal();
            
            // Reload the page to update wallet list
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        } else {
            showToast('error', data.message || 'Operation failed');
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        console.error('Error message:', error.message);
        showToast('error', `Error: ${error.message}. Please check console for details.`);
    })
    .finally(() => {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

function closeTransactionsModal() {
    console.log('Closing transactions modal');
    
    const modal = document.getElementById('transactionsModal');
    const modalContent = document.getElementById('transactionsModalContent');
    
    // Add closing animation
    modalContent.style.transform = 'scale(0.95)';
    modalContent.style.opacity = '0';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.style.display = 'none';
        
        // Reset modal content styles
        modalContent.style.transform = 'scale(0.95)';
        modalContent.style.opacity = '0';
    }, 300);
}

// Initialize modals when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const adjustModal = document.getElementById('adjustModal');
    const transactionsModal = document.getElementById('transactionsModal');
    
    // Close modals when clicking outside
    if (adjustModal) {
        adjustModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeAdjustModal();
            }
        });
    }
    
    if (transactionsModal) {
        transactionsModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeTransactionsModal();
            }
        });
    }
    
    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!adjustModal.classList.contains('hidden')) {
                closeAdjustModal();
            }
            if (!transactionsModal.classList.contains('hidden')) {
                closeTransactionsModal();
            }
        }
    });
    
});

// Toast notification function
function showToast(type, message) {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification fixed top-4 right-4 z-[99999] px-6 py-4 rounded-xl shadow-2xl transition-all duration-300 transform translate-x-full max-w-sm`;
    toast.style.cssText = `
        position: fixed !important;
        top: 1rem !important;
        right: 1rem !important;
        z-index: 99999 !important;
        max-width: 24rem !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    `;
    
    if (type === 'success') {
        toast.classList.add('bg-gradient-to-r', 'from-green-500', 'to-green-600', 'text-white', 'border-l-4', 'border-green-400');
        toast.innerHTML = `
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="font-semibold">Success!</p>
                    <p class="text-sm opacity-90">${message}</p>
                </div>
            </div>
        `;
    } else {
        toast.classList.add('bg-gradient-to-r', 'from-red-500', 'to-red-600', 'text-white', 'border-l-4', 'border-red-400');
        toast.innerHTML = `
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="font-semibold">Error!</p>
                    <p class="text-sm opacity-90">${message}</p>
                </div>
            </div>
        `;
    }
    
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full');
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 5 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 5000);
}
</script>
@endsection
