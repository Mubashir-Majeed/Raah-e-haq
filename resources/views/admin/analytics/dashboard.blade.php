@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Analytics Dashboard</h1>
            <p class="text-gray-600">Monitor system performance and user analytics</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-blue-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Users</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($totals['total_users'] ?? 0) }}
                    </div>
                    <div class="text-xs text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>{{ number_format($growth['users_growth'] ?? 0, 1) }}% from last period
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Total Rides -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-car text-green-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Rides</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($totals['total_rides'] ?? 0) }}
                    </div>
                    <div class="text-xs text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>{{ number_format($growth['rides_growth'] ?? 0, 1) }}% from last period
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-route text-green-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-dollar-sign text-purple-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Revenue</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        PKR {{ number_format($totals['total_revenue'] ?? 0, 2) }}
                    </div>
                    <div class="text-xs text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>{{ number_format($growth['revenue_growth'] ?? 0, 1) }}% from last period
                    </div>
                </div>
                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-wallet text-purple-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Active Drivers -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-id-card text-orange-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Active Drivers</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($totals['active_drivers'] ?? 0) }}
                    </div>
                    <div class="text-xs text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>{{ number_format($growth['drivers_growth'] ?? 0, 1) }}% from last period
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-check text-orange-500 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.analytics.reports') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-chart-bar text-blue-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Analytics Reports</h3>
                    <p class="text-sm text-gray-600">Detailed analytics and insights</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-users text-green-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600 transition-colors">User Analytics</h3>
                    <p class="text-sm text-gray-600">User behavior and demographics</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.rides.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-purple-200 transition-colors">
                    <i class="fas fa-car text-purple-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-purple-600 transition-colors">Ride Analytics</h3>
                    <p class="text-sm text-gray-600">Ride patterns and performance</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- User Growth Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-line text-blue-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">User Growth</h3>
                        <p class="text-sm text-gray-600">New user registrations over time</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <i class="fas fa-chart-line text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-500">User growth chart would go here</p>
                        <p class="text-sm text-gray-400">Integration with Chart.js or similar library</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-chart-bar text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Revenue Trends</h3>
                        <p class="text-sm text-gray-600">Revenue performance over time</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <i class="fas fa-chart-bar text-gray-400 text-4xl mb-2"></i>
                        <p class="text-gray-500">Revenue chart would go here</p>
                        <p class="text-sm text-gray-400">Integration with Chart.js or similar library</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                            <p class="text-sm text-gray-600">Latest user registrations</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">User {{ $i }}</div>
                                    <div class="text-xs text-gray-500">user{{ $i }}@example.com</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">{{ now()->subDays(rand(1, 30))->diffForHumans() }}</div>
                                <div class="text-xs text-green-600">Active</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Recent Rides -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-car text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Rides</h3>
                            <p class="text-sm text-gray-600">Latest ride requests</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.rides.index') }}" class="text-green-600 hover:text-green-700 text-sm font-medium">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-route text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Ride #{{ str_pad($i, 6, '0', STR_PAD_LEFT) }}</div>
                                    <div class="text-xs text-gray-500">Downtown → Airport</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500">{{ now()->subHours(rand(1, 24))->diffForHumans() }}</div>
                                <div class="text-xs text-green-600">Completed</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection