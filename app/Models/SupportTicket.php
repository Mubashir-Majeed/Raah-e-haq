<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicket extends Model
{
    protected $fillable = [
        'ticket_number',
        'user_id',
        'assigned_to',
        'subject',
        'description',
        'category',
        'priority',
        'status',
        'source',
        'attachments',
        'metadata',
        'resolved_at',
        'closed_at',
    ];

    protected $casts = [
        'attachments' => 'array',
        'metadata' => 'array',
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }

    // Static method to create ticket
    public static function createTicket($userId, $subject, $description, $category = 'general', $priority = 'medium', $source = 'web', $metadata = [])
    {
        $ticketNumber = self::generateTicketNumber();
        
        return self::create([
            'ticket_number' => $ticketNumber,
            'user_id' => $userId,
            'subject' => $subject,
            'description' => $description,
            'category' => $category,
            'priority' => $priority,
            'source' => $source,
            'metadata' => $metadata,
        ]);
    }

    // Generate unique ticket number
    public static function generateTicketNumber()
    {
        do {
            $number = 'TK' . date('Y') . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        } while (self::where('ticket_number', $number)->exists());
        
        return $number;
    }

    // Add reply to ticket
    public function addReply($userId, $message, $type = 'reply', $isInternal = false, $attachments = null)
    {
        return $this->replies()->create([
            'user_id' => $userId,
            'message' => $message,
            'type' => $type,
            'is_internal' => $isInternal,
            'attachments' => $attachments,
        ]);
    }

    // Update ticket status
    public function updateStatus($status, $userId = null)
    {
        $oldStatus = $this->status;
        $this->update(['status' => $status]);

        // Add status change note
        if ($userId) {
            $this->addReply(
                $userId,
                "Status changed from {$oldStatus} to {$status}",
                'status_change',
                true
            );
        }

        // Set resolved/closed timestamps
        if ($status === 'resolved' && !$this->resolved_at) {
            $this->update(['resolved_at' => now()]);
        } elseif ($status === 'closed' && !$this->closed_at) {
            $this->update(['closed_at' => now()]);
        }
    }

    // Assign ticket to admin
    public function assignTo($adminId, $assignedBy = null)
    {
        $oldAssignee = $this->assignedTo ? $this->assignedTo->name : 'Unassigned';
        $this->update(['assigned_to' => $adminId]);

        // Add assignment note
        if ($assignedBy) {
            $newAssignee = User::find($adminId);
            $this->addReply(
                $assignedBy,
                "Ticket assigned from {$oldAssignee} to {$newAssignee->name}",
                'assignment',
                true
            );
        }
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'open' => 'blue',
            'in_progress' => 'yellow',
            'pending_customer' => 'orange',
            'resolved' => 'green',
            'closed' => 'gray',
            default => 'gray',
        };
    }

    // Get status label
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'open' => 'Open',
            'in_progress' => 'In Progress',
            'pending_customer' => 'Pending Customer',
            'resolved' => 'Resolved',
            'closed' => 'Closed',
            default => 'Unknown',
        };
    }

    // Get priority color
    public function getPriorityColor(): string
    {
        return match($this->priority) {
            'low' => 'green',
            'medium' => 'blue',
            'high' => 'orange',
            'urgent' => 'red',
            default => 'gray',
        };
    }

    // Get priority label
    public function getPriorityLabel(): string
    {
        return match($this->priority) {
            'low' => 'Low',
            'medium' => 'Medium',
            'high' => 'High',
            'urgent' => 'Urgent',
            default => 'Unknown',
        };
    }

    // Get category label
    public function getCategoryLabel(): string
    {
        return match($this->category) {
            'technical' => 'Technical',
            'billing' => 'Billing',
            'account' => 'Account',
            'ride_issue' => 'Ride Issue',
            'driver_issue' => 'Driver Issue',
            'general' => 'General',
            'complaint' => 'Complaint',
            'suggestion' => 'Suggestion',
            default => 'Unknown',
        };
    }

    // Get source label
    public function getSourceLabel(): string
    {
        return match($this->source) {
            'web' => 'Web',
            'mobile_app' => 'Mobile App',
            'email' => 'Email',
            'phone' => 'Phone',
            'chat' => 'Chat',
            default => 'Unknown',
        };
    }

    // Check if ticket is open
    public function isOpen(): bool
    {
        return in_array($this->status, ['open', 'in_progress', 'pending_customer']);
    }

    // Check if ticket is resolved
    public function isResolved(): bool
    {
        return in_array($this->status, ['resolved', 'closed']);
    }

    // Get response time
    public function getResponseTime()
    {
        $firstReply = $this->replies()->where('type', 'reply')->orderBy('created_at')->first();
        if ($firstReply) {
            return $this->created_at->diffInMinutes($firstReply->created_at);
        }
        return null;
    }

    // Get resolution time
    public function getResolutionTime()
    {
        if ($this->resolved_at) {
            return $this->created_at->diffInMinutes($this->resolved_at);
        }
        return null;
    }

    // Get ticket statistics
    public static function getTicketStats()
    {
        $resolvedTickets = self::whereNotNull('resolved_at')->get();
        
        // Calculate average response time
        $totalResponseTime = 0;
        $responseTimeCount = 0;
        foreach ($resolvedTickets as $ticket) {
            $responseTime = $ticket->getResponseTime();
            if ($responseTime !== null) {
                $totalResponseTime += $responseTime;
                $responseTimeCount++;
            }
        }
        $avgResponseTime = $responseTimeCount > 0 ? $totalResponseTime / $responseTimeCount : 0;
        
        // Calculate average resolution time
        $totalResolutionTime = 0;
        $resolutionTimeCount = 0;
        foreach ($resolvedTickets as $ticket) {
            $resolutionTime = $ticket->getResolutionTime();
            if ($resolutionTime !== null) {
                $totalResolutionTime += $resolutionTime;
                $resolutionTimeCount++;
            }
        }
        $avgResolutionTime = $resolutionTimeCount > 0 ? $totalResolutionTime / $resolutionTimeCount : 0;
        
        return [
            'total_tickets' => self::count(),
            'open_tickets' => self::whereIn('status', ['open', 'in_progress', 'pending_customer'])->count(),
            'resolved_tickets' => self::where('status', 'resolved')->count(),
            'closed_tickets' => self::where('status', 'closed')->count(),
            'urgent_tickets' => self::where('priority', 'urgent')->whereIn('status', ['open', 'in_progress'])->count(),
            'avg_response_time' => round($avgResponseTime, 2),
            'avg_resolution_time' => round($avgResolutionTime, 2),
        ];
    }
}
