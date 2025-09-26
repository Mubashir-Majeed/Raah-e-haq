<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send SMS message
     * 
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public static function send(string $phone, string $message): bool
    {
        try {
            // In a real application, you would integrate with SMS providers like:
            // - Twilio
            // - AWS SNS
            // - Vonage (Nexmo)
            // - Local SMS gateways
            
            // For development/testing, we'll just log the SMS
            Log::info('SMS Sent', [
                'phone' => $phone,
                'message' => $message,
                'timestamp' => now()
            ]);
            
            // Simulate SMS sending delay
            sleep(1);
            
            return true;
            
        } catch (\Exception $e) {
            Log::error('SMS sending failed', [
                'phone' => $phone,
                'message' => $message,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }
    
    /**
     * Send OTP SMS
     * 
     * @param string $phone
     * @param string $otp
     * @return bool
     */
    public static function sendOtp(string $phone, string $otp): bool
    {
        $message = "Your OTP code is: {$otp}. This code will expire in 1 minute. Do not share this code with anyone.";
        
        return self::send($phone, $message);
    }
}
