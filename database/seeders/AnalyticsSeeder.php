<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnalyticsEvent;
use App\Models\DailyAnalytics;
use App\Models\User;
use Carbon\Carbon;

class AnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        // Create daily analytics for the last 90 days
        for ($i = 0; $i < 90; $i++) {
            $date = Carbon::now()->subDays($i);
            
            DailyAnalytics::create([
                'date' => $date->format('Y-m-d'),
                'new_users' => rand(50, 200),
                'active_users' => rand(500, 2000),
                'total_users' => rand(1000, 5000),
                'new_drivers' => rand(10, 50),
                'active_drivers' => rand(100, 400),
                'total_drivers' => rand(200, 800),
                'new_passengers' => rand(40, 150),
                'active_passengers' => rand(400, 1600),
                'total_passengers' => rand(800, 4200),
                'total_rides' => rand(200, 800),
                'completed_rides' => rand(150, 700),
                'cancelled_rides' => rand(20, 100),
                'total_distance_km' => rand(5000, 20000),
                'total_duration_minutes' => rand(10000, 40000),
                'average_ride_distance' => rand(5, 25),
                'average_ride_duration' => rand(15, 45),
                'total_revenue' => rand(50000, 200000),
                'driver_earnings' => rand(35000, 140000),
                'platform_commission' => rand(15000, 60000),
                'average_ride_fare' => rand(200, 500),
                'average_driver_earning' => rand(150, 375),
                'ride_completion_rate' => rand(70, 95),
                'driver_acceptance_rate' => rand(60, 90),
                'average_wait_time_minutes' => rand(3, 15),
                'customer_satisfaction_score' => rand(35, 50) / 10, // 3.5 to 5.0
                'unique_locations' => rand(50, 200),
                'top_locations' => json_encode($this->getTopLocations()),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }

        // Get actual user IDs from the database
        $userIds = User::pluck('id')->toArray();
        
        // Create analytics events
        $eventTypes = [
            'user_registration',
            'user_login',
            'ride_requested',
            'ride_accepted',
            'ride_started',
            'ride_completed',
            'ride_cancelled',
            'payment_processed',
            'driver_online',
            'driver_offline',
            'support_ticket_created',
            'support_ticket_resolved',
            'app_opened',
            'app_closed',
            'feature_used',
            'error_occurred',
            'notification_sent',
            'notification_clicked',
            'search_performed',
            'filter_applied'
        ];

        $eventCategories = [
            'user_activity',
            'ride_activity',
            'payment_activity',
            'driver_activity',
            'support_activity',
            'app_activity',
            'system_activity',
            'marketing_activity'
        ];

        // Create 1000 analytics events over the last 30 days
        for ($i = 0; $i < 1000; $i++) {
            $eventType = $eventTypes[array_rand($eventTypes)];
            $category = $eventCategories[array_rand($eventCategories)];
            $createdAt = Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            // Use actual user IDs or null for system events
            $userId = null;
            if (in_array($eventType, ['user_registration', 'user_login', 'ride_requested', 'ride_accepted', 'ride_started', 'ride_completed', 'ride_cancelled', 'payment_processed', 'driver_online', 'driver_offline', 'support_ticket_created', 'support_ticket_resolved', 'app_opened', 'app_closed', 'feature_used', 'notification_sent', 'notification_clicked', 'search_performed', 'filter_applied'])) {
                $userId = !empty($userIds) ? $userIds[array_rand($userIds)] : null;
            }

            AnalyticsEvent::create([
                'user_id' => $userId,
                'event_type' => $eventType,
                'event_category' => $category,
                'event_name' => $this->getEventName($eventType),
                'event_properties' => json_encode($this->getEventProperties($eventType)),
                'page_url' => $this->getRandomPageUrl(),
                'referrer' => $this->getRandomReferrer(),
                'ip_address' => $this->generateIPAddress(),
                'user_agent' => $this->getRandomUserAgent(),
                'session_id' => 'sess_' . uniqid(),
                'value' => $this->getEventValue($eventType),
                'currency' => 'PKR',
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);
        }

        $this->command->info('Created professional analytics data for 90 days with 1000 events');
    }

    private function getTopLocations()
    {
        $locations = [
            'Jinnah International Airport' => rand(50, 200),
            'Clifton Beach' => rand(40, 180),
            'Saddar' => rand(30, 150),
            'Gulshan-e-Iqbal' => rand(25, 120),
            'North Nazimabad' => rand(20, 100),
            'Defence Housing Authority' => rand(15, 80),
            'Karachi University' => rand(10, 60),
            'Port Grand' => rand(8, 50),
            'Dolmen Mall Clifton' => rand(5, 40),
            'Hyderi Market' => rand(3, 30)
        ];
        return $locations;
    }

    private function getEventProperties($eventType)
    {
        $properties = [];
        
        switch ($eventType) {
            case 'user_registration':
                $properties = [
                    'registration_method' => ['email', 'phone', 'google', 'facebook'][array_rand([0, 1, 2, 3])],
                    'user_type' => ['passenger', 'driver'][array_rand([0, 1])],
                    'referral_code' => rand(0, 1) ? 'REF' . rand(1000, 9999) : null
                ];
                break;
                
            case 'ride_requested':
                $properties = [
                    'pickup_location' => 'Karachi, Pakistan',
                    'dropoff_location' => 'Karachi, Pakistan',
                    'vehicle_type' => ['car', 'motorcycle', 'auto'][array_rand([0, 1, 2])],
                    'estimated_fare' => rand(100, 500),
                    'distance' => rand(5, 25)
                ];
                break;
                
            case 'ride_completed':
                $properties = [
                    'actual_fare' => rand(150, 600),
                    'distance_traveled' => rand(8, 30),
                    'duration' => rand(20, 60),
                    'driver_rating' => rand(3, 5),
                    'payment_method' => ['cash', 'card', 'wallet'][array_rand([0, 1, 2])]
                ];
                break;
                
            case 'payment_processed':
                $properties = [
                    'amount' => rand(100, 1000),
                    'payment_method' => ['credit_card', 'debit_card', 'wallet', 'cash'][array_rand([0, 1, 2, 3])],
                    'transaction_id' => 'TXN' . uniqid(),
                    'status' => 'success'
                ];
                break;
                
            default:
                $properties = [
                    'timestamp' => now()->toISOString(),
                    'source' => 'mobile_app'
                ];
        }
        
        return $properties;
    }

    private function getEventName($eventType)
    {
        return match($eventType) {
            'user_registration' => 'User Registration Completed',
            'user_login' => 'User Login Successful',
            'ride_requested' => 'Ride Request Submitted',
            'ride_accepted' => 'Ride Accepted by Driver',
            'ride_started' => 'Ride Started',
            'ride_completed' => 'Ride Completed Successfully',
            'ride_cancelled' => 'Ride Cancelled',
            'payment_processed' => 'Payment Processed',
            'driver_online' => 'Driver Went Online',
            'driver_offline' => 'Driver Went Offline',
            'support_ticket_created' => 'Support Ticket Created',
            'support_ticket_resolved' => 'Support Ticket Resolved',
            'app_opened' => 'App Opened',
            'app_closed' => 'App Closed',
            'feature_used' => 'Feature Used',
            'error_occurred' => 'Error Occurred',
            'notification_sent' => 'Notification Sent',
            'notification_clicked' => 'Notification Clicked',
            'search_performed' => 'Search Performed',
            'filter_applied' => 'Filter Applied',
            default => 'Event Triggered'
        };
    }

    private function getRandomPageUrl()
    {
        $pages = [
            '/dashboard',
            '/rides',
            '/profile',
            '/settings',
            '/support',
            '/driver/dashboard',
            '/passenger/dashboard',
            '/admin/users',
            '/admin/rides',
            '/admin/analytics'
        ];
        return $pages[array_rand($pages)];
    }

    private function getRandomReferrer()
    {
        $referrers = [
            'https://google.com',
            'https://facebook.com',
            'https://instagram.com',
            'https://twitter.com',
            'https://youtube.com',
            'direct',
            'email',
            'sms'
        ];
        return $referrers[array_rand($referrers)];
    }

    private function getEventValue($eventType)
    {
        return match($eventType) {
            'ride_completed' => rand(100, 1000),
            'payment_processed' => rand(50, 500),
            'user_registration' => 0,
            'driver_online' => 0,
            'support_ticket_created' => 0,
            default => null
        };
    }

    private function generateIPAddress()
    {
        return rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
    }

    private function getRandomUserAgent()
    {
        $userAgents = [
            'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.0 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0',
            'Mozilla/5.0 (Linux; Android 11; SM-G991B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.120 Mobile Safari/537.36',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Mobile/15E148 Safari/604.1',
            'Mozilla/5.0 (Linux; Android 10; SM-A505F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.210 Mobile Safari/537.36'
        ];
        return $userAgents[array_rand($userAgents)];
    }

}