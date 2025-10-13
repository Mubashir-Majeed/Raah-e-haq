<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'data',
        'read_at',
        'created_by',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Mark notification as read
    public function markAsRead(): void
    {
        $this->update(['read_at' => now()]);
    }

    // Check if notification is read
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    // Check if notification is unread
    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }

    // Scope for unread notifications
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    // Scope for read notifications
    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    // Scope for specific user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope for specific type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}