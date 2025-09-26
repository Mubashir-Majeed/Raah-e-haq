<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'otp_code',
        'expires_at',
        'is_used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];

    /**
     * Generate a new OTP for the given phone number
     */
    public static function generateForPhone(string $phone): self
    {
        // Delete any existing unused OTPs for this phone
        self::where('phone', $phone)
            ->where('is_used', false)
            ->delete();

        // Generate new OTP
        $otpCode = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        
        return self::create([
            'phone' => $phone,
            'otp_code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(1), // 1 minute expiry
        ]);
    }

    /**
     * Verify OTP for the given phone number
     */
    public static function verify(string $phone, string $otpCode): bool
    {
        $otp = self::where('phone', $phone)
            ->where('otp_code', $otpCode)
            ->where('is_used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otp) {
            $otp->update(['is_used' => true]);
            return true;
        }

        return false;
    }

    /**
     * Check if OTP is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Scope to get valid (non-expired, unused) OTPs
     */
    public function scopeValid($query)
    {
        return $query->where('is_used', false)
                    ->where('expires_at', '>', Carbon::now());
    }
}
