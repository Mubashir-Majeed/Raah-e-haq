<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use App\Models\DailyAnalytics;
use App\Models\User;
use App\Models\Ride;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function dashboard(Request $request)
    {
        $period = $request->get('period', '7'); // Default to last 7 days
        $endDate = now();
        $startDate = now()->subDays($period);
        
        // Get daily analytics for the period
        $dailyAnalytics = DailyAnalytics::getDateRange($startDate, $endDate);
        
        // Calculate totals for the period
        $totals = [
            'total_revenue' => $dailyAnalytics->sum('total_revenue'),
            'total_rides' => $dailyAnalytics->sum('total_rides'),
            'completed_rides' => $dailyAnalytics->sum('completed_rides'),
            'total_users' => $dailyAnalytics->max('total_users'),
            'active_users' => $dailyAnalytics->sum('active_users'),
            'new_users' => $dailyAnalytics->sum('new_users'),
            'total_drivers' => $dailyAnalytics->max('total_drivers'),
            'active_drivers' => $dailyAnalytics->sum('active_drivers'),
            'total_passengers' => $dailyAnalytics->max('total_passengers'),
            'active_passengers' => $dailyAnalytics->sum('active_passengers'),
        ];
        
        // Calculate averages
        $averages = [
            'average_ride_fare' => $dailyAnalytics->avg('average_ride_fare'),
            'average_ride_distance' => $dailyAnalytics->avg('average_ride_distance'),
            'average_ride_duration' => $dailyAnalytics->avg('average_ride_duration'),
            'ride_completion_rate' => $dailyAnalytics->avg('ride_completion_rate'),
        ];
        
        // Get growth percentages (compare with previous period)
        $previousStartDate = $startDate->copy()->subDays($period);
        $previousEndDate = $startDate->copy()->subDay();
        $previousAnalytics = DailyAnalytics::getDateRange($previousStartDate, $previousEndDate);
        
        $growth = [
            'revenue_growth' => $this->calculateGrowth($totals['total_revenue'], $previousAnalytics->sum('total_revenue')),
            'rides_growth' => $this->calculateGrowth($totals['total_rides'], $previousAnalytics->sum('total_rides')),
            'users_growth' => $this->calculateGrowth($totals['new_users'], $previousAnalytics->sum('new_users')),
            'drivers_growth' => $this->calculateGrowth($totals['active_drivers'], $previousAnalytics->sum('active_drivers')),
        ];
        
        // Get top performing metrics
        $topMetrics = [
            'best_day' => $dailyAnalytics->sortByDesc('total_revenue')->first(),
            'most_rides_day' => $dailyAnalytics->sortByDesc('total_rides')->first(),
            'highest_completion_rate' => $dailyAnalytics->sortByDesc('ride_completion_rate')->first(),
        ];
        
        // Get recent analytics events
        $recentEvents = AnalyticsEvent::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('admin.analytics.dashboard', compact(
            'dailyAnalytics', 'totals', 'averages', 'growth', 'topMetrics', 'recentEvents', 'period'
        ));
    }
    
    public function reports(Request $request)
    {
        $reportType = $request->get('type', 'financial');
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));
        
        $analytics = DailyAnalytics::getDateRange($startDate, $endDate);
        
        $reportData = [];
        
        switch ($reportType) {
            case 'financial':
                $reportData = $this->generateFinancialReport($analytics);
                break;
            case 'user':
                $reportData = $this->generateUserReport($analytics);
                break;
            case 'ride':
                $reportData = $this->generateRideReport($analytics);
                break;
            case 'performance':
                $reportData = $this->generatePerformanceReport($analytics);
                break;
        }
        
        return view('admin.analytics.reports', compact('reportData', 'reportType', 'startDate', 'endDate'));
    }
    
    public function events(Request $request)
    {
        $query = AnalyticsEvent::with('user');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('event_name', 'like', "%{$search}%")
                  ->orWhere('event_type', 'like', "%{$search}%")
                  ->orWhere('event_category', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by event type
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }
        
        // Filter by event category
        if ($request->filled('event_category')) {
            $query->where('event_category', $request->event_category);
        }
        
        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $events = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Get statistics
        $stats = [
            'total_events' => AnalyticsEvent::count(),
            'today_events' => AnalyticsEvent::whereDate('created_at', today())->count(),
            'unique_users' => AnalyticsEvent::distinct('user_id')->count('user_id'),
            'event_types' => AnalyticsEvent::distinct('event_type')->count('event_type'),
        ];
        
        return view('admin.analytics.events', compact('events', 'stats'));
    }
    
    public function export(Request $request)
    {
        $reportType = $request->get('type', 'financial');
        $startDate = $request->get('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->format('Y-m-d'));
        $format = $request->get('format', 'csv');
        
        $analytics = DailyAnalytics::getDateRange($startDate, $endDate);
        
        // Generate export data based on report type
        $exportData = $this->generateExportData($analytics, $reportType);
        
        switch ($format) {
            case 'excel':
                return $this->exportToExcel($exportData, $reportType, $startDate, $endDate);
            case 'pdf':
                return $this->exportToPDF($exportData, $reportType, $startDate, $endDate);
            case 'csv':
            default:
                return $this->exportToCSV($exportData, $reportType, $startDate, $endDate);
        }
    }
    
    private function exportToCSV($data, $reportType, $startDate, $endDate)
    {
        $filename = "analytics_{$reportType}_{$startDate}_to_{$endDate}.csv";
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            if (!empty($data)) {
                // Write headers
                fputcsv($file, array_keys($data[0]));
                
                // Write data
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function exportToExcel($data, $reportType, $startDate, $endDate)
    {
        $filename = "analytics_{$reportType}_{$startDate}_to_{$endDate}.xlsx";
        
        // For now, return CSV with Excel headers
        // In a real implementation, you'd use a library like PhpSpreadsheet
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            
            if (!empty($data)) {
                // Write headers
                fputcsv($file, array_keys($data[0]));
                
                // Write data
                foreach ($data as $row) {
                    fputcsv($file, $row);
                }
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    private function exportToPDF($data, $reportType, $startDate, $endDate)
    {
        $filename = "analytics_{$reportType}_{$startDate}_to_{$endDate}.pdf";
        
        // For now, return a simple HTML response
        // In a real implementation, you'd use a library like DomPDF or TCPDF
        $html = view('admin.analytics.export-pdf', compact('data', 'reportType', 'startDate', 'endDate'))->render();
        
        return response($html)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', "attachment; filename=\"{$filename}\"");
    }
    
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        
        return (($current - $previous) / $previous) * 100;
    }
    
    private function generateFinancialReport($analytics)
    {
        return [
            'total_revenue' => $analytics->sum('total_revenue'),
            'total_driver_earnings' => $analytics->sum('driver_earnings'),
            'total_platform_commission' => $analytics->sum('platform_commission'),
            'average_ride_fare' => $analytics->avg('average_ride_fare'),
            'average_driver_earning' => $analytics->avg('average_driver_earning'),
            'revenue_by_day' => $analytics->pluck('total_revenue', 'date'),
            'commission_by_day' => $analytics->pluck('platform_commission', 'date'),
        ];
    }
    
    private function generateUserReport($analytics)
    {
        return [
            'total_users' => $analytics->max('total_users'),
            'new_users' => $analytics->sum('new_users'),
            'active_users' => $analytics->sum('active_users'),
            'total_drivers' => $analytics->max('total_drivers'),
            'active_drivers' => $analytics->sum('active_drivers'),
            'total_passengers' => $analytics->max('total_passengers'),
            'active_passengers' => $analytics->sum('active_passengers'),
            'users_by_day' => $analytics->pluck('new_users', 'date'),
            'drivers_by_day' => $analytics->pluck('new_drivers', 'date'),
        ];
    }
    
    private function generateRideReport($analytics)
    {
        return [
            'total_rides' => $analytics->sum('total_rides'),
            'completed_rides' => $analytics->sum('completed_rides'),
            'cancelled_rides' => $analytics->sum('cancelled_rides'),
            'total_distance' => $analytics->sum('total_distance_km'),
            'total_duration' => $analytics->sum('total_duration_minutes'),
            'average_distance' => $analytics->avg('average_ride_distance'),
            'average_duration' => $analytics->avg('average_ride_duration'),
            'rides_by_day' => $analytics->pluck('total_rides', 'date'),
            'completion_rate_by_day' => $analytics->pluck('ride_completion_rate', 'date'),
        ];
    }
    
    private function generatePerformanceReport($analytics)
    {
        return [
            'average_completion_rate' => $analytics->avg('ride_completion_rate'),
            'average_acceptance_rate' => $analytics->avg('driver_acceptance_rate'),
            'average_wait_time' => $analytics->avg('average_wait_time_minutes'),
            'customer_satisfaction' => $analytics->avg('customer_satisfaction_score'),
            'unique_locations' => $analytics->sum('unique_locations'),
            'performance_by_day' => $analytics->map(function($item) {
                return [
                    'date' => $item->date,
                    'completion_rate' => $item->ride_completion_rate,
                    'acceptance_rate' => $item->driver_acceptance_rate,
                    'wait_time' => $item->average_wait_time_minutes,
                ];
            }),
        ];
    }
    
    private function generateExportData($analytics, $reportType)
    {
        switch ($reportType) {
            case 'financial':
                return $analytics->map(function($item) {
                    return [
                        'Date' => $item->date->format('Y-m-d'),
                        'Total Revenue' => $item->total_revenue,
                        'Driver Earnings' => $item->driver_earnings,
                        'Platform Commission' => $item->platform_commission,
                        'Average Ride Fare' => $item->average_ride_fare,
                    ];
                });
            case 'user':
                return $analytics->map(function($item) {
                    return [
                        'Date' => $item->date->format('Y-m-d'),
                        'New Users' => $item->new_users,
                        'Active Users' => $item->active_users,
                        'New Drivers' => $item->new_drivers,
                        'Active Drivers' => $item->active_drivers,
                        'New Passengers' => $item->new_passengers,
                        'Active Passengers' => $item->active_passengers,
                    ];
                });
            case 'ride':
                return $analytics->map(function($item) {
                    return [
                        'Date' => $item->date->format('Y-m-d'),
                        'Total Rides' => $item->total_rides,
                        'Completed Rides' => $item->completed_rides,
                        'Cancelled Rides' => $item->cancelled_rides,
                        'Total Distance (KM)' => $item->total_distance_km,
                        'Average Distance' => $item->average_ride_distance,
                        'Completion Rate (%)' => $item->ride_completion_rate,
                    ];
                });
            default:
                return $analytics->toArray();
        }
    }
}
