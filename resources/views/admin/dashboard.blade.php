@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="glass rounded-2xl p-8 fade-in" style="background: rgba(255, 255, 255, 0.25); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.18);">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-primary mb-2" style="color: #011c72ff;">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-secondary text-lg" style="color: orange;">Here's what's happening with your ride-sharing platform today.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 gradient-primary rounded-2xl flex items-center justify-center floating" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Professional Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['total_users'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Users</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-arrow-up text-success text-sm" style="color: #058a0bee;"></i>
                    <span class="text-success font-semibold" style="color: #058a0bee;">+12%</span>
                </div>
                <span class="text-sm text-gray-500">vs last month</span>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="animation-delay: 0.1s; background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 gradient-success rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #058a0bee 0%, #00c851 100%);">
                    <i class="fas fa-car text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-success">{{ $stats['total_drivers'] }}</p>
                    <p class="text-sm text-secondary font-medium">Total Drivers</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-arrow-up text-success text-sm"></i>
                    <span class="text-success font-semibold">+8%</span>
                </div>
                <span class="text-sm text-gray-500">vs last month</span>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="animation-delay: 0.2s; background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 gradient-gold rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #D4AF37 0%, #ffd700 100%);">
                    <i class="fas fa-user text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-gold">{{ $stats['total_passengers'] }}</p>
                    <p class="text-sm text-secondary font-medium">Total Passengers</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-arrow-up text-success text-sm"></i>
                    <span class="text-success font-semibold">+15%</span>
                </div>
                <span class="text-sm text-gray-500">vs last month</span>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="animation-delay: 0.3s; background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 gradient-success rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #058a0bee 0%, #00c851 100%);">
                    <i class="fas fa-check-circle text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-success">{{ $stats['active_users'] }}</p>
                    <p class="text-sm text-secondary font-medium">Active Users</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-arrow-up text-success text-sm"></i>
                    <span class="text-success font-semibold">+5%</span>
                </div>
                <span class="text-sm text-gray-500">vs last month</span>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="animation-delay: 0.4s; background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 gradient-warning rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #ce0a0aff 0%, #ff4444 100%);">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <div class="text-right">
                    <p class="text-3xl font-bold text-warning">{{ $stats['pending_users'] }}</p>
                    <p class="text-sm text-secondary font-medium">Pending Users</p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-arrow-down text-warning text-sm"></i>
                    <span class="text-warning font-semibold">-2%</span>
                </div>
                <span class="text-sm text-gray-500">vs last month</span>
            </div>
        </div>
    </div>

    <!-- Analytics and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Analytics Chart -->
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-primary">User Growth Analytics</h3>
                    <p class="text-secondary text-sm">Track your platform's growth</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.dashboard', ['period' => 7]) }}" class="px-4 py-2 text-sm rounded-xl font-medium {{ ($periodDays ?? 7) == 7 ? 'text-white' : 'text-gray-600 hover:bg-gray-100' }}" style="{{ ($periodDays ?? 7) == 7 ? 'background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);' : '' }}">7D</a>
                    <a href="{{ route('admin.dashboard', ['period' => 30]) }}" class="px-4 py-2 text-sm rounded-xl font-medium {{ ($periodDays ?? 7) == 30 ? 'text-white' : 'text-gray-600 hover:bg-gray-100' }}" style="{{ ($periodDays ?? 7) == 30 ? 'background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);' : '' }}">30D</a>
                    <a href="{{ route('admin.dashboard', ['period' => 90]) }}" class="px-4 py-2 text-sm rounded-xl font-medium {{ ($periodDays ?? 7) == 90 ? 'text-white' : 'text-gray-600 hover:bg-gray-100' }}" style="{{ ($periodDays ?? 7) == 90 ? 'background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);' : '' }}">90D</a>
                </div>
            </div>
            <div class="h-72 rounded-xl relative overflow-hidden bg-white">
                <canvas id="dashboardLineChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-right" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-primary">Recent Users</h3>
                    <p class="text-secondary text-sm">Latest platform registrations</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-primary hover:text-secondary text-sm font-semibold transition-colors">
                    View all <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recent_users as $user)
                <div class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-50 transition-all duration-200 group">
                    <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                        <span class="text-white text-sm font-bold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold text-primary">{{ $user->name }}</p>
                        <p class="text-sm text-secondary">{{ $user->email }}</p>
                    </div>
                    <div class="text-right">
                        @php
                            $status = $user->status ?? 'inactive';
                            $statusClass = $status === 'active' ? 'bg-green-100 text-green-700' : ($status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700');
                            $statusText = ucfirst($status);
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                            <i class="fas fa-circle text-[8px] mr-1"></i>
                            {{ $statusText }}
                        </span>
                        <p class="text-xs text-gray-500 mt-1">{{ optional($user->roles->first())->display_name ?? optional($user->roles->first())->name ?? 'No Role' }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-xl"></i>
                    </div>
                    <p class="text-gray-500 font-medium">No users found</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="stat-card rounded-2xl p-8 card-hover fade-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-primary mb-2">Quick Actions</h3>
            <p class="text-secondary">Manage your platform efficiently</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.users.index') }}" class="group flex flex-col items-center p-6 rounded-2xl hover:bg-gradient-to-br hover:from-primary hover:to-secondary transition-all duration-300 hover-scale">
                <div class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-primary group-hover:text-white text-lg mb-2">Manage Users</h4>
                <p class="text-sm text-secondary group-hover:text-white text-center">View and manage all platform users</p>
            </a>

            <a href="#" class="group flex flex-col items-center p-6 rounded-2xl hover:bg-gradient-to-br hover:from-success hover:to-green-600 transition-all duration-300 hover-scale">
                <div class="w-16 h-16 gradient-success rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #058a0bee 0%, #00c851 100%);">
                    <i class="fas fa-car text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-success group-hover:text-white text-lg mb-2">Ride Management</h4>
                <p class="text-sm text-secondary group-hover:text-white text-center">Monitor and manage all rides</p>
            </a>

            <a href="#" class="group flex flex-col items-center p-6 rounded-2xl hover:bg-gradient-to-br hover:from-gold hover:to-yellow-600 transition-all duration-300 hover-scale">
                <div class="w-16 h-16 gradient-gold rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform" style="background: linear-gradient(135deg, #D4AF37 0%, #ffd700 100%);">
                    <i class="fas fa-cog text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-gold group-hover:text-white text-lg mb-2">App Settings</h4>
                <p class="text-sm text-secondary group-hover:text-white text-center">Configure platform settings</p>
            </a>
        </div>
    </div>
    <!-- Extra Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
        <!-- Revenue Breakdown -->
        <div class="stat-card rounded-2xl p-6 card-hover" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-primary">Revenue vs Commission vs Driver Earnings</h3>
            </div>
            <div class="h-64 bg-white rounded-xl">
                <canvas id="revenueBarChart"></canvas>
            </div>
        </div>

        <!-- Ride Status Distribution -->
        <div class="stat-card rounded-2xl p-6 card-hover" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-primary">Ride Status Distribution</h3>
            </div>
            <div class="h-64 bg-white rounded-xl">
                <canvas id="rideStatusPie"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labels = @json($chart['labels'] ?? []);
        const revenue = @json($chart['revenue'] ?? []);
        const rides = @json($chart['rides'] ?? []);
        const newUsers = @json($chart['new_users'] ?? []);
        const commission = @json($chart['commission'] ?? []);
        const driverEarnings = @json($chart['driver_earnings'] ?? []);

        const ctx = document.getElementById('dashboardLineChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Revenue (PKR)',
                        data: revenue,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16,185,129,0.12)',
                        tension: 0.35,
                        fill: true,
                        yAxisID: 'y1'
                    },
                    {
                        label: 'Rides',
                        data: rides,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59,130,246,0.12)',
                        tension: 0.35,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'New Users',
                        data: newUsers,
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245,158,11,0.12)',
                        tension: 0.35,
                        fill: true,
                        yAxisID: 'y'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Counts' }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        title: { display: true, text: 'Revenue (PKR)' }
                    }
                }
            }
        });

        // Revenue breakdown (stacked bar)
        new Chart(document.getElementById('revenueBarChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    { label: 'Revenue', data: revenue, backgroundColor: 'rgba(16,185,129,0.7)' },
                    { label: 'Commission', data: commission, backgroundColor: 'rgba(99,102,241,0.7)' },
                    { label: 'Driver Earnings', data: driverEarnings, backgroundColor: 'rgba(245,158,11,0.7)' },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } },
                scales: { x: { stacked: true }, y: { stacked: true, beginAtZero: true } }
            }
        });

        // Ride status pie
        const rideStatus = @json($rideStatusCounts ?? []);
        new Chart(document.getElementById('rideStatusPie').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(rideStatus).map(k => k.charAt(0).toUpperCase()+k.slice(1)),
                datasets: [{
                    data: Object.values(rideStatus),
                    backgroundColor: ['#9ca3af','#f59e0b','#22c55e','#3b82f6','#06b6d4','#10b981','#ef4444'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    });
</script>
@endpush
