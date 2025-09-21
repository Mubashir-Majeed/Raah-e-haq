@extends('layouts.admin')

@section('title', 'Driver Tracking Map')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Driver Tracking Map</h1>
            <p class="text-gray-600 mt-2">Real-time driver locations and active rides</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.driver-tracking.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-list mr-2"></i>List View
            </a>
            <button onclick="refreshMap()" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
        </div>
    </div>

    <!-- Map Controls -->
    <div class="stat-card rounded-2xl p-4 mb-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Online Drivers</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Available Drivers</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-orange-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Busy Drivers</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-gray-600">Active Rides</span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button onclick="centerMap()" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm">
                    <i class="fas fa-crosshairs mr-1"></i>Center
                </button>
                <button onclick="toggleTraffic()" class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors text-sm">
                    <i class="fas fa-car mr-1"></i>Traffic
                </button>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="stat-card rounded-2xl p-0 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div id="map" style="height: 600px; width: 100%; border-radius: 1rem;"></div>
    </div>

    <!-- Driver Info Panel -->
    <div id="driverInfoPanel" class="fixed right-4 top-1/2 transform -translate-y-1/2 w-80 bg-white rounded-2xl shadow-2xl p-6 hidden" style="z-index: 1000;">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900">Driver Information</h3>
            <button onclick="closeDriverInfo()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div id="driverInfoContent">
            <!-- Driver info will be populated here -->
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map;
let driverMarkers = [];
let rideMarkers = [];
let trafficLayer = null;

// Driver locations data
const driverLocations = @json($driverLocations);
const activeRides = @json($activeRides);

// Initialize map
function initMap() {
    map = L.map('map').setView([{{ $centerLat }}, {{ $centerLng }}], {{ $zoom }});
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // Add driver markers
    addDriverMarkers();
    
    // Add ride markers
    addRideMarkers();
}

// Add driver markers to map
function addDriverMarkers() {
    driverLocations.forEach(location => {
        const statusColor = getStatusColor(location.status);
        const isRecent = isLocationRecent(location.last_seen_at);
        
        const marker = L.circleMarker([location.latitude, location.longitude], {
            radius: 8,
            fillColor: statusColor,
            color: '#fff',
            weight: 2,
            opacity: 1,
            fillOpacity: 0.8
        }).addTo(map);
        
        // Add pulsing animation for recent locations
        if (isRecent) {
            marker.setStyle({
                fillOpacity: 0.6
            });
        }
        
        // Add popup
        const popupContent = `
            <div class="p-2">
                <h4 class="font-bold text-gray-900">${location.driver.name}</h4>
                <p class="text-sm text-gray-600">${location.driver.email}</p>
                <p class="text-sm text-gray-600">Status: <span class="font-medium">${getStatusLabel(location.status)}</span></p>
                <p class="text-sm text-gray-600">Last seen: ${formatTime(location.last_seen_at)}</p>
                ${location.speed ? `<p class="text-sm text-gray-600">Speed: ${location.speed} km/h</p>` : ''}
                <div class="mt-2">
                    <button onclick="showDriverInfo(${location.driver.id})" class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm">
                        <i class="fas fa-info-circle mr-1"></i>Details
                    </button>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent);
        
        // Add click event
        marker.on('click', function() {
            showDriverInfo(location.driver.id);
        });
        
        driverMarkers.push(marker);
    });
}

// Add ride markers to map
function addRideMarkers() {
    activeRides.forEach(ride => {
        // Pickup marker
        const pickupMarker = L.marker([ride.pickup_latitude, ride.pickup_longitude], {
            icon: L.divIcon({
                className: 'ride-marker pickup-marker',
                html: '<div class="w-6 h-6 bg-blue-500 rounded-full border-2 border-white shadow-lg flex items-center justify-center"><i class="fas fa-map-marker-alt text-white text-xs"></i></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            })
        }).addTo(map);
        
        // Dropoff marker
        const dropoffMarker = L.marker([ride.dropoff_latitude, ride.dropoff_longitude], {
            icon: L.divIcon({
                className: 'ride-marker dropoff-marker',
                html: '<div class="w-6 h-6 bg-red-500 rounded-full border-2 border-white shadow-lg flex items-center justify-center"><i class="fas fa-flag text-white text-xs"></i></div>',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            })
        }).addTo(map);
        
        // Add popup for pickup
        const pickupPopup = `
            <div class="p-2">
                <h4 class="font-bold text-gray-900">Pickup Location</h4>
                <p class="text-sm text-gray-600">${ride.pickup_address}</p>
                <p class="text-sm text-gray-600">Passenger: ${ride.passenger.name}</p>
                <p class="text-sm text-gray-600">Status: <span class="font-medium">${ride.status}</span></p>
            </div>
        `;
        
        // Add popup for dropoff
        const dropoffPopup = `
            <div class="p-2">
                <h4 class="font-bold text-gray-900">Dropoff Location</h4>
                <p class="text-sm text-gray-600">${ride.dropoff_address}</p>
                <p class="text-sm text-gray-600">Passenger: ${ride.passenger.name}</p>
                <p class="text-sm text-gray-600">Status: <span class="font-medium">${ride.status}</span></p>
            </div>
        `;
        
        pickupMarker.bindPopup(pickupPopup);
        dropoffMarker.bindPopup(dropoffPopup);
        
        rideMarkers.push(pickupMarker, dropoffMarker);
    });
}

// Helper functions
function getStatusColor(status) {
    switch(status) {
        case 'online': return '#10B981';
        case 'available': return '#3B82F6';
        case 'busy': return '#F59E0B';
        case 'offline': return '#6B7280';
        default: return '#6B7280';
    }
}

function getStatusLabel(status) {
    switch(status) {
        case 'online': return 'Online';
        case 'available': return 'Available';
        case 'busy': return 'Busy';
        case 'offline': return 'Offline';
        default: return 'Unknown';
    }
}

function isLocationRecent(lastSeen) {
    const now = new Date();
    const lastSeenDate = new Date(lastSeen);
    const diffMinutes = (now - lastSeenDate) / (1000 * 60);
    return diffMinutes <= 5;
}

function formatTime(dateString) {
    const date = new Date(dateString);
    return date.toLocaleString();
}

// Show driver information panel
function showDriverInfo(driverId) {
    const location = driverLocations.find(loc => loc.driver.id === driverId);
    if (!location) return;
    
    const content = `
        <div class="space-y-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-semibold">${location.driver.name.charAt(0)}</span>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">${location.driver.name}</h4>
                    <p class="text-sm text-gray-600">${location.driver.email}</p>
                </div>
            </div>
            
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Status:</span>
                    <span class="text-sm font-medium text-gray-900">${getStatusLabel(location.status)}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Last Seen:</span>
                    <span class="text-sm font-medium text-gray-900">${formatTime(location.last_seen_at)}</span>
                </div>
                ${location.speed ? `
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Speed:</span>
                    <span class="text-sm font-medium text-gray-900">${location.speed} km/h</span>
                </div>
                ` : ''}
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Location:</span>
                    <span class="text-sm font-medium text-gray-900">${location.address || 'Unknown'}</span>
                </div>
            </div>
            
            <div class="pt-4 border-t">
                <a href="/admin/driver-tracking/${driverId}" class="block w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-center">
                    <i class="fas fa-eye mr-2"></i>View Details
                </a>
            </div>
        </div>
    `;
    
    document.getElementById('driverInfoContent').innerHTML = content;
    document.getElementById('driverInfoPanel').classList.remove('hidden');
}

// Close driver information panel
function closeDriverInfo() {
    document.getElementById('driverInfoPanel').classList.add('hidden');
}

// Center map on all markers
function centerMap() {
    if (driverMarkers.length === 0) return;
    
    const group = new L.featureGroup(driverMarkers);
    map.fitBounds(group.getBounds().pad(0.1));
}

// Toggle traffic layer
function toggleTraffic() {
    if (trafficLayer) {
        map.removeLayer(trafficLayer);
        trafficLayer = null;
    } else {
        // Add traffic layer (this would require a traffic service)
        // For demo purposes, we'll just show a message
        alert('Traffic layer would be implemented with a traffic service like Google Maps Traffic API');
    }
}

// Refresh map data
function refreshMap() {
    window.location.reload();
}

// Initialize map when page loads
document.addEventListener('DOMContentLoaded', function() {
    initMap();
});

// Auto-refresh every 30 seconds
setInterval(function() {
    refreshMap();
}, 30000);
</script>

<style>
.ride-marker {
    background: transparent !important;
    border: none !important;
}

.pickup-marker {
    animation: pulse 2s infinite;
}

.dropoff-marker {
    animation: bounce 1s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}
</style>
@endsection
