@extends('layouts.admin')

@section('title', 'Referral Analytics')

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
            <h1 class="text-3xl font-bold text-gray-900">Referral Analytics</h1>
            <p class="text-gray-600 mt-2">Comprehensive analytics and insights for referral program performance</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.referrals.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-arrow-left mr-2"></i>Back to Referrals
            </a>
        </div>
    </div>

    <!-- Analytics Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Referrals</p>
                    <p class="text-3xl font-bold text-primary">{{ $analytics['total_referrals'] }}</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-3xl font-bold text-green-600">{{ $analytics['completed_referrals'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $analytics['pending_referrals'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Success Rate</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $analytics['success_rate'] }}%</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-percentage text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Monthly Referrals Chart -->
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Referrals Trend</h3>
            <div class="h-64 flex items-center justify-center">
                <canvas id="monthlyReferralsChart"></canvas>
            </div>
        </div>

        <!-- Referral Status Distribution -->
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Referral Status Distribution</h3>
            <div class="h-64 flex items-center justify-center">
                <canvas id="statusDistributionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Referrers Table -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Top Referrers</h3>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">User</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Email</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Total Referrals</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Completed</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Success Rate</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topReferrers as $referrer)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 gradient-primary rounded-full flex items-center justify-center">
                                        <span class="text-white text-sm font-bold">{{ substr($referrer->name, 0, 1) }}</span>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $referrer->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $referrer->email }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">
                                    {{ $referrer->referrals_count }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    {{ $referrer->referrals->where('status', 'completed')->count() }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @php
                                    $completed = $referrer->referrals->where('status', 'completed')->count();
                                    $total = $referrer->referrals_count;
                                    $rate = $total > 0 ? round(($completed / $total) * 100, 1) : 0;
                                @endphp
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-sm font-medium rounded-full">
                                    {{ $rate }}%
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.referrals.user-referrals', $referrer) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500">
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Referrals Chart
    const monthlyCtx = document.getElementById('monthlyReferralsChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($monthlyReferrals)) !!},
            datasets: [{
                label: 'Referrals',
                data: {!! json_encode(array_values($monthlyReferrals)) !!},
                borderColor: '#011c72ff',
                backgroundColor: 'rgba(1, 28, 114, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusDistributionChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'Cancelled'],
            datasets: [{
                data: [
                    {{ $analytics['completed_referrals'] }},
                    {{ $analytics['pending_referrals'] }},
                    {{ $analytics['cancelled_referrals'] ?? 0 }}
                ],
                backgroundColor: [
                    '#10B981',
                    '#F59E0B',
                    '#EF4444'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
});
</script>
@endsection