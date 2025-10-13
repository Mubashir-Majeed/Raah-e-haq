<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\RideStop;
use App\Models\DriverLocation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebSocketController extends Controller
{
    public function subscribeToRideUpdates(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'ride_id' => 'required|exists:rides,id',
            'user_type' => 'required|string|in:passenger,driver',
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
        $ride = Ride::findOrFail($data['ride_id']);

        // Verify user has access to this ride
        if ($data['user_type'] === 'passenger' && $ride->passenger_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'You can only subscribe to your own rides'
                ]
            ], 403);
        }

        if ($data['user_type'] === 'driver' && $ride->driver_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'You can only subscribe to rides assigned to you'
                ]
            ], 403);
        }

        // In a real implementation, you would establish WebSocket connection here
        // For now, we'll return the subscription details
        
        return response()->json([
            'success' => true,
            'message' => 'Subscribed to ride updates',
            'data' => [
                'ride_id' => $ride->id,
                'user_type' => $data['user_type'],
                'websocket_url' => 'wss://raahehaq.com/ws/ride/' . $ride->id,
                'channels' => [
                    'ride_updates',
                    'driver_location',
                    'stop_updates',
                    'status_changes'
                ]
            ]
        ]);
    }

    public function subscribeToDriverRequests(Request $request): JsonResponse
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

        // Verify driver is the authenticated user
        if ($data['driver_id'] !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'UNAUTHORIZED',
                    'message' => 'Unauthorized access',
                    'details' => 'You can only subscribe to your own driver requests'
                ]
            ], 403);
        }

        // Update driver location
        DriverLocation::updateLocation(
            $data['driver_id'],
            $data['latitude'],
            $data['longitude'],
            'available',
            [
                'address' => $request->address ?? null,
                'speed' => $request->speed ?? null,
                'heading' => $request->heading ?? null,
                'accuracy' => $request->accuracy ?? null,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Subscribed to driver requests',
            'data' => [
                'driver_id' => $data['driver_id'],
                'websocket_url' => 'wss://raahehaq.com/ws/driver/' . $data['driver_id'],
                'channels' => [
                    'new_ride_requests',
                    'ride_cancellations',
                    'location_updates'
                ]
            ]
        ]);
    }

    public function sendDriverLocationUpdate(Ride $ride, array $locationData): void
    {
        // In a real implementation, you would send this via WebSocket
        // For now, we'll just log the update
        
        \Log::info("Driver Location Update for Ride {$ride->id}", [
            'ride_id' => $ride->id,
            'driver_id' => $ride->driver_id,
            'location' => $locationData,
            'timestamp' => now(),
        ]);

        // Update driver location in database
        if ($ride->driver_id) {
            DriverLocation::updateLocation(
                $ride->driver_id,
                $locationData['latitude'],
                $locationData['longitude'],
                'busy',
                $locationData
            );
        }
    }

    public function sendRideStatusUpdate(Ride $ride, string $status, array $data = []): void
    {
        // In a real implementation, you would send this via WebSocket
        // For now, we'll just log the update
        
        \Log::info("Ride Status Update for Ride {$ride->id}", [
            'ride_id' => $ride->id,
            'status' => $status,
            'data' => $data,
            'timestamp' => now(),
        ]);
    }

    public function sendStopUpdate(Ride $ride, RideStop $stop, string $action, array $data = []): void
    {
        // In a real implementation, you would send this via WebSocket
        // For now, we'll just log the update
        
        \Log::info("Stop Update for Ride {$ride->id}", [
            'ride_id' => $ride->id,
            'stop_id' => $stop->id,
            'action' => $action,
            'data' => $data,
            'timestamp' => now(),
        ]);
    }

    public function getWebSocketEvents(Request $request): JsonResponse
    {
        $events = [
            'passenger_events' => [
                'driver_location_update' => [
                    'description' => 'Real-time driver location updates',
                    'payload' => [
                        'type' => 'driver_location_update',
                        'ride_id' => 'number',
                        'driver_location' => [
                            'latitude' => 'number',
                            'longitude' => 'number',
                            'speed' => 'number',
                            'heading' => 'number'
                        ],
                        'estimated_arrival' => 'string'
                    ]
                ],
                'ride_status_update' => [
                    'description' => 'Ride status changes',
                    'payload' => [
                        'type' => 'ride_status_update',
                        'ride_id' => 'number',
                        'status' => 'string',
                        'driver' => [
                            'id' => 'number',
                            'name' => 'string',
                            'phone' => 'string'
                        ]
                    ]
                ],
                'stop_update' => [
                    'description' => 'Stop-related updates',
                    'payload' => [
                        'type' => 'stop_update',
                        'ride_id' => 'number',
                        'stop_id' => 'number',
                        'action' => 'string',
                        'stop_data' => 'object'
                    ]
                ]
            ],
            'driver_events' => [
                'new_ride_request' => [
                    'description' => 'New ride requests in area',
                    'payload' => [
                        'type' => 'new_ride_request',
                        'ride' => [
                            'id' => 'number',
                            'passenger' => [
                                'id' => 'number',
                                'name' => 'string',
                                'phone' => 'string'
                            ],
                            'pickup_address' => 'string',
                            'dropoff_address' => 'string',
                            'estimated_fare' => 'number'
                        ]
                    ]
                ],
                'ride_cancelled' => [
                    'description' => 'Ride cancellation notifications',
                    'payload' => [
                        'type' => 'ride_cancelled',
                        'ride_id' => 'number',
                        'reason' => 'string'
                    ]
                ],
                'stop_navigation' => [
                    'description' => 'Stop navigation instructions',
                    'payload' => [
                        'type' => 'stop_navigation',
                        'ride_id' => 'number',
                        'next_stop' => 'object',
                        'route_instructions' => 'array'
                    ]
                ]
            ]
        ];

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }
}
