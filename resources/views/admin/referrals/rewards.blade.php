@extends('layouts.admin')

@section('title', 'Referral Rewards')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Referral Rewards</h1>
            <p class="text-gray-600">Manage and track referral reward payments</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.referrals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Referrals
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-filter text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filters</h3>
                    <p class="text-gray-600 text-sm">Filter rewards by status, type, or user</p>
                </div>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search User</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="search" name="search" value="{{ request('search') }}" placeholder="Search by name or email">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="credited" {{ request('status') === 'credited' ? 'selected' : '' }}>Credited</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>
                <div>
                    <label for="reward_type" class="block text-sm font-medium text-gray-700 mb-2">Reward Type</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="reward_type" name="reward_type">
                        <option value="">All Types</option>
                        <option value="ride_credit" {{ request('reward_type') === 'ride_credit' ? 'selected' : '' }}>Ride Credit</option>
                        <option value="cash" {{ request('reward_type') === 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="discount" {{ request('reward_type') === 'discount' ? 'selected' : '' }}>Discount</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        <i class="fas fa-filter mr-2"></i>Apply Filter
                    </button>
                    <a href="{{ route('admin.referrals.rewards') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Rewards Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-gift text-green-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Referral Rewards</h3>
                    <p class="text-gray-600 text-sm">Manage referral reward payments and status</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Referral</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reward Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($rewards as $reward)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    {{ substr($reward->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $reward->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $reward->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($reward->referral)
                            <div class="text-sm text-gray-900">
                                <div class="font-medium">{{ $reward->referral->referral_code }}</div>
                                <div class="text-gray-500">Level {{ $reward->referral->level }}</div>
                            </div>
                            @else
                            <span class="text-gray-500 italic">N/A</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($reward->reward_type === 'ride_credit') bg-blue-100 text-blue-800
                                @elseif($reward->reward_type === 'cash') bg-green-100 text-green-800
                                @elseif($reward->reward_type === 'discount') bg-purple-100 text-purple-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucwords(str_replace('_', ' ', $reward->reward_type)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">
                                @if($reward->reward_type === 'cash')
                                    PKR {{ number_format($reward->amount, 2) }}
                                @else
                                    {{ number_format($reward->amount) }} {{ ucwords(str_replace('_', ' ', $reward->reward_type)) }}
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($reward->status === 'credited') bg-green-100 text-green-800
                                @elseif($reward->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($reward->status === 'cancelled') bg-red-100 text-red-800
                                @elseif($reward->status === 'expired') bg-gray-100 text-gray-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($reward->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $reward->created_at->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $reward->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                @if($reward->status === 'pending' && $reward->canBeCredited())
                                <form method="POST" action="{{ route('admin.referrals.credit-reward', $reward) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900 transition-colors" 
                                            onclick="return confirm('Are you sure you want to credit this reward?')">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                                @endif
                                
                                @if($reward->status === 'pending')
                                <form method="POST" action="{{ route('admin.referrals.cancel-reward', $reward) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" 
                                            onclick="return confirm('Are you sure you want to cancel this reward?')">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                                @endif
                                
                                @if($reward->referral)
                                <a href="{{ route('admin.referrals.show', $reward->referral) }}" class="text-blue-600 hover:text-blue-900 transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @else
                                <span class="text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-eye"></i>
                                </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-gift text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-lg font-medium">No rewards found</p>
                            <p class="text-sm">No referral rewards match your current filters.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($rewards->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing {{ $rewards->firstItem() }} to {{ $rewards->lastItem() }} of {{ $rewards->total() }} results
                </div>
                <div class="flex space-x-2">
                    @if($rewards->onFirstPage())
                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Previous</span>
                    @else
                    <a href="{{ $rewards->previousPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Previous</a>
                    @endif
                    
                    @if($rewards->hasMorePages())
                    <a href="{{ $rewards->nextPageUrl() }}" class="px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Next</a>
                    @else
                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Next</span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
