<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RideResource;
use App\Http\Resources\RideStopResource;
use App\Models\Ride;
use App\Models\RideStop;
use App\Models\User;
use App\Models\DriverLocation;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RidesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Ride::with(['passenger', 'driver', 'vehicle', 'stops'])
            ->orderByDesc('created_at');

        // Filter by user type
        if ($request->user()->role === 'driver') {
            $query->where('driver_id', $request->user()->id);
        } elseif ($request->user()->role === 'passenger') {
            $query->where('passenger_id', $request->user()->id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $rides = $query->paginate(20);
        
        return response()->json([
            'success' => true,
            'data' => RideResource::collection($rides),
            'pagination' => [
                'current_page' => $rides->currentPage(),
                'last_page' => $rides->lastPage(),
                'per_page' => $rides->perPage(),
                'total' => $rides->total(),
            ]
        ]);
    }

    public function show(Ride $ride): JsonResponse
    {
        $ride->load(['passenger', 'driver', 'vehicle', 'stops']);
        return response()->json(['success' => true, 'data' => new RideResource($ride)]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'passenger_id' => 'required|exists:users,id',
            'pickup_address' => 'required|string|max:255',
            'dropoff_address' => 'required|string|max:255',
            'pickup_latitude' => 'required|numeric|between:-90,90',
            'pickup_longitude' => 'required|numeric|between:-180,180',
            'dropoff_latitude' => 'required|numeric|between:-90,90',
            'dropoff_longitude' => 'required|numeric|between:-180,180',
            'vehicle_type' => 'nullable|string|in:car,bike,rickshaw,van',
            'passenger_count' => 'nullable|integer|min:1|max:8',
            'special_instructions' => 'nullable|string|max:500',
            'stops' => 'nullable|array|max:5',
            'stops.*.address' => 'required_with:stops|string|max:255',
            'stops.*.latitude' => 'required_with:stops|numeric|between:-90,90',
            'stops.*.longitude' => 'required_with:stops|numeric|between:-180,180',
            'stops.*.stop_order' => 'required_with:stops|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        try {
            DB::beginTransaction();

            $data = $validator->validated();
            
            // Generate unique ride ID
            $rideId = Ride::generateRideId();
            
            // Calculate base fare (simplified)
            $baseFare = 100; // Base fare
            $distance = $this->calculateDistance(
                $data['pickup_latitude'],
                $data['pickup_longitude'],
                $data['dropoff_latitude'],
                $data['dropoff_longitude']
            );
            $distanceFare = $distance * 15; // PKR 15 per km
            
            $ride = Ride::create([
                'ride_id' => $rideId,
                'passenger_id' => $data['passenger_id'],
                'pickup_address' => $data['pickup_address'],
                'pickup_latitude' => $data['pickup_latitude'],
                'pickup_longitude' => $data['pickup_longitude'],
                'dropoff_address' => $data['dropoff_address'],
                'dropoff_latitude' => $data['dropoff_latitude'],
                'dropoff_longitude' => $data['dropoff_longitude'],
                'vehicle_type' => $data['vehicle_type'] ?? 'car',
                'passenger_count' => $data['passenger_count'] ?? 1,
                'special_instructions' => $data['special_instructions'] ?? null,
                'status' => 'requested',
                'base_fare' => $baseFare,
                'distance_fare' => $distanceFare,
                'total_fare' => $baseFare + $distanceFare,
                'requested_at' => now(),
            ]);

            // Create stops if provided
            if (isset($data['stops']) && is_array($data['stops'])) {
                foreach ($data['stops'] as $stopData) {
                    RideStop::create([
                        'ride_id' => $ride->id,
                        'address' => $stopData['address'],
                        'latitude' => $stopData['latitude'],
                        'longitude' => $stopData['longitude'],
                        'stop_order' => $stopData['stop_order'],
                        'status' => 'active',
                    ]);
                }
                
                // Recalculate fare with stops
                $stopFee = count($data['stops']) * 25;
                $ride->update(['total_fare' => $ride->total_fare + $stopFee]);
            }

            DB::commit();

            $ride->load(['passenger', 'driver', 'vehicle', 'stops']);
            
            return response()->json([
                'success' => true,
                'message' => 'Ride request created successfully',
                'data' => new RideResource($ride)
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'RIDE_CREATION_FAILED',
                    'message' => 'Failed to create ride request',
                    'details' => $e->getMessage()
                ]
            ], 500);
        }
    }

    public function update(Request $request, Ride $ride): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|string|in:requested,accepted,ongoing,completed,cancelled',
            'driver_id' => 'nullable|exists:users,id',
            'fare' => 'nullable|numeric|min:0',
            'distance_km' => 'nullable|numeric|min:0',
            'duration_min' => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        $data = $validator->validated();
        
        // Add timestamps based on status
        if (isset($data['status'])) {
            switch ($data['status']) {
                case 'accepted':
                    $data['accepted_at'] = now();
                    break;
                case 'ongoing':
                    $data['started_at'] = now();
                    break;
                case 'completed':
                    $data['completed_at'] = now();
                    break;
                case 'cancelled':
                    $data['cancelled_at'] = now();
                    break;
            }
        }

        $ride->update($data);
        $ride->load(['passenger', 'driver', 'vehicle', 'stops']);

        return response()->json([
            'success' => true,
            'message' => 'Ride updated successfully',
            'data' => new RideResource($ride)
        ]);
    }

    public function destroy(Ride $ride): JsonResponse
    {
        if (!$ride->canBeCancelled()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'RIDE_CANNOT_BE_DELETED',
                    'message' => 'Ride cannot be deleted in current status',
                    'details' => 'Only rides with status requested, accepted, or arrived can be deleted'
                ]
            ], 400);
        }

        $ride->delete();
        return response()->json(['success' => true, 'message' => 'Ride deleted successfully']);
    }

    public function assignDriver(Request $request, Ride $ride): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        if ($ride->status !== 'requested') {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'RIDE_ALREADY_ACCEPTED',
                    'message' => 'Ride has already been accepted',
                    'details' => 'This ride cannot be assigned to another driver'
                ]
            ], 400);
        }

        $driver = User::findOrFail($request->driver_id);
        
        // Check if driver is available
        $latestLocation = DriverLocation::getLatestLocation($driver->id);
        if (!$latestLocation || $latestLocation->status !== 'available') {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'DRIVER_NOT_AVAILABLE',
                    'message' => 'Driver is not available',
                    'details' => 'Driver must be online and available to accept rides'
                ]
            ], 400);
        }

        $ride->update([
            'driver_id' => $driver->id,
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        $ride->load(['passenger', 'driver', 'vehicle', 'stops']);
        
        // Send notification to passenger
        $notificationController = new NotificationController();
        $notificationController->sendRideNotification($ride, 'driver_assigned', [
            'driver_name' => $driver->name,
            'driver_phone' => $driver->phone,
            'driver_rating' => $driver->rating ?? 0,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Driver assigned successfully',
            'data' => new RideResource($ride)
        ]);
    }

    public function cancel(Ride $ride): JsonResponse
    {
        if (!$ride->canBeCancelled()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'RIDE_CANNOT_BE_CANCELLED',
                    'message' => 'Ride cannot be cancelled',
                    'details' => 'Ride cannot be cancelled in current status'
                ]
            ], 400);
        }

        $ride->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => auth()->id(),
        ]);

        $ride->load(['passenger', 'driver', 'vehicle', 'stops']);
        
        // Send notification to both parties
        $notificationController = new NotificationController();
        $notificationController->sendRideNotification($ride, 'ride_cancelled', [
            'cancelled_by' => auth()->user()->name,
            'reason' => 'user_cancelled',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Ride cancelled successfully',
            'data' => new RideResource($ride)
        ]);
    }

    public function getPendingRides(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:1|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        $data = $validator->validated();
        $radius = $data['radius'] ?? 10; // Default 10km radius

        $rides = Ride::with(['passenger', 'stops'])
            ->where('status', 'requested')
            ->where('vehicle_type', $request->vehicle_type ?? 'car')
            ->get()
            ->filter(function ($ride) use ($data, $radius) {
                $distance = $this->calculateDistance(
                    $data['latitude'],
                    $data['longitude'],
                    $ride->pickup_latitude,
                    $ride->pickup_longitude
                );
                return $distance <= $radius;
            })
            ->map(function ($ride) use ($data) {
                $distance = $this->calculateDistance(
                    $data['latitude'],
                    $data['longitude'],
                    $ride->pickup_latitude,
                    $ride->pickup_longitude
                );
                
                $ride->estimated_distance = round($distance, 2);
                $ride->estimated_fare = $ride->total_fare;
                
                return $ride;
            })
            ->sortBy('estimated_distance')
            ->values();

        return response()->json([
            'success' => true,
            'data' => RideResource::collection($rides)
        ]);
    }

    public function getNearbyDrivers(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:1|max:50',
            'vehicle_type' => 'nullable|string|in:car,bike,rickshaw,van',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        $data = $validator->validated();
        $radius = $data['radius'] ?? 5; // Default 5km radius

        $drivers = DriverLocation::getDriversInRadius(
            $data['latitude'],
            $data['longitude'],
            $radius
        );

        if (isset($data['vehicle_type'])) {
            $drivers = $drivers->filter(function ($driver) use ($data) {
                return $driver->driver && $driver->driver->vehicle_type === $data['vehicle_type'];
            });
        }

        $drivers = $drivers->map(function ($driver) {
            return [
                'id' => $driver->driver_id,
                'name' => $driver->driver->name ?? 'Unknown',
                'phone' => $driver->driver->phone ?? '',
                'rating' => $driver->driver->rating ?? 0,
                'vehicle_type' => $driver->driver->vehicle_type ?? 'car',
                'distance_km' => round($driver->distance, 2),
                'estimated_arrival_min' => round($driver->distance * 2), // Rough estimate
                'location' => [
                    'latitude' => $driver->latitude,
                    'longitude' => $driver->longitude,
                ]
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $drivers
        ]);
    }

    // Stop Management Methods
    public function addStop(Request $request, Ride $ride): JsonResponse
    {
        if (!$ride->canBeModified()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'CANNOT_MODIFY_COMPLETED_RIDE',
                    'message' => 'Cannot modify stops for completed rides',
                    'details' => 'Stops can only be modified when ride status is requested or accepted'
                ]
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'stop_order' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        $data = $validator->validated();

        // Check if stop order already exists
        if ($ride->stops()->where('stop_order', $data['stop_order'])->exists()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'INVALID_STOP_ORDER',
                    'message' => 'Stop order must be unique',
                    'details' => 'Stop order ' . $data['stop_order'] . ' already exists'
                ]
            ], 400);
        }

        // Check maximum stops limit
        if ($ride->stops()->count() >= 5) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'MAX_STOPS_EXCEEDED',
                    'message' => 'Maximum number of stops (5) exceeded',
                    'details' => 'Cannot add more than 5 stops to a ride'
                ]
            ], 400);
        }

        $stop = RideStop::create([
            'ride_id' => $ride->id,
            'address' => $data['address'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'stop_order' => $data['stop_order'],
            'status' => 'active',
        ]);

        // Recalculate fare
        $stopFee = 25; // PKR 25 per stop
        $ride->update(['total_fare' => $ride->total_fare + $stopFee]);

        $ride->load(['stops']);
        
        // Send notification to both parties
        $notificationController = new NotificationController();
        $notificationController->sendStopNotification($ride, $stop, 'stop_added', [
            'stop_address' => $stop->address,
            'stop_order' => $stop->stop_order,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Stop added successfully',
            'data' => [
                'id' => $ride->id,
                'stops' => RideStopResource::collection($ride->stops),
                'updated_fare' => $ride->total_fare,
                'updated_distance' => $ride->distance_km . ' km',
                'updated_duration' => $ride->duration_minutes . ' minutes'
            ]
        ]);
    }

    public function removeStop(Request $request, Ride $ride, RideStop $stop): JsonResponse
    {
        if (!$ride->canBeModified()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'CANNOT_MODIFY_COMPLETED_RIDE',
                    'message' => 'Cannot modify stops for completed rides',
                    'details' => 'Stops can only be modified when ride status is requested or accepted'
                ]
            ], 400);
        }

        if ($stop->ride_id !== $ride->id) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'STOP_NOT_FOUND',
                    'message' => 'Stop not found',
                    'details' => 'Stop does not belong to this ride'
                ]
            ], 404);
        }

        $stop->update(['status' => 'cancelled']);

        // Recalculate fare
        $stopFee = 25; // PKR 25 per stop
        $ride->update(['total_fare' => $ride->total_fare - $stopFee]);

        $ride->load(['stops']);

        return response()->json([
            'success' => true,
            'message' => 'Stop removed successfully',
            'data' => [
                'id' => $ride->id,
                'stops' => RideStopResource::collection($ride->stops),
                'updated_fare' => $ride->total_fare,
                'updated_distance' => $ride->distance_km . ' km',
                'updated_duration' => $ride->duration_minutes . ' minutes'
            ]
        ]);
    }

    public function reorderStops(Request $request, Ride $ride): JsonResponse
    {
        if (!$ride->canBeModified()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'CANNOT_MODIFY_COMPLETED_RIDE',
                    'message' => 'Cannot modify stops for completed rides',
                    'details' => 'Stops can only be modified when ride status is requested or accepted'
                ]
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'stop_orders' => 'required|array',
            'stop_orders.*.stop_id' => 'required|exists:ride_stops,id',
            'stop_orders.*.new_order' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'Validation failed',
                    'details' => $validator->errors()
                ]
            ], 422);
        }

        $data = $validator->validated();

        foreach ($data['stop_orders'] as $orderData) {
            $stop = RideStop::find($orderData['stop_id']);
            if ($stop && $stop->ride_id === $ride->id) {
                $stop->update(['stop_order' => $orderData['new_order']]);
            }
        }

        $ride->load(['stops']);

        return response()->json([
            'success' => true,
            'message' => 'Stop order updated successfully',
            'data' => [
                'id' => $ride->id,
                'stops' => RideStopResource::collection($ride->stops),
                'updated_fare' => $ride->total_fare,
                'updated_distance' => $ride->distance_km . ' km',
                'updated_duration' => $ride->duration_minutes . ' minutes'
            ]
        ]);
    }

    // Driver-specific methods
    public function navigateNextStop(Ride $ride): JsonResponse
    {
        if ($ride->driver_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'Only the assigned driver can navigate stops'
                ]
            ], 403);
        }

        $nextStop = $ride->getNextStop();
        
        if (!$nextStop) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'NO_MORE_STOPS',
                    'message' => 'No more stops to navigate',
                    'details' => 'All stops have been completed'
                ]
            ], 400);
        }

        $ride->load(['stops']);

        return response()->json([
            'success' => true,
            'message' => 'Navigating to next stop',
            'data' => [
                'id' => $ride->id,
                'current_stop_index' => $ride->getCurrentStopIndex(),
                'next_stop' => new RideStopResource($nextStop),
                'remaining_stops' => $ride->getActiveStopsCount(),
                'route_updated' => true
            ]
        ]);
    }

    public function completeStop(Ride $ride, RideStop $stop): JsonResponse
    {
        if ($ride->driver_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'Only the assigned driver can complete stops'
                ]
            ], 403);
        }

        if ($stop->ride_id !== $ride->id) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'STOP_NOT_FOUND',
                    'message' => 'Stop not found',
                    'details' => 'Stop does not belong to this ride'
                ]
            ], 404);
        }

        if ($stop->isCompleted()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'STOP_ALREADY_COMPLETED',
                    'message' => 'Stop has already been completed',
                    'details' => 'This stop has already been marked as completed'
                ]
            ], 400);
        }

        $stop->markAsCompleted();

        $ride->load(['stops']);
        $nextStop = $ride->getNextStop();
        
        // Send notification to both parties
        $notificationController = new NotificationController();
        $notificationController->sendStopNotification($ride, $stop, 'stop_completed', [
            'stop_address' => $stop->address,
            'stop_order' => $stop->stop_order,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Stop completed successfully',
            'data' => [
                'id' => $ride->id,
                'current_stop_index' => $ride->getCurrentStopIndex(),
                'completed_stops' => $ride->getCompletedStopsCount(),
                'remaining_stops' => $ride->getActiveStopsCount(),
                'next_stop' => $nextStop ? new RideStopResource($nextStop) : null
            ]
        ]);
    }

    public function getNavigationInstructions(Ride $ride): JsonResponse
    {
        if ($ride->driver_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'Only the assigned driver can get navigation instructions'
                ]
            ], 403);
        }

        $nextStop = $ride->getNextStop();
        
        if (!$nextStop) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'NO_MORE_STOPS',
                    'message' => 'No more stops to navigate',
                    'details' => 'All stops have been completed'
                ]
            ], 400);
        }

        // Simple route calculation - in real app, use Google Maps API
        $distance = $this->calculateDistance(
            $ride->pickup_latitude,
            $ride->pickup_longitude,
            $nextStop->latitude,
            $nextStop->longitude
        );

        $steps = [
            [
                'instruction' => 'Head towards ' . $nextStop->address,
                'distance' => round($distance, 2) . ' km',
                'duration' => round($distance * 2) . ' minutes'
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'current_stop_index' => $ride->getCurrentStopIndex(),
                'total_stops' => $ride->stops()->count(),
                'route' => [
                    'distance' => round($distance, 2) . ' km',
                    'duration' => round($distance * 2) . ' minutes',
                    'steps' => $steps
                ],
                'next_stop' => new RideStopResource($nextStop)
            ]
        ]);
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }
}
