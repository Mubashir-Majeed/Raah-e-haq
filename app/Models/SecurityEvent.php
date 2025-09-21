<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SecurityEvent extends Model
{
    protected $fillable = [
        'user_id',
        'event_type',
        'severity',
        'description',
        'ip_address',
        'user_agent',
        'event_data',
        'status',
        'resolution_notes',
        'resolved_by',
        'resolved_at',
    ];

    protected $casts = [
        'event_data' => 'array',
        'resolved_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function resolvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    // Static method to create security event
    public static function createEvent($eventType, $description, $severity = 'medium', $userId = null, $eventData = null)
    {
        return self::create([
            'user_id' => $userId,
            'event_type' => $eventType,
            'severity' => $severity,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'event_data' => $eventData,
            'status' => 'new',
        ]);
    }

    // Mark event as resolved
    public function markAsResolved($notes = null, $resolvedBy = null)
    {
        $this->update([
            'status' => 'resolved',
            'resolution_notes' => $notes,
            'resolved_by' => $resolvedBy ?: auth()->id(),
            'resolved_at' => now(),
        ]);
    }

    // Get severity color
    public function getSeverityColor(): string
    {
        return match($this->severity) {
            'low' => 'green',
            'medium' => 'yellow',
            'high' => 'orange',
            'critical' => 'red',
            default => 'gray',
        };
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'new' => 'red',
            'investigating' => 'yellow',
            'resolved' => 'green',
            'false_positive' => 'gray',
            default => 'gray',
        };
    }

    // Get event type label
    public function getEventTypeLabel(): string
    {
        return match($this->event_type) {
            'suspicious_login' => 'Suspicious Login',
            'multiple_failed_attempts' => 'Multiple Failed Attempts',
            'data_breach' => 'Data Breach',
            'unauthorized_access' => 'Unauthorized Access',
            'privilege_escalation' => 'Privilege Escalation',
            'suspicious_activity' => 'Suspicious Activity',
            default => ucfirst(str_replace('_', ' ', $this->event_type)),
        };
    }
}
