<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideStopResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'ride_id' => $this->ride_id,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'stop_order' => $this->stop_order,
            'status' => $this->status,
            'status_label' => $this->getStatusLabel(),
            'status_color' => $this->getStatusColor(),
            'arrived_at' => $this->arrived_at,
            'completed_at' => $this->completed_at,
            'notes' => $this->notes,
            'estimated_arrival' => $this->getEstimatedArrival(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function getEstimatedArrival(): ?string
    {
        // Simple calculation - in real app, use Google Maps API
        if ($this->ride && $this->ride->driver) {
            $distance = $this->calculateDistance(
                $this->ride->pickup_latitude,
                $this->ride->pickup_longitude,
                $this->latitude,
                $this->longitude
            );
            
            $estimatedMinutes = round($distance * 2); // Rough estimate
            return "{$estimatedMinutes} minutes";
        }
        
        return null;
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
