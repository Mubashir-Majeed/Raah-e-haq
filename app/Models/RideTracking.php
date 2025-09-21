<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RideTracking extends Model
{
    protected $table = 'ride_tracking';
    
    protected $fillable = [
        'ride_id',
        'driver_id',
        'latitude',
        'longitude',
        'address',
        'speed',
        'heading',
        'tracking_type',
        'tracked_at',
        'route_data',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'speed' => 'decimal:2',
        'heading' => 'decimal:2',
        'tracked_at' => 'datetime',
        'route_data' => 'array',
    ];

    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // Static method to track ride location
    public static function trackLocation($rideId, $driverId, $latitude, $longitude, $trackingType = 'en_route', $additionalData = [])
    {
        return self::create([
            'ride_id' => $rideId,
            'driver_id' => $driverId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $additionalData['address'] ?? null,
            'speed' => $additionalData['speed'] ?? null,
            'heading' => $additionalData['heading'] ?? null,
            'tracking_type' => $trackingType,
            'tracked_at' => now(),
            'route_data' => $additionalData,
        ]);
    }

    // Get ride tracking history
    public static function getRideHistory($rideId)
    {
        return self::where('ride_id', $rideId)
            ->orderBy('tracked_at')
            ->get();
    }

    // Get driver tracking for a ride
    public static function getDriverTracking($rideId, $driverId)
    {
        return self::where('ride_id', $rideId)
            ->where('driver_id', $driverId)
            ->orderBy('tracked_at')
            ->get();
    }

    // Get tracking type color
    public function getTrackingTypeColor(): string
    {
        return match($this->tracking_type) {
            'pickup' => 'blue',
            'en_route' => 'green',
            'arrived' => 'yellow',
            'started' => 'orange',
            'completed' => 'red',
            default => 'gray',
        };
    }

    // Get tracking type label
    public function getTrackingTypeLabel(): string
    {
        return match($this->tracking_type) {
            'pickup' => 'Heading to Pickup',
            'en_route' => 'En Route',
            'arrived' => 'Arrived at Pickup',
            'started' => 'Ride Started',
            'completed' => 'Ride Completed',
            default => 'Unknown',
        };
    }

    // Get formatted address
    public function getFormattedAddress(): string
    {
        return $this->address ?: "Lat: {$this->latitude}, Lng: {$this->longitude}";
    }

    // Get route data as array
    public function getRouteData(): array
    {
        return $this->route_data ?? [];
    }
}
