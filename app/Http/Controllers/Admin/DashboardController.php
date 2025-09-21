<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ride;
use App\Models\DailyAnalytics;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $periodDays = (int) $request->get('period', 7);
        if (!in_array($periodDays, [7, 30, 90])) {
            $periodDays = 7;
        }

        $stats = [
            'total_users' => User::count(),
            'total_drivers' => User::whereHas('roles', function($query) {
                $query->where('name', 'driver');
            })->count(),
            'total_passengers' => User::whereHas('roles', function($query) {
                $query->where('name', 'passenger');
            })->count(),
            'active_users' => User::where('status', 'active')->count(),
            'pending_users' => User::where('status', 'pending')->count(),
        ];

        // Time series for charts
        $end = Carbon::today();
        $start = $end->copy()->subDays($periodDays - 1);
        $series = DailyAnalytics::getDateRange($start, $end);

        // If there is data in the system but analytics rows are missing, (re)calculate for the range
        if ($series->count() < 5 && (User::exists() || Ride::exists())) {
            $cursor = $start->copy();
            while ($cursor->lte($end)) {
                DailyAnalytics::calculateForDate($cursor->copy());
                $cursor->addDay();
            }
            $series = DailyAnalytics::getDateRange($start, $end);
        }

        $chart = [
            'labels' => $series->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'))->values(),
            'revenue' => $series->pluck('total_revenue')->map(fn($v) => (float)$v)->values(),
            'rides' => $series->pluck('total_rides')->map(fn($v) => (int)$v)->values(),
            'new_users' => $series->pluck('new_users')->map(fn($v) => (int)$v)->values(),
            'active_users' => $series->pluck('active_users')->map(fn($v) => (int)$v)->values(),
            'completed_rides' => $series->pluck('completed_rides')->map(fn($v) => (int)$v)->values(),
            'cancelled_rides' => $series->pluck('cancelled_rides')->map(fn($v) => (int)$v)->values(),
            'commission' => $series->pluck('platform_commission')->map(fn($v) => (float)$v)->values(),
            'driver_earnings' => $series->pluck('driver_earnings')->map(fn($v) => (float)$v)->values(),
        ];

        // Extra KPIs
        $kpis = [
            'total_rides' => Ride::count(),
            'completed_rides' => Ride::where('status', 'completed')->count(),
            'cancelled_rides' => Ride::where('status', 'cancelled')->count(),
            'total_revenue' => (float) Ride::where('status', 'completed')->sum('total_fare'),
            'avg_fare' => (float) Ride::where('status', 'completed')->avg('total_fare'),
        ];

        // Distribution summaries
        $roleCounts = [
            'Admins' => User::whereHas('roles', fn($q) => $q->where('name', 'admin'))->count(),
            'Drivers' => User::whereHas('roles', fn($q) => $q->where('name', 'driver'))->count(),
            'Passengers' => User::whereHas('roles', fn($q) => $q->where('name', 'passenger'))->count(),
        ];

        $rideStatusCounts = [
            'pending' => Ride::where('status', 'pending')->count(),
            'searching' => Ride::where('status', 'searching')->count(),
            'accepted' => Ride::where('status', 'accepted')->count(),
            'arrived' => Ride::where('status', 'arrived')->count(),
            'started' => Ride::where('status', 'started')->count(),
            'completed' => Ride::where('status', 'completed')->count(),
            'cancelled' => Ride::where('status', 'cancelled')->count(),
        ];

        $recent_users = User::with('roles')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_users', 'chart', 'kpis', 'roleCounts', 'rideStatusCounts', 'periodDays'));
    }
}
