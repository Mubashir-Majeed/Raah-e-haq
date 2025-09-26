<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppSetting;

class AppSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'app_name',
                'value' => 'Raah-e-Haq',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Application name',
                'is_public' => true,
            ],
            [
                'key' => 'app_version',
                'value' => '1.0.0',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Application version',
                'is_public' => true,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'boolean',
                'category' => 'general',
                'description' => 'Enable maintenance mode',
                'is_public' => false,
            ],
            [
                'key' => 'support_email',
                'value' => 'support@raah-e-haq.com',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Support email address',
                'is_public' => true,
            ],
            [
                'key' => 'support_phone',
                'value' => '+92 21 1234567',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Support phone number',
                'is_public' => true,
            ],
            [
                'key' => 'max_ride_distance',
                'value' => '50',
                'type' => 'number',
                'category' => 'general',
                'description' => 'Maximum ride distance in kilometers',
                'is_public' => false,
            ],
            [
                'key' => 'driver_commission_percentage',
                'value' => '80',
                'type' => 'number',
                'category' => 'general',
                'description' => 'Driver commission percentage',
                'is_public' => false,
            ],

            // Fare Settings
            [
                'key' => 'base_fare',
                'value' => '50',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Base fare amount in PKR',
                'is_public' => true,
            ],
            [
                'key' => 'per_km_rate',
                'value' => '25',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Rate per kilometer in PKR',
                'is_public' => true,
            ],
            [
                'key' => 'per_minute_rate',
                'value' => '2',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Rate per minute in PKR',
                'is_public' => true,
            ],
            [
                'key' => 'minimum_fare',
                'value' => '100',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Minimum fare amount in PKR',
                'is_public' => true,
            ],
            [
                'key' => 'peak_hour_multiplier',
                'value' => '1.5',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Peak hour fare multiplier',
                'is_public' => false,
            ],
            [
                'key' => 'night_charge_multiplier',
                'value' => '1.2',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Night time fare multiplier',
                'is_public' => false,
            ],
            [
                'key' => 'cancellation_fee',
                'value' => '25',
                'type' => 'number',
                'category' => 'fare',
                'description' => 'Cancellation fee in PKR',
                'is_public' => true,
            ],

            // Notification Settings
            [
                'key' => 'push_notifications_enabled',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'notification',
                'description' => 'Enable push notifications',
                'is_public' => false,
            ],
            [
                'key' => 'email_notifications_enabled',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'notification',
                'description' => 'Enable email notifications',
                'is_public' => false,
            ],
            [
                'key' => 'sms_notifications_enabled',
                'value' => '0',
                'type' => 'boolean',
                'category' => 'notification',
                'description' => 'Enable SMS notifications',
                'is_public' => false,
            ],
            [
                'key' => 'notification_sound_enabled',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'notification',
                'description' => 'Enable notification sounds',
                'is_public' => false,
            ],

            // App Settings
            [
                'key' => 'auto_accept_rides',
                'value' => '0',
                'type' => 'boolean',
                'category' => 'app',
                'description' => 'Auto accept rides for drivers',
                'is_public' => false,
            ],
            [
                'key' => 'ride_timeout_minutes',
                'value' => '5',
                'type' => 'number',
                'category' => 'app',
                'description' => 'Ride request timeout in minutes',
                'is_public' => false,
            ],
            [
                'key' => 'driver_location_update_interval',
                'value' => '30',
                'type' => 'number',
                'category' => 'app',
                'description' => 'Driver location update interval in seconds',
                'is_public' => false,
            ],
            [
                'key' => 'max_driver_distance',
                'value' => '10',
                'type' => 'number',
                'category' => 'app',
                'description' => 'Maximum distance to show drivers in kilometers',
                'is_public' => false,
            ],
            [
                'key' => 'enable_rating_system',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'app',
                'description' => 'Enable rating system',
                'is_public' => true,
            ],
            [
                'key' => 'enable_chat_system',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'app',
                'description' => 'Enable chat system between users and drivers',
                'is_public' => true,
            ],

            // Security Settings
            [
                'key' => 'max_login_attempts',
                'value' => '5',
                'type' => 'number',
                'category' => 'security',
                'description' => 'Maximum login attempts before lockout',
                'is_public' => false,
            ],
            [
                'key' => 'lockout_duration_minutes',
                'value' => '15',
                'type' => 'number',
                'category' => 'security',
                'description' => 'Account lockout duration in minutes',
                'is_public' => false,
            ],
            [
                'key' => 'require_email_verification',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'security',
                'description' => 'Require email verification for new users',
                'is_public' => false,
            ],
            [
                'key' => 'require_phone_verification',
                'value' => '1',
                'type' => 'boolean',
                'category' => 'security',
                'description' => 'Require phone verification for new users',
                'is_public' => false,
            ],
            [
                'key' => 'enable_two_factor_auth',
                'value' => '0',
                'type' => 'boolean',
                'category' => 'security',
                'description' => 'Enable two-factor authentication',
                'is_public' => false,
            ],
            [
                'key' => 'session_timeout_minutes',
                'value' => '120',
                'type' => 'number',
                'category' => 'security',
                'description' => 'Session timeout in minutes',
                'is_public' => false,
            ],
        ];

        foreach ($settings as $setting) {
            AppSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}