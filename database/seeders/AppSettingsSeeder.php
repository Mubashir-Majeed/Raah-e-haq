<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AppSetting;
use App\Models\Notification;
use App\Models\Banner;

class AppSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General Settings
        AppSetting::set('app_name', 'Raah-e-Haq', 'string', 'general', 'Application name');
        AppSetting::set('app_version', '1.0.0', 'string', 'general', 'Application version');
        AppSetting::set('maintenance_mode', false, 'boolean', 'general', 'Enable maintenance mode');
        AppSetting::set('support_email', 'support@raah-e-haq.com', 'string', 'general', 'Support email address');
        AppSetting::set('support_phone', '+92-300-1234567', 'string', 'general', 'Support phone number');

        // Fare Settings
        AppSetting::set('base_fare', 50, 'number', 'fare', 'Base fare in PKR');
        AppSetting::set('per_km_rate', 15, 'number', 'fare', 'Rate per kilometer in PKR');
        AppSetting::set('per_minute_rate', 2, 'number', 'fare', 'Rate per minute in PKR');
        AppSetting::set('minimum_fare', 100, 'number', 'fare', 'Minimum fare in PKR');
        AppSetting::set('surge_multiplier', 1.5, 'number', 'fare', 'Surge pricing multiplier');
        AppSetting::set('platform_commission', 0.15, 'number', 'fare', 'Platform commission percentage (0.15 = 15%)');
        AppSetting::set('driver_commission', 0.85, 'number', 'fare', 'Driver commission percentage (0.85 = 85%)');

        // Notification Settings
        AppSetting::set('push_notifications_enabled', true, 'boolean', 'notification', 'Enable push notifications');
        AppSetting::set('email_notifications_enabled', true, 'boolean', 'notification', 'Enable email notifications');
        AppSetting::set('sms_notifications_enabled', false, 'boolean', 'notification', 'Enable SMS notifications');
        AppSetting::set('notification_sound', true, 'boolean', 'notification', 'Enable notification sounds');
        AppSetting::set('ride_reminder_minutes', 5, 'number', 'notification', 'Ride reminder minutes before pickup');

        // App Settings
        AppSetting::set('max_passengers', 4, 'number', 'app', 'Maximum passengers per ride');
        AppSetting::set('ride_timeout_minutes', 10, 'number', 'app', 'Ride request timeout in minutes');
        AppSetting::set('driver_search_radius', 5, 'number', 'app', 'Driver search radius in kilometers');
        AppSetting::set('auto_assign_drivers', true, 'boolean', 'app', 'Automatically assign drivers to rides');
        AppSetting::set('allow_scheduled_rides', true, 'boolean', 'app', 'Allow scheduled rides');
        AppSetting::set('max_schedule_days', 7, 'number', 'app', 'Maximum days for scheduling rides');

        // Security Settings
        AppSetting::set('require_phone_verification', true, 'boolean', 'security', 'Require phone number verification');
        AppSetting::set('require_driver_verification', true, 'boolean', 'security', 'Require driver verification');
        AppSetting::set('max_login_attempts', 5, 'number', 'security', 'Maximum login attempts before lockout');
        AppSetting::set('session_timeout_minutes', 60, 'number', 'security', 'Session timeout in minutes');
        AppSetting::set('enable_two_factor', false, 'boolean', 'security', 'Enable two-factor authentication');

        // Create sample notifications
        Notification::create([
            'title' => 'Welcome to Raah-e-Haq!',
            'message' => 'Thank you for joining our ride-sharing platform. Enjoy safe and comfortable rides!',
            'type' => 'info',
            'target_audience' => 'all',
            'delivery_method' => 'push',
            'status' => 'sent',
            'sent_at' => now()->subDays(1),
            'delivery_stats' => ['total_users' => 50, 'sent' => 48, 'failed' => 2],
            'created_by' => 1,
        ]);

        Notification::create([
            'title' => 'New Feature: Scheduled Rides',
            'message' => 'You can now schedule your rides in advance! Book your ride up to 7 days ahead.',
            'type' => 'announcement',
            'target_audience' => 'passengers',
            'delivery_method' => 'push',
            'status' => 'scheduled',
            'scheduled_at' => now()->addHours(2),
            'created_by' => 1,
        ]);

        Notification::create([
            'title' => 'Driver Bonus Program',
            'message' => 'Complete 10 rides this week and earn a 20% bonus on your earnings!',
            'type' => 'promotion',
            'target_audience' => 'drivers',
            'delivery_method' => 'push',
            'status' => 'draft',
            'created_by' => 1,
        ]);

        // Create sample banners
        Banner::create([
            'title' => '50% Off First Ride',
            'description' => 'Get 50% discount on your first ride with Raah-e-Haq',
            'image_url' => 'https://via.placeholder.com/400x200/011c72/ffffff?text=50%25+Off+First+Ride',
            'action_url' => '/rides/new',
            'action_text' => 'Book Now',
            'type' => 'promotion',
            'position' => 'home_top',
            'target_audience' => 'passengers',
            'is_active' => true,
            'start_date' => now()->subDays(1),
            'end_date' => now()->addDays(30),
            'display_order' => 1,
            'click_count' => 25,
            'view_count' => 150,
            'created_by' => 1,
        ]);

        Banner::create([
            'title' => 'Driver Referral Program',
            'description' => 'Refer a driver and earn PKR 1000 bonus',
            'image_url' => 'https://via.placeholder.com/400x200/058a0b/ffffff?text=Driver+Referral+Program',
            'action_url' => '/referral',
            'action_text' => 'Learn More',
            'type' => 'promotion',
            'position' => 'home_middle',
            'target_audience' => 'all',
            'is_active' => true,
            'start_date' => now(),
            'end_date' => now()->addDays(60),
            'display_order' => 2,
            'click_count' => 12,
            'view_count' => 89,
            'created_by' => 1,
        ]);

        Banner::create([
            'title' => 'Safety First',
            'description' => 'All our drivers are verified and vehicles are regularly inspected',
            'image_url' => 'https://via.placeholder.com/400x200/ce0a0a/ffffff?text=Safety+First',
            'action_url' => '/safety',
            'action_text' => 'Read More',
            'type' => 'announcement',
            'position' => 'home_bottom',
            'target_audience' => 'all',
            'is_active' => true,
            'display_order' => 3,
            'click_count' => 8,
            'view_count' => 45,
            'created_by' => 1,
        ]);
    }
}
