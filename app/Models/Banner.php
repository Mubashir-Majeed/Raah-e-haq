<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'action_url',
        'action_text',
        'type',
        'position',
        'target_audience',
        'is_active',
        'start_date',
        'end_date',
        'display_order',
        'click_count',
        'view_count',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Check if banner is currently active
    public function isCurrentlyActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();
        
        if ($this->start_date && $this->start_date->isFuture()) {
            return false;
        }

        if ($this->end_date && $this->end_date->isPast()) {
            return false;
        }

        return true;
    }

    // Increment view count
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    // Increment click count
    public function incrementClickCount(): void
    {
        $this->increment('click_count');
    }

    // Get banner type color
    public function getTypeColor(): string
    {
        return match($this->type) {
            'promotion' => 'green',
            'announcement' => 'blue',
            'feature' => 'purple',
            'advertisement' => 'orange',
            default => 'gray',
        };
    }

    // Get position label
    public function getPositionLabel(): string
    {
        return match($this->position) {
            'home_top' => 'Home Top',
            'home_middle' => 'Home Middle',
            'home_bottom' => 'Home Bottom',
            'ride_complete' => 'Ride Complete',
            'profile' => 'Profile',
            default => ucfirst($this->position),
        };
    }
}
