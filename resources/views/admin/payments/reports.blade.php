@extends('layouts.admin')

@section('title', 'Financial Reports')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Financial Reports</h1>
            <p class="text-gray-600">Comprehensive financial analytics and insights</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Payments
            </a>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-calendar-alt text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Date Range Filter</h3>
                    <p class="text-sm text-gray-600">Select the period for financial analysis</p>
                </div>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="date_from" name="date_from" value="{{ $dateFrom->format('Y-m-d') }}">
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="date_to" name="date_to" value="{{ $dateTo->format('Y-m-d') }}">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        <i class="fas fa-filter mr-2"></i>Apply Filter
                    </button>
                    <a href="{{ route('admin.payments.reports') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-dollar-sign text-blue-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Revenue</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        PKR {{ number_format($stats['total_revenue'], 2) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-receipt text-green-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Transactions</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['total_transactions']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-list-alt text-green-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Average Transaction -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-calculator text-purple-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Average Transaction</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        PKR {{ number_format($stats['average_transaction'], 2) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-bar text-purple-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Net Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-wallet text-orange-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Net Revenue</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        PKR {{ number_format($stats['net_revenue'], 2) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-coins text-orange-500 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Revenue by Type -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-pie text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Revenue by Type</h3>
                        <p class="text-sm text-gray-600">Breakdown of revenue sources</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @if($revenueByType->count() > 0)
                    <div class="space-y-4">
                        @foreach($revenueByType as $item)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-tag text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">
                                            {{ ucwords(str_replace('_', ' ', $item->type)) }}
                                        </div>
                                        <div class="text-sm text-gray-600">{{ number_format($item->count) }} transactions</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">
                                        PKR {{ number_format($item->total_amount, 2) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-pie text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500">No revenue data available for the selected period</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Payment Method Breakdown -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-credit-card text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Payment Methods</h3>
                        <p class="text-sm text-gray-600">Revenue by payment method</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @if($paymentMethodBreakdown->count() > 0)
                    <div class="space-y-4">
                        @foreach($paymentMethodBreakdown as $item)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-wallet text-green-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">
                                            {{ ucwords(str_replace('_', ' ', $item->payment_method)) }}
                                        </div>
                                        <div class="text-sm text-gray-600">{{ number_format($item->count) }} transactions</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">
                                        PKR {{ number_format($item->total_amount, 2) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-credit-card text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500">No payment method data available for the selected period</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Daily Revenue Chart -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-chart-line text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Daily Revenue Trend</h3>
                            <p class="text-sm text-gray-600">Revenue performance over time</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    @if($dailyRevenue->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Date</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Revenue</th>
                                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Transactions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($dailyRevenue as $item)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-lg font-bold text-green-600">
                                                    PKR {{ number_format($item->total_amount, 2) }}
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-sm text-gray-600">
                                                    {{ number_format($item->count) }} transactions
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500">No daily revenue data available for the selected period</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Top Spenders -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Top Spenders</h3>
                            <p class="text-sm text-gray-600">Highest spending users</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    @if($topSpenders->count() > 0)
                        <div class="space-y-4">
                            @foreach($topSpenders as $index => $item)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-orange-600 font-bold text-sm">#{{ $index + 1 }}</span>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">
                                                {{ $item->user->name ?? 'Unknown User' }}
                                            </div>
                                            <div class="text-sm text-gray-600">
                                                {{ $item->user->email ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-green-600">
                                            PKR {{ number_format($item->total_spent, 2) }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ number_format($item->transaction_count) }} txns
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500">No spending data available for the selected period</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
