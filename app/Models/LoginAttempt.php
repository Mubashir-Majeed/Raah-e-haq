<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoginAttempt extends Model
{
    protected $fillable = [
        'email',
        'ip_address',
        'user_agent',
        'status',
        'failure_reason',
        'user_id',
        'attempted_at',
    ];

    protected $casts = [
        'attempted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Static method to record login attempt
    public static function record($email, $status, $failureReason = null, $user = null)
    {
        return self::create([
            'email' => $email,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'status' => $status,
            'failure_reason' => $failureReason,
            'user_id' => $user ? $user->id : null,
            'attempted_at' => now(),
        ]);
    }

    // Check if IP is blocked (too many failed attempts)
    public static function isIpBlocked($ip, $maxAttempts = 5, $timeWindow = 15)
    {
        $failedAttempts = self::where('ip_address', $ip)
            ->where('status', 'failed')
            ->where('attempted_at', '>=', now()->subMinutes($timeWindow))
            ->count();

        return $failedAttempts >= $maxAttempts;
    }

    // Check if email is blocked (too many failed attempts)
    public static function isEmailBlocked($email, $maxAttempts = 3, $timeWindow = 15)
    {
        $failedAttempts = self::where('email', $email)
            ->where('status', 'failed')
            ->where('attempted_at', '>=', now()->subMinutes($timeWindow))
            ->count();

        return $failedAttempts >= $maxAttempts;
    }

    // Get status color
    public function getStatusColor(): string
    {
        return match($this->status) {
            'success' => 'green',
            'failed' => 'red',
            'blocked' => 'orange',
            default => 'gray',
        };
    }

    // Get failure reason label
    public function getFailureReasonLabel(): string
    {
        return match($this->failure_reason) {
            'wrong_password' => 'Wrong Password',
            'user_not_found' => 'User Not Found',
            'account_locked' => 'Account Locked',
            'too_many_attempts' => 'Too Many Attempts',
            default => ucfirst(str_replace('_', ' ', $this->failure_reason ?? 'Unknown')),
        };
    }
}
