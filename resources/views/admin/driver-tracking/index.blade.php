@extends('layouts.admin')

@section('title', 'Driver Tracking')

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
            <h1 class="text-3xl font-bold text-gray-900">Driver Tracking</h1>
            <p class="text-gray-600 mt-2">Monitor driver locations and real-time tracking</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.driver-tracking.map') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-map mr-2"></i>Map View
            </a>
            <button onclick="refreshLocations()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Driver Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['total_drivers'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Drivers</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-users text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-success" style="color: #058a0bee;">{{ $stats['online_drivers'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Online Drivers</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $stats['available_drivers'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Available Drivers</p>
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $stats['busy_drivers'] }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Busy Drivers</p>
                </div>
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="stat-card rounded-2xl p-6 mb-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search drivers..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="online" {{ request('status') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="busy" {{ request('status') == 'busy' ? 'selected' : '' }}>Busy</option>
                    <option value="offline" {{ request('status') == 'offline' ? 'selected' : '' }}>Offline</option>
                </select>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="recent_only" value="1" {{ request('recent_only') ? 'checked' : '' }} class="mr-2">
                <label class="text-sm text-gray-600">Recent Only (30 min)</label>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    <!-- Driver Locations Table -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Driver</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Location</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Speed</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Last Seen</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($driverLocations as $location)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($location->driver->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $location->driver->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $location->driver->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-{{ $location->getStatusColor() }}-100 text-{{ $location->getStatusColor() }}-800">
                                    <div class="w-2 h-2 bg-{{ $location->getStatusColor() }}-500 rounded-full mr-2 {{ $location->isRecent() ? 'animate-pulse' : '' }}"></div>
                                    {{ $location->getStatusLabel() }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="text-sm text-gray-900">{{ $location->getFormattedAddress() }}</p>
                                    <p class="text-xs text-gray-500">{{ number_format($location->latitude, 4) }}, {{ number_format($location->longitude, 4) }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($location->speed)
                                    <span class="text-sm font-medium text-gray-900">{{ number_format($location->speed, 1) }} km/h</span>
                                @else
                                    <span class="text-sm text-gray-500">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <p class="text-sm text-gray-900">{{ $location->last_seen_at->diffForHumans() }}</p>
                                    <p class="text-xs text-gray-500">{{ $location->last_seen_at->format('M d, H:i') }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.driver-tracking.show', $location->driver) }}" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm">
                                        <i class="fas fa-eye mr-1"></i>View
                                    </a>
                                    <a href="{{ route('admin.driver-tracking.map', ['lat' => $location->latitude, 'lng' => $location->longitude]) }}" class="px-3 py-1 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm">
                                        <i class="fas fa-map-marker-alt mr-1"></i>Map
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-map-marker-alt text-4xl mb-4"></i>
                                <p>No driver locations found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($driverLocations->hasPages())
            <div class="mt-6">
                {{ $driverLocations->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function refreshLocations() {
    window.location.reload();
}

// Auto-refresh every 30 seconds
setInterval(function() {
    // Only refresh if no filters are applied
    if (!window.location.search) {
        window.location.reload();
    }
}, 30000);
</script>
@endsection
