<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
