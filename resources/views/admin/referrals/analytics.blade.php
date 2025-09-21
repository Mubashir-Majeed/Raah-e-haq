@extends('layouts.admin')

@section('title', 'Referral Analytics')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Referral Analytics</h1>
            <p class="text-gray-600">Comprehensive analytics and insights for the referral system</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.referrals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Referrals
            </a>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Referrals -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Referrals</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analytics['total_referrals']) }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Referrals -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analytics['completed_referrals']) }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Referrals -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analytics['pending_referrals']) }}</p>
                </div>
            </div>
        </div>

        <!-- Total Rewards Paid -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-gift text-purple-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Rewards Paid</p>
                    <p class="text-2xl font-bold text-gray-900">PKR {{ number_format($analytics['total_rewards_paid'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Cancelled Referrals -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Cancelled</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analytics['cancelled_referrals']) }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Rewards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-hourglass-half text-orange-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Rewards</p>
                    <p class="text-2xl font-bold text-gray-900">PKR {{ number_format($analytics['pending_rewards'], 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Expired Rewards -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-calendar-times text-gray-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Expired Rewards</p>
                    <p class="text-2xl font-bold text-gray-900">PKR {{ number_format($analytics['expired_rewards'], 2) }}</p>
                </div>
            </div>
        </div>

        <!-- Completion Rate -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                    <i class="fas fa-percentage text-indigo-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Completion Rate</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ $analytics['total_referrals'] > 0 ? number_format(($analytics['completed_referrals'] / $analytics['total_referrals']) * 100, 1) : 0 }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Detailed Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Monthly Referrals Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Monthly Referrals</h3>
                        <p class="text-gray-600 text-sm">Referral trends over the last 12 months</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @if($monthlyReferrals->count() > 0)
                    <div class="space-y-4">
                        @foreach($monthlyReferrals as $month)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-600">{{ \Carbon\Carbon::createFromFormat('Y-m', $month->month)->format('M Y') }}</span>
                            <div class="flex items-center">
                                <div class="w-32 bg-gray-200 rounded-full h-2 mr-3">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($month->count / $monthlyReferrals->max('count')) * 100 }}%"></div>
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ $month->count }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-chart-line text-4xl mb-4"></i>
                        <p>No referral data available for the selected period</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Referral Levels Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-sitemap text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Referral Levels</h3>
                        <p class="text-gray-600 text-sm">Distribution across referral levels</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3">1</div>
                            <span class="font-medium text-gray-900">Level 1 Referrals</span>
                        </div>
                        <span class="text-lg font-bold text-blue-600">{{ number_format($analytics['level_1_referrals']) }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white font-bold mr-3">2</div>
                            <span class="font-medium text-gray-900">Level 2 Referrals</span>
                        </div>
                        <span class="text-lg font-bold text-green-600">{{ number_format($analytics['level_2_referrals']) }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-3">3</div>
                            <span class="font-medium text-gray-900">Level 3 Referrals</span>
                        </div>
                        <span class="text-lg font-bold text-purple-600">{{ number_format($analytics['level_3_referrals']) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Referrers Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-trophy text-yellow-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Top Referrers</h3>
                    <p class="text-gray-600 text-sm">Users with the most successful referrals</p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Referrals</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($topReferrers as $index => $referrer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                @if($index < 3)
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3
                                        @if($index === 0) bg-yellow-100 text-yellow-600
                                        @elseif($index === 1) bg-gray-100 text-gray-600
                                        @else bg-orange-100 text-orange-600 @endif">
                                        <i class="fas fa-trophy text-sm"></i>
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                        <span class="text-sm font-bold text-gray-600">{{ $index + 1 }}</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    {{ substr($referrer->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $referrer->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $referrer->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $referrer->referrals_count }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($referrer->status === 'active') bg-green-100 text-green-800
                                @elseif($referrer->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($referrer->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-users text-4xl mb-4"></i>
                            <p>No referrers found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
