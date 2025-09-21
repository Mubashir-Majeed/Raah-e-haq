@extends('layouts.admin')

@section('title', 'Driver Tracking Details')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Driver Tracking Details</h1>
            <p class="text-gray-600">Real-time location and activity tracking for driver</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.driver-tracking.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
            <button onclick="refreshLocation()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-sync-alt mr-2"></i>Refresh Location
            </button>
        </div>
    </div>

    <!-- Driver Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Driver Information Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-user text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Driver Information</h3>
                        <p class="text-blue-100 text-sm">Personal and contact details</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white text-xl font-bold mr-4">
                        {{ substr($driver->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900">{{ $driver->name }}</h4>
                        <p class="text-gray-600">{{ $driver->email }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Phone</label>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $driver->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</label>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($driver->status === 'active') bg-green-100 text-green-800
                                @elseif($driver->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($driver->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">CNIC</label>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $driver->cnic ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">License</label>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $driver->license_number ?? 'N/A' }}</p>
                    </div>
                    @if($vehicle)
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Vehicle</label>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Plate Number</label>
                        <p class="text-sm font-medium text-gray-900 mt-1">{{ $vehicle->license_plate ?? 'N/A' }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Current Location Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-green-600 to-emerald-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-map-marker-alt text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Current Location</h3>
                        <p class="text-green-100 text-sm">Real-time GPS coordinates</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-location-dot text-green-600"></i>
                    </div>
                    <span class="font-semibold text-gray-900">Live Position</span>
                </div>
                
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4 mb-4 border border-green-200">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Latitude</label>
                            <p class="text-lg font-bold text-gray-900 mt-1" id="current-lat">{{ $latestLocation->latitude ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Longitude</label>
                            <p class="text-lg font-bold text-gray-900 mt-1" id="current-lng">{{ $latestLocation->longitude ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-600">Last Updated</span>
                        <span class="text-sm font-semibold text-gray-900" id="last-updated">{{ $latestLocation->last_seen_at ? $latestLocation->last_seen_at->diffForHumans() : 'Never' }}</span>
                    </div>
                    @if($latestLocation && $latestLocation->address)
                    <div class="flex justify-between items-start">
                        <span class="text-sm font-medium text-gray-600">Address</span>
                        <span class="text-sm text-gray-900 text-right max-w-xs">{{ $latestLocation->address }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Activity Status Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-purple-600 to-indigo-700 text-white rounded-t-xl">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-activity text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Activity Status</h3>
                        <p class="text-purple-100 text-sm">Real-time driver activity</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Online Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($latestLocation && $latestLocation->isRecent()) bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif" id="online-status">
                            {{ $latestLocation && $latestLocation->isRecent() ? 'Online' : 'Offline' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Driver Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($latestLocation && $latestLocation->status === 'available') bg-green-100 text-green-800
                            @elseif($latestLocation && $latestLocation->status === 'busy') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800 @endif" id="driver-status">
                            {{ $latestLocation ? ucfirst($latestLocation->status) : 'Unknown' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Speed</span>
                        <span class="text-sm font-semibold text-gray-900" id="current-speed">{{ $latestLocation->speed ?? 0 }} km/h</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Heading</span>
                        <span class="text-sm font-semibold text-gray-900" id="current-heading">{{ $latestLocation->heading ?? 0 }}°</span>
                    </div>
                    @if($latestLocation && $latestLocation->accuracy)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-600">Accuracy</span>
                        <span class="text-sm font-semibold text-gray-900" id="current-accuracy">{{ $latestLocation->accuracy }}m</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Map and Tracking Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Live Tracking Map -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-800 to-gray-900 text-white rounded-t-xl">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-map text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Live Tracking Map</h3>
                            <p class="text-gray-300 text-sm">Real-time driver location tracking</p>
                        </div>
                    </div>
                </div>
                <div class="p-0">
                    <div id="tracking-map" class="w-full h-96 rounded-b-xl"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-history text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                            <p class="text-gray-600 text-sm">Driver activity timeline</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-4" id="activity-timeline">
                        @if($latestLocation && $latestLocation->isRecent())
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Location updated</p>
                                <p class="text-xs text-gray-500">{{ $latestLocation->last_seen_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($recentRides && $recentRides->count() > 0)
                            @foreach($recentRides->take(5) as $ride)
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 rounded-full mt-2
                                    @if($ride->status === 'completed') bg-green-500
                                    @elseif($ride->status === 'cancelled') bg-red-500
                                    @else bg-yellow-500 @endif"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Ride {{ ucfirst($ride->status) }}</p>
                                    <p class="text-xs text-gray-500">{{ $ride->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-gray-400 rounded-full mt-2"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">No recent activity</p>
                                <p class="text-xs text-gray-500">No rides or updates found</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-tools text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                            <p class="text-gray-600 text-sm">Driver management tools</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <button onclick="sendMessage()" class="w-full flex items-center justify-center px-4 py-2 border border-blue-300 text-blue-700 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                            <i class="fas fa-message mr-2"></i>
                            Send Message
                        </button>
                        <button onclick="emergencyAlert()" class="w-full flex items-center justify-center px-4 py-2 border border-yellow-300 text-yellow-700 rounded-lg hover:bg-yellow-50 transition-colors duration-200">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Emergency Alert
                        </button>
                        <button onclick="viewRideHistory()" class="w-full flex items-center justify-center px-4 py-2 border border-indigo-300 text-indigo-700 rounded-lg hover:bg-indigo-50 transition-colors duration-200">
                            <i class="fas fa-list mr-2"></i>
                            View Ride History
                        </button>
                        <button onclick="downloadReport()" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-download mr-2"></i>
                            Download Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
let map;
let driverMarker;
let trackingInterval;

// Initialize map
function initMap() {
    const driverLat = {{ $latestLocation->latitude ?? 24.8607 }};
    const driverLng = {{ $latestLocation->longitude ?? 67.0011 }};
    
    map = new google.maps.Map(document.getElementById('tracking-map'), {
        zoom: 15,
        center: { lat: driverLat, lng: driverLng },
        mapTypeId: 'roadmap',
        styles: [
            {
                featureType: 'poi',
                elementType: 'labels',
                stylers: [{ visibility: 'off' }]
            }
        ]
    });

    // Create driver marker
    driverMarker = new google.maps.Marker({
        position: { lat: driverLat, lng: driverLng },
        map: map,
        title: '{{ $driver->name }}',
        icon: {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="18" fill="#3b82f6" stroke="#fff" stroke-width="2"/>
                    <text x="20" y="26" text-anchor="middle" fill="white" font-family="Arial" font-size="16" font-weight="bold">D</text>
                </svg>
            `),
            scaledSize: new google.maps.Size(40, 40),
            anchor: new google.maps.Point(20, 20)
        }
    });

    // Start tracking updates
    startTracking();
}

// Start real-time tracking
function startTracking() {
    trackingInterval = setInterval(updateLocation, 30000); // Update every 30 seconds
}

// Update driver location
function updateLocation() {
    fetch(`/admin/driver-tracking/{{ $driver->id }}/location`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const newPosition = { lat: data.latitude, lng: data.longitude };
                driverMarker.setPosition(newPosition);
                map.setCenter(newPosition);
                
                // Update location display
                document.getElementById('current-lat').textContent = data.latitude.toFixed(6);
                document.getElementById('current-lng').textContent = data.longitude.toFixed(6);
                document.getElementById('last-updated').textContent = 'Just now';
                
                // Update activity timeline
                addActivityItem('Location updated', 'success');
            }
        })
        .catch(error => {
            console.error('Error updating location:', error);
        });
}

// Add activity item to timeline
function addActivityItem(message, type) {
    const timeline = document.getElementById('activity-timeline');
    const activityItem = document.createElement('div');
    activityItem.className = 'flex items-start space-x-3';
    
    const colorClass = type === 'success' ? 'bg-green-500' : type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500';
    
    activityItem.innerHTML = `
        <div class="w-2 h-2 ${colorClass} rounded-full mt-2"></div>
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-900">${message}</p>
            <p class="text-xs text-gray-500">Just now</p>
        </div>
    `;
    
    timeline.insertBefore(activityItem, timeline.firstChild);
    
    // Keep only last 10 items
    while (timeline.children.length > 10) {
        timeline.removeChild(timeline.lastChild);
    }
}

// Refresh location manually
function refreshLocation() {
    updateLocation();
    addActivityItem('Location refreshed manually', 'info');
}

// Send message to driver
function sendMessage() {
    const message = prompt('Enter message to send to driver:');
    if (message) {
        // Implement message sending logic
        addActivityItem(`Message sent: "${message}"`, 'info');
    }
}

// Emergency alert
function emergencyAlert() {
    if (confirm('Send emergency alert to driver?')) {
        // Implement emergency alert logic
        addActivityItem('Emergency alert sent', 'warning');
    }
}

// View ride history
function viewRideHistory() {
    window.location.href = `/admin/rides?driver={{ $driver->id }}`;
}

// Download report
function downloadReport() {
    window.location.href = `/admin/driver-tracking/{{ $driver->id }}/report`;
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    // Load Google Maps API
    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap`;
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
});

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    if (trackingInterval) {
        clearInterval(trackingInterval);
    }
});
</script>
@endsection
