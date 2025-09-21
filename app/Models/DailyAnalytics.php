<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DailyAnalytics extends Model
{
    protected $fillable = [
        'date',
        'new_users', 'active_users', 'total_users',
        'new_drivers', 'active_drivers', 'total_drivers',
        'new_passengers', 'active_passengers', 'total_passengers',
        'total_rides', 'completed_rides', 'cancelled_rides',
        'total_distance_km', 'total_duration_minutes',
        'average_ride_distance', 'average_ride_duration',
        'total_revenue', 'driver_earnings', 'platform_commission',
        'average_ride_fare', 'average_driver_earning',
        'ride_completion_rate', 'driver_acceptance_rate',
        'average_wait_time_minutes', 'customer_satisfaction_score',
        'unique_locations', 'top_locations',
    ];

    protected $casts = [
        'date' => 'date',
        'total_distance_km' => 'decimal:2',
        'average_ride_distance' => 'decimal:2',
        'average_ride_duration' => 'decimal:2',
        'total_revenue' => 'decimal:2',
        'driver_earnings' => 'decimal:2',
        'platform_commission' => 'decimal:2',
        'average_ride_fare' => 'decimal:2',
        'average_driver_earning' => 'decimal:2',
        'ride_completion_rate' => 'decimal:2',
        'driver_acceptance_rate' => 'decimal:2',
        'average_wait_time_minutes' => 'decimal:2',
        'customer_satisfaction_score' => 'decimal:2',
        'top_locations' => 'array',
    ];

    // Static method to get or create daily analytics for a date
    public static function getOrCreateForDate($date = null)
    {
        $date = $date ?: today();
        
        return self::firstOrCreate(
            ['date' => $date],
            [
                'new_users' => 0,
                'active_users' => 0,
                'total_users' => 0,
                'new_drivers' => 0,
                'active_drivers' => 0,
                'total_drivers' => 0,
                'new_passengers' => 0,
                'active_passengers' => 0,
                'total_passengers' => 0,
                'total_rides' => 0,
                'completed_rides' => 0,
                'cancelled_rides' => 0,
                'total_distance_km' => 0,
                'total_duration_minutes' => 0,
                'average_ride_distance' => 0,
                'average_ride_duration' => 0,
                'total_revenue' => 0,
                'driver_earnings' => 0,
                'platform_commission' => 0,
                'average_ride_fare' => 0,
                'average_driver_earning' => 0,
                'ride_completion_rate' => 0,
                'driver_acceptance_rate' => 0,
                'average_wait_time_minutes' => 0,
                'customer_satisfaction_score' => 0,
                'unique_locations' => 0,
                'top_locations' => [],
            ]
        );
    }

    // Calculate and update analytics for a specific date
    public static function calculateForDate($date = null)
    {
        $date = $date ?: today();
        $analytics = self::getOrCreateForDate($date);
        
        // User metrics
        $analytics->new_users = User::whereDate('created_at', $date)->count();
        $analytics->active_users = User::whereHas('rides', function($q) use ($date) {
            $q->whereDate('created_at', $date);
        })->count();
        $analytics->total_users = User::where('created_at', '<=', $date)->count();
        
        $analytics->new_drivers = User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->whereDate('created_at', $date)->count();
        
        $analytics->active_drivers = User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->whereHas('driverRides', function($q) use ($date) {
            $q->whereDate('created_at', $date);
        })->count();
        
        $analytics->total_drivers = User::whereHas('roles', function($q) {
            $q->where('name', 'driver');
        })->where('created_at', '<=', $date)->count();
        
        $analytics->new_passengers = User::whereHas('roles', function($q) {
            $q->where('name', 'passenger');
        })->whereDate('created_at', $date)->count();
        
        $analytics->active_passengers = User::whereHas('roles', function($q) {
            $q->where('name', 'passenger');
        })->whereHas('rides', function($q) use ($date) {
            $q->whereDate('created_at', $date);
        })->count();
        
        $analytics->total_passengers = User::whereHas('roles', function($q) {
            $q->where('name', 'passenger');
        })->where('created_at', '<=', $date)->count();
        
        // Ride metrics
        $rides = Ride::whereDate('created_at', $date);
        $analytics->total_rides = $rides->count();
        $analytics->completed_rides = $rides->where('status', 'completed')->count();
        $analytics->cancelled_rides = $rides->where('status', 'cancelled')->count();
        
        $analytics->total_distance_km = $rides->where('status', 'completed')->sum('distance_km') ?: 0;
        $analytics->total_duration_minutes = $rides->where('status', 'completed')->sum('duration_minutes') ?: 0;
        
        if ($analytics->completed_rides > 0) {
            $analytics->average_ride_distance = $analytics->total_distance_km / $analytics->completed_rides;
            $analytics->average_ride_duration = $analytics->total_duration_minutes / $analytics->completed_rides;
        }
        
        // Financial metrics
        $analytics->total_revenue = $rides->where('status', 'completed')->sum('total_fare') ?: 0;
        $analytics->driver_earnings = $rides->where('status', 'completed')->sum('driver_earnings') ?: 0;
        $analytics->platform_commission = $rides->where('status', 'completed')->sum('platform_commission') ?: 0;
        
        if ($analytics->completed_rides > 0) {
            $analytics->average_ride_fare = $analytics->total_revenue / $analytics->completed_rides;
            $analytics->average_driver_earning = $analytics->driver_earnings / $analytics->completed_rides;
        }
        
        // Performance metrics
        if ($analytics->total_rides > 0) {
            $analytics->ride_completion_rate = ($analytics->completed_rides / $analytics->total_rides) * 100;
        }
        
        // Geographic metrics
        $analytics->unique_locations = $rides->distinct('pickup_address')->count();
        
        $analytics->save();
        
        return $analytics;
    }

    // Get analytics for date range
    public static function getDateRange($startDate, $endDate)
    {
        return self::whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();
    }

    // Get growth percentage
    public function getGrowthPercentage($field, $previousValue)
    {
        if ($previousValue == 0) {
            return $this->$field > 0 ? 100 : 0;
        }
        
        return (($this->$field - $previousValue) / $previousValue) * 100;
    }
}
