@extends('layouts.admin')

@section('title', 'Analytics Reports')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Analytics Reports</h1>
            <p class="text-gray-600">Comprehensive analytics and insights</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.analytics.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Analytics
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
                    <p class="text-sm text-gray-600">Select the period for analytics analysis</p>
                </div>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="date_from" name="date_from" value="{{ request('date_from', now()->startOfMonth()->format('Y-m-d')) }}">
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="date_to" name="date_to" value="{{ request('date_to', now()->endOfMonth()->format('Y-m-d')) }}">
                </div>
                <div>
                    <label for="report_type" class="block text-sm font-medium text-gray-700 mb-2">Report Type</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="report_type" name="report_type">
                        <option value="overview" {{ request('report_type') == 'overview' ? 'selected' : '' }}>Overview</option>
                        <option value="users" {{ request('report_type') == 'users' ? 'selected' : '' }}>Users</option>
                        <option value="rides" {{ request('report_type') == 'rides' ? 'selected' : '' }}>Rides</option>
                        <option value="payments" {{ request('report_type') == 'payments' ? 'selected' : '' }}>Payments</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        <i class="fas fa-filter mr-2"></i>Apply Filter
                    </button>
                    <a href="{{ route('admin.analytics.reports') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
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
                        {{ number_format($reportData['total_users'] ?? 0) }}
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
                        {{ number_format($reportData['total_rides'] ?? 0) }}
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
                        PKR {{ number_format($reportData['total_revenue'] ?? 0, 2) }}
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
                        {{ number_format($reportData['active_drivers'] ?? 0) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-check text-orange-500 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts -->
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
                        <p class="text-gray-500">Chart visualization would go here</p>
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
                        <p class="text-gray-500">Chart visualization would go here</p>
                        <p class="text-sm text-gray-400">Integration with Chart.js or similar library</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Reports -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Performing Drivers -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-trophy text-orange-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Top Performing Drivers</h3>
                        <p class="text-sm text-gray-600">Drivers with highest ratings and earnings</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-orange-600 font-bold text-sm">#{{ $i }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">Driver {{ $i }}</div>
                                    <div class="text-sm text-gray-600">4.{{ rand(5, 9) }} ⭐ • {{ rand(50, 200) }} rides</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-green-600">
                                    PKR {{ number_format(rand(5000, 25000), 2) }}
                                </div>
                                <div class="text-xs text-gray-500">This month</div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Popular Routes -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-purple-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Popular Routes</h3>
                        <p class="text-sm text-gray-600">Most frequently used pickup/dropoff locations</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @php
                        $routes = [
                            ['from' => 'Downtown Mall', 'to' => 'Airport', 'rides' => 245],
                            ['from' => 'University Campus', 'to' => 'City Center', 'rides' => 189],
                            ['from' => 'Railway Station', 'to' => 'Bus Terminal', 'rides' => 156],
                            ['from' => 'Hospital', 'to' => 'Shopping Center', 'rides' => 134],
                            ['from' => 'Residential Area', 'to' => 'Office District', 'rides' => 98]
                        ];
                    @endphp
                    @foreach($routes as $index => $route)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-purple-600 font-bold text-sm">#{{ $index + 1 }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $route['from'] }}</div>
                                    <div class="text-sm text-gray-600">→ {{ $route['to'] }}</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-purple-600">
                                    {{ number_format($route['rides']) }} rides
                                </div>
                                <div class="text-xs text-gray-500">This month</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Export Options -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-download text-indigo-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Export Reports</h3>
                    <p class="text-sm text-gray-600">Download analytics data in various formats</p>
                </div>
            </div>
            <div class="flex gap-3">
                <button onclick="exportReport('excel')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-file-excel mr-2"></i>Export Excel
                </button>
                <button onclick="exportReport('pdf')" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
                <button onclick="exportReport('csv')" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 font-medium">
                    <i class="fas fa-file-csv mr-2"></i>Export CSV
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function exportReport(format) {
    // Get current form values
    const dateFrom = document.getElementById('date_from').value;
    const dateTo = document.getElementById('date_to').value;
    const reportType = document.getElementById('report_type').value;
    
    // Build export URL
    const exportUrl = new URL('{{ route("admin.analytics.export") }}', window.location.origin);
    exportUrl.searchParams.append('format', format);
    exportUrl.searchParams.append('start_date', dateFrom);
    exportUrl.searchParams.append('end_date', dateTo);
    exportUrl.searchParams.append('type', reportType);
    
    // Show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
    button.disabled = true;
    
    // Create a temporary link to trigger download
    const link = document.createElement('a');
    link.href = exportUrl.toString();
    link.download = `analytics_${reportType}_${dateFrom}_to_${dateTo}.${format}`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    // Reset button state after a short delay
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
    }, 2000);
    
    // Show success message
    showToast('success', `Export started! Your ${format.toUpperCase()} file will download shortly.`);
}

function showToast(type, message) {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification fixed top-4 right-4 z-[10000] px-6 py-4 rounded-xl shadow-2xl transition-all duration-300 transform translate-x-full max-w-sm`;
    
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
    }, 100);
    
    // Remove after 4 seconds
    setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 4000);
}
</script>
@endsection
