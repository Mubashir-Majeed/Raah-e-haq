<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverLocation extends Model
{
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'latitude',
        'longitude',
        'address',
        'speed',
        'heading',
        'accuracy',
        'status',
        'last_seen_at',
        'metadata',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'speed' => 'decimal:2',
        'heading' => 'decimal:2',
        'accuracy' => 'decimal:2',
        'last_seen_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    // Static method to update driver location
    public static function updateLocation($driverId, $latitude, $longitude, $status = 'available', $additionalData = [])
    {
        return self::create([
            'driver_id' => $driverId,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $additionalData['address'] ?? null,
            'speed' => $additionalData['speed'] ?? null,
            'heading' => $additionalData['heading'] ?? null,
            'accuracy' => $additionalData['accuracy'] ?? null,
            'status' => $status,
            'last_seen_at' => now(),
            'metadata' => $additionalData,
        ]);
    }

    // Get latest location for a driver
    public static function getLatestLocation($driverId)
    {
        return self::where('driver_id', $driverId)
            ->orderBy('last_seen_at', 'desc')
            ->first();
    }

    // Get online drivers within radius
    public static function getDriversInRadius($latitude, $longitude, $radiusKm = 10)
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        
        return self::selectRaw("
            *,
            ({$earthRadius} * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance
        ", [$latitude, $longitude, $latitude])
            ->where('status', 'available')
            ->where('last_seen_at', '>=', now()->subMinutes(5)) // Only recent locations
            ->having('distance', '<', $radiusKm)
            ->orderBy('distance')
            ->get();
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'online' => 'green',
            'available' => 'blue',
            'busy' => 'orange',
            'offline' => 'gray',
            default => 'gray',
        };
    }

    // Get status label
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'online' => 'Online',
            'available' => 'Available',
            'busy' => 'Busy',
            'offline' => 'Offline',
            default => 'Unknown',
        };
    }

    // Check if location is recent (within 5 minutes)
    public function isRecent(): bool
    {
        return $this->last_seen_at->isAfter(now()->subMinutes(5));
    }

    // Get formatted address
    public function getFormattedAddress(): string
    {
        return $this->address ?: "Lat: {$this->latitude}, Lng: {$this->longitude}";
    }
}
