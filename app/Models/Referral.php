<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Referral extends Model
{
    protected $fillable = [
        'referrer_id',
        'referred_id',
        'referral_code',
        'status',
        'reward_amount',
        'bonus_amount',
        'reward_type',
        'level',
        'metadata',
        'completed_at',
    ];

    protected $casts = [
        'reward_amount' => 'decimal:2',
        'bonus_amount' => 'decimal:2',
        'completed_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function referred(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_id');
    }

    public function rewards(): HasMany
    {
        return $this->hasMany(ReferralReward::class);
    }

    // Static method to create referral
    public static function createReferral($referrerId, $referredId, $level = 1, $metadata = [])
    {
        $referralCode = self::generateReferralCode();
        
        return self::create([
            'referrer_id' => $referrerId,
            'referred_id' => $referredId,
            'referral_code' => $referralCode,
            'status' => 'pending',
            'level' => $level,
            'metadata' => $metadata,
        ]);
    }

    // Generate unique referral code
    public static function generateReferralCode()
    {
        do {
            $code = 'REF' . strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('referral_code', $code)->exists());
        
        return $code;
    }

    // Complete referral
    public function complete()
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Process rewards
        $this->processRewards();
    }

    // Process rewards for this referral
    public function processRewards()
    {
        $settings = ReferralSetting::getSettings();
        
        // Reward for referrer
        if ($this->level <= $settings['max_levels']) {
            $rewardAmount = $settings['level_' . $this->level . '_referrer_reward'] ?? 0;
            
            if ($rewardAmount > 0) {
                ReferralReward::create([
                    'user_id' => $this->referrer_id,
                    'referral_id' => $this->id,
                    'reward_type' => $settings['reward_type'],
                    'amount' => $rewardAmount,
                    'description' => "Level {$this->level} referral reward",
                    'status' => 'pending',
                    'level' => $this->level,
                    'expires_at' => now()->addDays((int)$settings['reward_expiry_days']),
                ]);
            }
        }

        // Bonus for referred user
        $bonusAmount = $settings['new_user_bonus'] ?? 0;
        if ($bonusAmount > 0) {
            ReferralReward::create([
                'user_id' => $this->referred_id,
                'referral_id' => $this->id,
                'reward_type' => $settings['reward_type'],
                'amount' => $bonusAmount,
                'description' => 'New user referral bonus',
                'status' => 'pending',
                'level' => 0,
                'expires_at' => now()->addDays((int)$settings['reward_expiry_days']),
            ]);
        }
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }

    // Get status label
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Pending',
            'completed' => 'Completed',
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
            default => 'Unknown',
        };
    }

    // Check if referral is completed
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    // Get referral tree (multi-level)
    public static function getReferralTree($userId, $maxLevel = 3)
    {
        $tree = [];
        $level = 1;
        
        $directReferrals = self::where('referrer_id', $userId)
            ->where('status', 'completed')
            ->with('referred')
            ->get();
        
        foreach ($directReferrals as $referral) {
            $tree[] = [
                'user' => $referral->referred,
                'level' => $level,
                'referral' => $referral,
                'children' => $level < $maxLevel ? self::getReferralTree($referral->referred_id, $maxLevel, $level + 1) : [],
            ];
        }
        
        return $tree;
    }

    // Get referral statistics
    public static function getReferralStats($userId)
    {
        return [
            'total_referrals' => self::where('referrer_id', $userId)->count(),
            'completed_referrals' => self::where('referrer_id', $userId)->where('status', 'completed')->count(),
            'pending_referrals' => self::where('referrer_id', $userId)->where('status', 'pending')->count(),
            'total_rewards' => self::where('referrer_id', $userId)->where('status', 'completed')->sum('reward_amount'),
            'level_1_referrals' => self::where('referrer_id', $userId)->where('level', 1)->count(),
            'level_2_referrals' => self::where('referrer_id', $userId)->where('level', 2)->count(),
            'level_3_referrals' => self::where('referrer_id', $userId)->where('level', 3)->count(),
        ];
    }
}
