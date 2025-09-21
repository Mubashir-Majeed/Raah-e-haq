<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverLocation;
use App\Models\RideTracking;
use App\Models\User;
use App\Models\Ride;
use Illuminate\Http\Request;

class DriverTrackingController extends Controller
{
    public function index(Request $request)
    {
        $query = DriverLocation::with(['driver', 'vehicle']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('driver', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by recent locations only
        if ($request->filled('recent_only') && $request->recent_only) {
            $query->where('last_seen_at', '>=', now()->subMinutes(30));
        }

        // Get latest location for each driver
        $driverLocations = $query->whereIn('id', function($q) {
            $q->selectRaw('MAX(id)')
              ->from('driver_locations')
              ->groupBy('driver_id');
        })->orderBy('last_seen_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total_drivers' => User::whereHas('roles', function($q) {
                $q->where('name', 'driver');
            })->count(),
            'online_drivers' => DriverLocation::where('status', 'online')
                ->where('last_seen_at', '>=', now()->subMinutes(5))
                ->distinct('driver_id')
                ->count('driver_id'),
            'available_drivers' => DriverLocation::where('status', 'available')
                ->where('last_seen_at', '>=', now()->subMinutes(5))
                ->distinct('driver_id')
                ->count('driver_id'),
            'busy_drivers' => DriverLocation::where('status', 'busy')
                ->where('last_seen_at', '>=', now()->subMinutes(5))
                ->distinct('driver_id')
                ->count('driver_id'),
        ];

        return view('admin.driver-tracking.index', compact('driverLocations', 'stats'));
    }

    public function map(Request $request)
    {
        $centerLat = $request->get('lat', 31.5204); // Default to Lahore
        $centerLng = $request->get('lng', 74.3587);
        $zoom = $request->get('zoom', 12);

        // Get all recent driver locations
        $driverLocations = DriverLocation::with(['driver', 'vehicle'])
            ->where('last_seen_at', '>=', now()->subMinutes(30))
            ->whereIn('id', function($q) {
                $q->selectRaw('MAX(id)')
                  ->from('driver_locations')
                  ->groupBy('driver_id');
            })
            ->get();

        // Get active rides for tracking
        $activeRides = Ride::with(['driver', 'passenger', 'vehicle'])
            ->whereIn('status', ['accepted', 'arrived', 'started'])
            ->get();

        return view('admin.driver-tracking.map', compact('driverLocations', 'activeRides', 'centerLat', 'centerLng', 'zoom'));
    }

    public function show(Request $request, User $driver)
    {
        // Get driver's latest location
        $latestLocation = DriverLocation::getLatestLocation($driver->id);

        // Get driver's location history (last 24 hours)
        $locationHistory = DriverLocation::where('driver_id', $driver->id)
            ->where('last_seen_at', '>=', now()->subDay())
            ->orderBy('last_seen_at', 'desc')
            ->limit(100)
            ->get();

        // Get driver's recent rides
        $recentRides = Ride::where('driver_id', $driver->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Get driver's vehicle information
        $vehicle = $driver->vehicles()->first();

        return view('admin.driver-tracking.show', compact('driver', 'latestLocation', 'locationHistory', 'recentRides', 'vehicle'));
    }

    public function rideTracking(Request $request, Ride $ride)
    {
        // Get ride tracking history
        $trackingHistory = RideTracking::getRideHistory($ride->id);

        // Get ride details
        $ride->load(['driver', 'passenger', 'vehicle']);

        return view('admin.driver-tracking.ride-tracking', compact('ride', 'trackingHistory'));
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'status' => 'required|in:online,offline,busy,available',
            'address' => 'nullable|string|max:255',
            'speed' => 'nullable|numeric|min:0',
            'heading' => 'nullable|numeric|between:0,360',
            'accuracy' => 'nullable|numeric|min:0',
        ]);

        $location = DriverLocation::updateLocation(
            $request->driver_id,
            $request->latitude,
            $request->longitude,
            $request->status,
            [
                'address' => $request->address,
                'speed' => $request->speed,
                'heading' => $request->heading,
                'accuracy' => $request->accuracy,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Driver location updated successfully',
            'location' => $location,
        ]);
    }

    public function getDriversInRadius(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:1|max:50',
        ]);

        $radius = $request->get('radius', 10);
        $drivers = DriverLocation::getDriversInRadius(
            $request->latitude,
            $request->longitude,
            $radius
        );

        return response()->json([
            'success' => true,
            'drivers' => $drivers,
            'count' => $drivers->count(),
        ]);
    }

    public function getDriverLocation(Request $request, User $driver)
    {
        $location = DriverLocation::getLatestLocation($driver->id);

        if (!$location) {
            return response()->json([
                'success' => false,
                'message' => 'No location data found for this driver',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'location' => $location,
        ]);
    }

    public function trackRideLocation(Request $request, Ride $ride)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'tracking_type' => 'required|in:pickup,en_route,arrived,started,completed',
            'address' => 'nullable|string|max:255',
            'speed' => 'nullable|numeric|min:0',
            'heading' => 'nullable|numeric|between:0,360',
        ]);

        $tracking = RideTracking::trackLocation(
            $ride->id,
            $request->driver_id,
            $request->latitude,
            $request->longitude,
            $request->tracking_type,
            [
                'address' => $request->address,
                'speed' => $request->speed,
                'heading' => $request->heading,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Ride location tracked successfully',
            'tracking' => $tracking,
        ]);
    }

    public function getRideTracking(Request $request, Ride $ride)
    {
        $trackingHistory = RideTracking::getRideHistory($ride->id);

        return response()->json([
            'success' => true,
            'tracking_history' => $trackingHistory,
        ]);
    }
}
