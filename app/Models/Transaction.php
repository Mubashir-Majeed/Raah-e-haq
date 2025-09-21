<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'user_id',
        'ride_id',
        'wallet_id',
        'type',
        'status',
        'amount',
        'fee',
        'net_amount',
        'currency',
        'payment_method',
        'payment_reference',
        'gateway_transaction_id',
        'description',
        'notes',
        'metadata',
        'processed_at',
        'failed_at',
        'processed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'metadata' => 'array',
        'processed_at' => 'datetime',
        'failed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ride(): BelongsTo
    {
        return $this->belongsTo(Ride::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Generate unique transaction ID
    public static function generateTransactionId(): string
    {
        $lastTransaction = self::orderBy('id', 'desc')->first();
        $nextNumber = $lastTransaction ? $lastTransaction->id + 1 : 1;
        return 'TXN-' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);
    }

    // Mark transaction as completed
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'processed_at' => now(),
        ]);
    }

    // Mark transaction as failed
    public function markAsFailed(string $reason = null): void
    {
        $this->update([
            'status' => 'failed',
            'failed_at' => now(),
            'notes' => $reason,
        ]);
    }

    // Check if transaction is successful
    public function isSuccessful(): bool
    {
        return $this->status === 'completed';
    }

    // Check if transaction is pending
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    // Get transaction type label
    public function getTypeLabel(): string
    {
        return match($this->type) {
            'ride_payment' => 'Ride Payment',
            'wallet_topup' => 'Wallet Top-up',
            'wallet_withdrawal' => 'Wallet Withdrawal',
            'driver_earning' => 'Driver Earning',
            'refund' => 'Refund',
            'commission' => 'Commission',
            'bonus' => 'Bonus',
            'penalty' => 'Penalty',
            default => ucfirst(str_replace('_', ' ', $this->type)),
        };
    }

    // Get status badge color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'completed' => 'green',
            'pending' => 'yellow',
            'failed' => 'red',
            'cancelled' => 'gray',
            'refunded' => 'blue',
            default => 'gray',
        };
    }
}
