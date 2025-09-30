<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use App\Models\Banner;
use App\Models\DailyAnalytics;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function landingStats(): JsonResponse
    {
        $stats = [
            'total_users' => User::count(),
            'total_rides' => Ride::count(),
            'active_drivers' => User::whereHas('roles', function($q){ $q->where('name', 'driver'); })->where('status', 'active')->count(),
            'daily_active_users' => DailyAnalytics::whereDate('date', today())->sum('active_users'),
            'daily_rides' => DailyAnalytics::whereDate('date', today())->sum('rides_completed'),
        ];

        return response()->json(['success' => true, 'data' => $stats]);
    }

    public function banners(): JsonResponse
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get(['id','title','subtitle','image_path','link','is_active']);

        return response()->json(['success' => true, 'data' => $banners]);
    }

    public function contact(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Optionally send an email or store as a support ticket
        try {
            Mail::raw(
                "Contact form submission\n\nName: {$data['name']}\nEmail: {$data['email']}\nSubject: {$data['subject']}\n\n{$data['message']}",
                function($m) use ($data) {
                    $m->to(config('mail.from.address'))
                      ->subject('[Contact] ' . $data['subject']);
                }
            );
        } catch (\Throwable $e) {
            // ignore mail failures for public endpoint
        }

        // Track analytics event
        AnalyticsEvent::create([
            'user_id' => null,
            'type' => 'contact_submit',
            'metadata' => $data,
        ]);

        return response()->json(['success' => true, 'message' => 'Message received. We will get back to you soon.']);
    }
}
