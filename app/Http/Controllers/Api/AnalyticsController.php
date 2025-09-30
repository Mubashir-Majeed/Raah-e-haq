<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsEvent;
use App\Models\DailyAnalytics;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function dashboard(Request $request): JsonResponse
    {
        $date = $request->query('date');
        $analytics = DailyAnalytics::calculateForDate($date);
        return response()->json(['success' => true, 'data' => $analytics]);
    }

    public function events(Request $request): JsonResponse
    {
        $perPage = (int) ($request->query('per_page', 15));
        $query = AnalyticsEvent::query()->with('user:id,name,email');
        if ($type = $request->query('event_type')) { $query->where('event_type', $type); }
        if ($category = $request->query('event_category')) { $query->where('event_category', $category); }
        if ($name = $request->query('event_name')) { $query->where('event_name', $name); }
        return response()->json(['success' => true, 'data' => $query->orderByDesc('id')->paginate($perPage)]);
    }

    public function track(Request $request): JsonResponse
    {
        $data = $request->validate([
            'event_type' => 'required|string',
            'event_name' => 'required|string',
            'event_category' => 'nullable|string',
            'event_properties' => 'nullable|array',
            'value' => 'nullable|numeric',
        ]);
        $event = AnalyticsEvent::track(
            $data['event_type'],
            $data['event_name'],
            $data['event_category'] ?? 'user_behavior',
            $data['event_properties'] ?? null,
            $data['value'] ?? null,
            optional($request->user())->id
        );
        return response()->json(['success' => true, 'message' => 'Event tracked', 'data' => $event], 201);
    }

    public function export(Request $request): JsonResponse
    {
        $from = $request->query('from', now()->subDays(30)->toDateString());
        $to = $request->query('to', now()->toDateString());
        $rows = DailyAnalytics::getDateRange($from, $to);
        return response()->json(['success' => true, 'data' => $rows]);
    }
}
