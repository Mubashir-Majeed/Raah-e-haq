<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReferralReward extends Model
{
    protected $fillable = [
        'user_id',
        'referral_id',
        'reward_type',
        'amount',
        'description',
        'status',
        'level',
        'credited_at',
        'expires_at',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'credited_at' => 'datetime',
        'expires_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    // Credit reward to user
    public function credit()
    {
        if ($this->status !== 'pending') {
            return false;
        }

        // Add to user's wallet
        $wallet = $this->user->wallet;
        if (!$wallet) {
            $wallet = Wallet::create([
                'user_id' => $this->user_id,
                'balance' => 0,
                'earnings' => 0,
                'status' => 'active',
                'currency' => 'PKR',
            ]);
        }

        $wallet->addFunds($this->amount, 'Referral reward');

        // Create transaction record
        Transaction::create([
            'user_id' => $this->user_id,
            'wallet_id' => $wallet->id,
            'type' => 'credit',
            'status' => 'completed',
            'amount' => $this->amount,
            'method' => 'referral_reward',
            'description' => $this->description,
            'metadata' => [
                'referral_id' => $this->referral_id,
                'level' => $this->level,
                'reward_type' => $this->reward_type,
            ],
        ]);

        $this->update([
            'status' => 'credited',
            'credited_at' => now(),
        ]);

        return true;
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'credited' => 'green',
            'expired' => 'red',
            'cancelled' => 'gray',
            default => 'gray',
        };
    }

    // Get status label
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'credited' => 'Credited',
            'expired' => 'Expired',
            'cancelled' => 'Cancelled',
            default => 'Unknown',
        };
    }

    // Get reward type label
    public function getRewardTypeLabel(): string
    {
        return match($this->reward_type) {
            'ride_credit' => 'Ride Credit',
            'cash' => 'Cash',
            'discount' => 'Discount',
            'bonus' => 'Bonus',
            default => 'Unknown',
        };
    }

    // Check if reward is expired
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    // Check if reward can be credited
    public function canBeCredited(): bool
    {
        return $this->status === 'pending' && !$this->isExpired();
    }

    // Get formatted amount
    public function getFormattedAmount(): string
    {
        return 'PKR ' . number_format($this->amount, 2);
    }
}
