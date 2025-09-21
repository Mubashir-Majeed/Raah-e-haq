@extends('layouts.admin')

@section('title', 'Referral Details')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Referral Details</h1>
            <p class="text-gray-600">Detailed information about this referral</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.referrals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Referrals
            </a>
        </div>
    </div>

    <!-- Referral Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Referral Details Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-link text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Referral Information</h3>
                        <p class="text-blue-100 text-sm">Basic referral details</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Referral Code</span>
                        <span class="text-sm font-bold text-gray-900 font-mono">{{ $referral->referral_code }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Level</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Level {{ $referral->level }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($referral->status === 'completed') bg-green-100 text-green-800
                            @elseif($referral->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($referral->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($referral->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Created Date</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $referral->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    @if($referral->completed_at)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Completed Date</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $referral->completed_at->format('M d, Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Reward Information Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-gift text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Reward Information</h3>
                        <p class="text-green-100 text-sm">Referral reward details</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @if($referral->reward_amount > 0)
                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Reward Amount</span>
                        <span class="text-lg font-bold text-green-600">PKR {{ number_format($referral->reward_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Reward Type</span>
                        <span class="text-sm font-semibold text-gray-900">{{ ucwords(str_replace('_', ' ', $referral->reward_type ?? 'N/A')) }}</span>
                    </div>
                    @else
                    <div class="text-center py-4 text-gray-500">
                        <i class="fas fa-gift text-2xl mb-2"></i>
                        <p>No reward assigned</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- User Information -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Referrer Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-600 to-indigo-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Referrer</h3>
                        <p class="text-purple-100 text-sm">User who made the referral</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                        {{ substr($referral->referrer->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">{{ $referral->referrer->name }}</h4>
                        <p class="text-gray-600">{{ $referral->referrer->email }}</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">User ID</span>
                        <span class="text-sm font-semibold text-gray-900">#{{ $referral->referrer->id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($referral->referrer->status === 'active') bg-green-100 text-green-800
                            @elseif($referral->referrer->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($referral->referrer->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Joined</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $referral->referrer->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Referred User Information -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-teal-600 to-cyan-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user-plus text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Referred User</h3>
                        <p class="text-teal-100 text-sm">User who was referred</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-gradient-to-r from-teal-500 to-cyan-600 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                        {{ substr($referral->referred->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">{{ $referral->referred->name }}</h4>
                        <p class="text-gray-600">{{ $referral->referred->email }}</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">User ID</span>
                        <span class="text-sm font-semibold text-gray-900">#{{ $referral->referred->id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($referral->referred->status === 'active') bg-green-100 text-green-800
                            @elseif($referral->referred->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($referral->referred->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Joined</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $referral->referred->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rewards History -->
    @if($referral->rewards && $referral->rewards->count() > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-history text-yellow-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Rewards History</h3>
                    <p class="text-gray-600 text-sm">All rewards associated with this referral</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reward Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($referral->rewards as $reward)
                    <tr class="hover:bg-gray-50">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-tools text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Actions</h3>
                    <p class="text-gray-600 text-sm">Manage this referral</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="flex space-x-4">
                @if($referral->status === 'pending')
                <form method="POST" action="{{ route('admin.referrals.complete', $referral) }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200" 
                            onclick="return confirm('Are you sure you want to complete this referral?')">
                        <i class="fas fa-check mr-2"></i>Complete Referral
                    </button>
                </form>
                @endif

                @if($referral->status === 'pending')
                <form method="POST" action="{{ route('admin.referrals.cancel', $referral) }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200" 
                            onclick="return confirm('Are you sure you want to cancel this referral?')">
                        <i class="fas fa-times mr-2"></i>Cancel Referral
                    </button>
                </form>
                @endif

                <a href="{{ route('admin.referrals.rewards') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-gift mr-2"></i>View Rewards
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
