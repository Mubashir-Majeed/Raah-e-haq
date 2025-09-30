<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RideResource;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RidesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $rides = Ride::with(['passenger', 'driver', 'vehicle'])->orderByDesc('created_at')->paginate(20);
        return response()->json(['success' => true, 'data' => RideResource::collection($rides)]);
    }

    public function show(Ride $ride): JsonResponse
    {
        $ride->load(['passenger', 'driver', 'vehicle']);
        return response()->json(['success' => true, 'data' => new RideResource($ride)]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'passenger_id' => 'required|exists:users,id',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'pickup_latitude' => 'required|numeric',
            'pickup_longitude' => 'required|numeric',
            'dropoff_latitude' => 'required|numeric',
            'dropoff_longitude' => 'required|numeric',
            'vehicle_type' => 'nullable|string',
        ]);

        $ride = Ride::create(array_merge($data, [
            'status' => 'requested',
            'requested_at' => now(),
        ]));

        $ride->load(['passenger', 'driver', 'vehicle']);
        return response()->json(['success' => true, 'message' => 'Ride created successfully', 'data' => new RideResource($ride)], 201);
    }

    public function update(Request $request, Ride $ride): JsonResponse
    {
        $data = $request->validate([
            'status' => 'sometimes|string|in:requested,accepted,ongoing,completed,cancelled',
            'driver_id' => 'nullable|exists:users,id',
            'fare' => 'nullable|numeric',
            'distance_km' => 'nullable|numeric',
            'duration_min' => 'nullable|numeric',
        ]);

        $ride->update($data);
        $ride->load(['passenger', 'driver', 'vehicle']);

        return response()->json(['success' => true, 'message' => 'Ride updated successfully', 'data' => new RideResource($ride)]);
    }

    public function destroy(Ride $ride): JsonResponse
    {
        $ride->delete();
        return response()->json(['success' => true, 'message' => 'Ride deleted successfully']);
    }

    public function assignDriver(Request $request, Ride $ride): JsonResponse
    {
        $data = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $driver = User::findOrFail($data['driver_id']);
        $ride->update([
            'driver_id' => $driver->id,
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        $ride->load(['passenger', 'driver', 'vehicle']);
        return response()->json(['success' => true, 'message' => 'Driver assigned successfully', 'data' => new RideResource($ride)]);
    }

    public function cancel(Ride $ride): JsonResponse
    {
        $ride->update(['status' => 'cancelled', 'cancelled_at' => now()]);
        $ride->load(['passenger', 'driver', 'vehicle']);
        return response()->json(['success' => true, 'message' => 'Ride cancelled successfully', 'data' => new RideResource($ride)]);
    }
}
