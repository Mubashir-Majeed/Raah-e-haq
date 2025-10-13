<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RideStop extends Model
{
    protected $fillable = [
        'ride_id',
        'address',
        'latitude',
        'longitude',
        'stop_order',
        'status',
        'arrived_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'arrived_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class);
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'active' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            'skipped' => 'orange',
            default => 'gray',
        };
    }

    // Get status label
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'active' => 'Active',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'skipped' => 'Skipped',
            default => 'Unknown',
        };
    }

    // Check if stop is completed
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    // Check if stop is active
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // Mark stop as completed
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }

    // Mark stop as arrived
    public function markAsArrived(): void
    {
        $this->update([
            'arrived_at' => now(),
        ]);
    }

    // Get formatted address
    public function getFormattedAddress(): string
    {
        return $this->address ?: "Lat: {$this->latitude}, Lng: {$this->longitude}";
    }
}
