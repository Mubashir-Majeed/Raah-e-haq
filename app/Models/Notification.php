<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'message',
        'type',
        'target_audience',
        'target_user_ids',
        'delivery_method',
        'status',
        'scheduled_at',
        'sent_at',
        'delivery_stats',
        'image_url',
        'action_url',
        'action_text',
        'created_by',
    ];

    protected $casts = [
        'target_user_ids' => 'array',
        'delivery_stats' => 'array',
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Get target users based on audience
    public function getTargetUsers()
    {
        switch ($this->target_audience) {
            case 'all':
                return User::all();
            case 'passengers':
                return User::whereHas('roles', function($query) {
                    $query->where('name', 'passenger');
                })->get();
            case 'drivers':
                return User::whereHas('roles', function($query) {
                    $query->where('name', 'driver');
                })->get();
            case 'specific_users':
                return User::whereIn('id', $this->target_user_ids ?? [])->get();
            default:
                return collect();
        }
    }

    // Mark notification as sent
    public function markAsSent($stats = [])
    {
        $this->update([
            'status' => 'sent',
            'sent_at' => now(),
            'delivery_stats' => $stats,
        ]);
    }

    // Check if notification is ready to send
    public function isReadyToSend(): bool
    {
        if ($this->status !== 'scheduled') {
            return false;
        }

        if ($this->scheduled_at && $this->scheduled_at->isFuture()) {
            return false;
        }

        return true;
    }

    // Get notification type color
    public function getTypeColor(): string
    {
        return match($this->type) {
            'success' => 'green',
            'warning' => 'yellow',
            'error' => 'red',
            'promotion' => 'purple',
            'announcement' => 'blue',
            default => 'gray',
        };
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'sent' => 'green',
            'scheduled' => 'blue',
            'draft' => 'gray',
            'failed' => 'red',
            'cancelled' => 'yellow',
            default => 'gray',
        };
    }
}
