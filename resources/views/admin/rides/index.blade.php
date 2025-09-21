@extends('layouts.admin')

@section('title', 'Ride Management')

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
            <h1 class="text-3xl font-bold text-gray-900">Ride Management</h1>
            <p class="text-gray-600 mt-2">Monitor and manage all ride requests, assignments, and completions</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.rides.create') }}" class="px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                <i class="fas fa-plus mr-2"></i>Add Ride
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['total_rides'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Rides</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-car text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $stats['active_rides'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Active Rides</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-success" style="color: #058a0bee;">{{ $stats['completed_rides'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Completed</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">PKR {{ number_format($stats['total_revenue'], 0) }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Revenue</p>
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="stat-card rounded-2xl p-6 mb-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="GET" action="{{ route('admin.rides.index') }}" class="grid grid-cols-1 md:grid-cols-6 gap-4" id="ride-filters-form">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Ride ID, passenger, driver, address..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="searching" {{ request('status') === 'searching' ? 'selected' : '' }}>Searching</option>
                    <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="arrived" {{ request('status') === 'arrived' ? 'selected' : '' }}>Arrived</option>
                    <option value="started" {{ request('status') === 'started' ? 'selected' : '' }}>Started</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                <select name="vehicle_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="car" {{ request('vehicle_type') === 'car' ? 'selected' : '' }}>Car</option>
                    <option value="bike" {{ request('vehicle_type') === 'bike' ? 'selected' : '' }}>Bike</option>
                    <option value="rickshaw" {{ request('vehicle_type') === 'rickshaw' ? 'selected' : '' }}>Rickshaw</option>
                    <option value="van" {{ request('vehicle_type') === 'van' ? 'selected' : '' }}>Van</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="w-full px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
            <div class="flex items-end">
                <a href="{{ route('admin.rides.index') }}" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 text-center">
                    <i class="fas fa-undo mr-2"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Rides Table -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-primary" style="color: #011c72ff;">Ride Requests</h2>
            <div class="text-sm text-gray-500">
                Showing {{ $rides->firstItem() }} to {{ $rides->lastItem() }} of {{ $rides->total() }} rides
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Ride ID</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Passenger</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Driver</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Route</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Fare</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rides as $ride)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="font-semibold text-gray-900">{{ $ride->ride_id }}</div>
                                <div class="text-sm text-gray-500">{{ $ride->created_at->format('M d, Y H:i') }}</div>
                            </td>
                            <td class="py-4 px-4">
                                @if($ride->passenger)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-xs">{{ substr($ride->passenger->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $ride->passenger->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $ride->passenger->phone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                @if($ride->driver)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-teal-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-semibold text-xs">{{ substr($ride->driver->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $ride->driver->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $ride->driver->phone ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500">Not Assigned</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="font-medium text-gray-900">{{ Str::limit($ride->pickup_address, 30) }}</p>
                                    <p class="text-gray-500">→ {{ Str::limit($ride->dropoff_address, 30) }}</p>
                                    @if($ride->distance_km)
                                        <p class="text-xs text-gray-400">{{ $ride->distance_km }} km</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">PKR {{ number_format($ride->total_fare, 0) }}</p>
                                    @if($ride->driver_earnings > 0)
                                        <p class="text-xs text-gray-500">Driver: PKR {{ number_format($ride->driver_earnings, 0) }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($ride->status === 'completed') bg-green-100 text-green-800
                                    @elseif($ride->status === 'cancelled') bg-red-100 text-red-800
                                    @elseif(in_array($ride->status, ['accepted', 'arrived', 'started'])) bg-blue-100 text-blue-800
                                    @elseif($ride->status === 'searching') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($ride->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.rides.show', $ride) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                    <a href="{{ route('admin.rides.edit', $ride) }}" 
                                       class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors text-sm">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-car text-4xl mb-4"></i>
                                <p>No rides found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($rides->hasPages())
            <div class="mt-6">
                {{ $rides->links() }}
            </div>
        @endif
    </div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ride-filters-form');
    if (!form) return;
    const selects = form.querySelectorAll('select[name="status"], select[name="vehicle_type"]');
    const dates = form.querySelectorAll('input[name="date_from"], input[name="date_to"]');
    selects.forEach(el => el.addEventListener('change', () => form.submit()));
    dates.forEach(el => el.addEventListener('change', () => form.submit()));
});
</script>
</div>
@endsection
