<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'description',
        'type',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Get all settings as array
    public static function getSettings()
    {
        $settings = self::where('is_active', true)->pluck('value', 'key')->toArray();
        
        // Default settings
        $defaults = [
            'max_levels' => 3,
            'reward_type' => 'ride_credit',
            'new_user_bonus' => 100,
            'level_1_referrer_reward' => 50,
            'level_2_referrer_reward' => 25,
            'level_3_referrer_reward' => 10,
            'reward_expiry_days' => 30,
            'min_rides_for_completion' => 1,
            'referral_code_length' => 8,
        ];
        
        return array_merge($defaults, $settings);
    }

    // Get specific setting
    public static function getSetting($key, $default = null)
    {
        $setting = self::where('key', $key)->where('is_active', true)->first();
        return $setting ? $setting->value : $default;
    }

    // Set setting
    public static function setSetting($key, $value, $description = null, $type = 'string')
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description,
                'type' => $type,
                'is_active' => true,
            ]
        );
    }

    // Get formatted value based on type
    public function getFormattedValue()
    {
        switch ($this->type) {
            case 'number':
                return (float) $this->value;
            case 'boolean':
                return (bool) $this->value;
            case 'json':
                return json_decode($this->value, true);
            default:
                return $this->value;
        }
    }
}
