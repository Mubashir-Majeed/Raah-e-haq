<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DriverLocation;
use App\Models\Ride;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverTrackingController extends Controller
{
    public function updateLocation(Request $request): JsonResponse
    {
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'nullable|string|in:online,available,busy,offline',
        ]);

        $location = DriverLocation::updateLocation(
            $request->user()->id,
            $data['latitude'],
            $data['longitude'],
            $data['status'] ?? 'available',
            $request->only(['address','speed','heading','accuracy'])
        );

        return response()->json(['success' => true, 'message' => 'Location updated', 'data' => $location], 201);
    }

    public function latest(Request $request, int $driverId): JsonResponse
    {
        $location = DriverLocation::getLatestLocation($driverId);
        return response()->json(['success' => true, 'data' => $location]);
    }

    public function driversInRadius(Request $request): JsonResponse
    {
        $data = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius_km' => 'nullable|numeric'
        ]);

        $drivers = DriverLocation::getDriversInRadius(
            $data['latitude'], $data['longitude'], $data['radius_km'] ?? 10
        );

        return response()->json(['success' => true, 'data' => $drivers]);
    }

    public function rideTracking(Ride $ride): JsonResponse
    {
        $locations = DriverLocation::where('driver_id', $ride->driver_id)
            ->whereBetween('last_seen_at', [$ride->started_at ?? $ride->requested_at, $ride->completed_at ?? now()])
            ->orderBy('last_seen_at')
            ->get();
        return response()->json(['success' => true, 'data' => $locations]);
    }
}
