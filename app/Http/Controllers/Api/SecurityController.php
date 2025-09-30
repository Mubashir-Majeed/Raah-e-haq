<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\LoginAttempt;
use App\Models\SecurityEvent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function auditLogs(Request $request): JsonResponse
    {
        $perPage = (int) ($request->query('per_page', 15));
        $query = AuditLog::query()->with('user:id,name,email');
        if ($request->query('user_id')) { $query->where('user_id', $request->query('user_id')); }
        if ($request->query('action')) { $query->where('action', $request->query('action')); }
        if ($request->query('severity')) { $query->where('severity', $request->query('severity')); }
        return response()->json(['success' => true, 'data' => $query->orderByDesc('id')->paginate($perPage)]);
    }

    public function loginAttempts(Request $request): JsonResponse
    {
        $perPage = (int) ($request->query('per_page', 15));
        $query = LoginAttempt::query()->with('user:id,name,email');
        if ($email = $request->query('email')) { $query->where('email', $email); }
        if ($status = $request->query('status')) { $query->where('status', $status); }
        return response()->json(['success' => true, 'data' => $query->orderByDesc('id')->paginate($perPage)]);
    }

    public function securityEvents(Request $request): JsonResponse
    {
        $perPage = (int) ($request->query('per_page', 15));
        $query = SecurityEvent::query()->with('user:id,name,email');
        if ($type = $request->query('event_type')) { $query->where('event_type', $type); }
        if ($status = $request->query('status')) { $query->where('status', $status); }
        if ($severity = $request->query('severity')) { $query->where('severity', $severity); }
        return response()->json(['success' => true, 'data' => $query->orderByDesc('id')->paginate($perPage)]);
    }

    public function resolveEvent(SecurityEvent $securityEvent, Request $request): JsonResponse
    {
        $securityEvent->markAsResolved($request->input('notes'));
        return response()->json(['success' => true, 'message' => 'Security event resolved', 'data' => $securityEvent]);
    }
}
