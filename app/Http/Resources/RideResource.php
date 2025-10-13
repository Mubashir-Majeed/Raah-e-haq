<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ride_id' => $this->ride_id,
            'passenger_id' => $this->passenger_id,
            'driver_id' => $this->driver_id,
            'pickup_address' => $this->pickup_address,
            'dropoff_address' => $this->dropoff_address,
            'pickup_latitude' => $this->pickup_latitude,
            'pickup_longitude' => $this->pickup_longitude,
            'dropoff_latitude' => $this->dropoff_latitude,
            'dropoff_longitude' => $this->dropoff_longitude,
            'status' => $this->getStatusForApi(),
            'vehicle_type' => $this->vehicle_type,
            'passenger_count' => $this->passenger_count,
            'special_instructions' => $this->special_instructions,
            'base_fare' => $this->base_fare,
            'distance_fare' => $this->distance_fare,
            'time_fare' => $this->time_fare,
            'total_fare' => $this->total_fare,
            'driver_earnings' => $this->driver_earnings,
            'platform_commission' => $this->platform_commission,
            'distance_km' => $this->distance_km,
            'duration_minutes' => $this->duration_minutes,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'stops' => RideStopResource::collection($this->whenLoaded('stops')),
            'current_stop_index' => $this->getCurrentStopIndex(),
            'active_stops_count' => $this->getActiveStopsCount(),
            'completed_stops_count' => $this->getCompletedStopsCount(),
            'estimated_arrival' => $this->getEstimatedArrivalForNextStop(),
            'passenger' => new UserResource($this->whenLoaded('passenger')),
            'driver' => new UserResource($this->whenLoaded('driver')),
            'vehicle' => $this->whenLoaded('vehicle'),
            'requested_at' => $this->requested_at,
            'accepted_at' => $this->accepted_at,
            'arrived_at' => $this->arrived_at,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'cancelled_at' => $this->cancelled_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
