<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ride extends Model
{
    protected $fillable = [
        'ride_id',
        'passenger_id',
        'driver_id',
        'vehicle_id',
        'pickup_address',
        'pickup_latitude',
        'pickup_longitude',
        'dropoff_address',
        'dropoff_latitude',
        'dropoff_longitude',
        'ride_type',
        'scheduled_time',
        'vehicle_type',
        'passenger_count',
        'special_instructions',
        'base_fare',
        'distance_fare',
        'time_fare',
        'total_fare',
        'driver_earnings',
        'platform_commission',
        'status',
        'cancellation_reason',
        'cancellation_note',
        'cancelled_by',
        'requested_at',
        'accepted_at',
        'arrived_at',
        'started_at',
        'completed_at',
        'cancelled_at',
        'distance_km',
        'duration_minutes',
        'payment_method',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'pickup_latitude' => 'decimal:8',
        'pickup_longitude' => 'decimal:8',
        'dropoff_latitude' => 'decimal:8',
        'dropoff_longitude' => 'decimal:8',
        'base_fare' => 'decimal:2',
        'distance_fare' => 'decimal:2',
        'time_fare' => 'decimal:2',
        'total_fare' => 'decimal:2',
        'driver_earnings' => 'decimal:2',
        'platform_commission' => 'decimal:2',
        'distance_km' => 'decimal:2',
        'scheduled_time' => 'datetime',
        'requested_at' => 'datetime',
        'accepted_at' => 'datetime',
        'arrived_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function passenger(): BelongsTo
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    public function stops(): HasMany
    {
        return $this->hasMany(RideStop::class)->orderBy('stop_order');
    }

    public function tracking(): HasMany
    {
        return $this->hasMany(RideTracking::class)->orderBy('tracked_at');
    }

    // Generate unique ride ID
    public static function generateRideId(): string
    {
        $lastRide = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastRide ? $lastRide->id + 1 : 1;
        return 'RIDE-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    // Calculate total fare
    public function calculateTotalFare(): float
    {
        return $this->base_fare + $this->distance_fare + $this->time_fare;
    }

    // Get ride duration in minutes
    public function getDuration(): ?int
    {
        if ($this->started_at && $this->completed_at) {
            return $this->started_at->diffInMinutes($this->completed_at);
        }
        return null;
    }

    // Check if ride is active
    public function isActive(): bool
    {
        return in_array($this->status, ['pending', 'searching', 'accepted', 'arrived', 'started']);
    }

    // Check if ride is completed
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    // Check if ride is cancelled
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    // Get current stop index
    public function getCurrentStopIndex(): int
    {
        $completedStops = $this->stops()->where('status', 'completed')->count();
        return $completedStops;
    }

    // Get next stop
    public function getNextStop(): ?RideStop
    {
        return $this->stops()->where('status', 'active')->orderBy('stop_order')->first();
    }

    // Get active stops count
    public function getActiveStopsCount(): int
    {
        return $this->stops()->where('status', 'active')->count();
    }

    // Get completed stops count
    public function getCompletedStopsCount(): int
    {
        return $this->stops()->where('status', 'completed')->count();
    }

    // Check if all stops are completed
    public function areAllStopsCompleted(): bool
    {
        return $this->stops()->where('status', '!=', 'completed')->count() === 0;
    }

    // Calculate total fare with stops
    public function calculateTotalFareWithStops(): float
    {
        $baseFare = $this->base_fare + $this->distance_fare + $this->time_fare;
        $stopCount = $this->stops()->where('status', '!=', 'cancelled')->count();
        $stopFee = $stopCount * 25; // PKR 25 per stop
        
        return $baseFare + $stopFee;
    }

    // Get estimated arrival time for next stop
    public function getEstimatedArrivalForNextStop(): ?string
    {
        $nextStop = $this->getNextStop();
        if (!$nextStop) {
            return null;
        }

        // Simple calculation - in real app, use Google Maps API
        $distance = $this->calculateDistance(
            $this->pickup_latitude,
            $this->pickup_longitude,
            $nextStop->latitude,
            $nextStop->longitude
        );
        
        $estimatedMinutes = round($distance * 2); // Rough estimate
        return "{$estimatedMinutes} minutes";
    }

    // Calculate distance between two points
    private function calculateDistance($lat1, $lon1, $lat2, $lon2): float
    {
        $earthRadius = 6371; // Earth's radius in kilometers
        
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }

    // Get ride status for API
    public function getStatusForApi(): string
    {
        return match($this->status) {
            'pending' => 'requested',
            'searching' => 'requested',
            'accepted' => 'accepted',
            'arrived' => 'accepted',
            'started' => 'ongoing',
            'completed' => 'completed',
            'cancelled' => 'cancelled',
            default => 'requested',
        };
    }

    // Check if ride can be modified
    public function canBeModified(): bool
    {
        return in_array($this->status, ['pending', 'searching', 'accepted']);
    }

    // Check if ride can be cancelled
    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending', 'searching', 'accepted', 'arrived']);
    }
}
