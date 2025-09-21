<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vehicle extends Model
{
    protected $fillable = [
        'driver_id',
        'vehicle_type',
        'make',
        'model',
        'year',
        'color',
        'license_plate',
        'registration_number',
        'vehicle_images',
        'insurance_document',
        'registration_document',
        'verification_status',
        'rejection_reason',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'vehicle_images' => 'array',
        'verified_at' => 'datetime',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
