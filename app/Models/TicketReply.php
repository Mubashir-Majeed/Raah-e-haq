<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'message',
        'type',
        'attachments',
        'is_internal',
        'metadata',
    ];

    protected $casts = [
        'attachments' => 'array',
        'metadata' => 'array',
        'is_internal' => 'boolean',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(SupportTicket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Get type color
    public function getTypeColor(): string
    {
        return match($this->type) {
            'reply' => 'blue',
            'note' => 'gray',
            'status_change' => 'yellow',
            'assignment' => 'green',
            default => 'gray',
        };
    }

    // Get type label
    public function getTypeLabel(): string
    {
        return match($this->type) {
            'reply' => 'Reply',
            'note' => 'Note',
            'status_change' => 'Status Change',
            'assignment' => 'Assignment',
            default => 'Unknown',
        };
    }

    // Check if reply is from customer
    public function isFromCustomer(): bool
    {
        return $this->user->hasRole('passenger') || $this->user->hasRole('driver');
    }

    // Check if reply is from admin
    public function isFromAdmin(): bool
    {
        return $this->user->hasRole('admin');
    }
}
