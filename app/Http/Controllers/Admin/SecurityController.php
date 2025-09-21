<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\LoginAttempt;
use App\Models\SecurityEvent;
use Illuminate\Http\Request;

class SecurityController extends Controller
{
    public function auditLogs(Request $request)
    {
        $query = AuditLog::with('user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('model_type', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filter by severity
        if ($request->filled('severity')) {
            $query->where('severity', $request->severity);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $auditLogs = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total_logs' => AuditLog::count(),
            'today_logs' => AuditLog::whereDate('created_at', today())->count(),
            'critical_events' => AuditLog::where('severity', 'critical')->count(),
            'unique_users' => AuditLog::distinct('user_id')->count('user_id'),
        ];

        return view('admin.security.audit-logs', compact('auditLogs', 'stats'));
    }

    public function loginAttempts(Request $request)
    {
        $query = LoginAttempt::with('user');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('failure_reason', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('attempted_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('attempted_at', '<=', $request->date_to);
        }

        $loginAttempts = $query->orderBy('attempted_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total_attempts' => LoginAttempt::count(),
            'successful_logins' => LoginAttempt::where('status', 'success')->count(),
            'failed_attempts' => LoginAttempt::where('status', 'failed')->count(),
            'blocked_attempts' => LoginAttempt::where('status', 'blocked')->count(),
            'unique_ips' => LoginAttempt::distinct('ip_address')->count('ip_address'),
            'today_attempts' => LoginAttempt::whereDate('attempted_at', today())->count(),
        ];

        return view('admin.security.login-attempts', compact('loginAttempts', 'stats'));
    }

    public function securityEvents(Request $request)
    {
        $query = SecurityEvent::with(['user', 'resolvedBy']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('event_type', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        // Filter by event type
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        // Filter by severity
        if ($request->filled('severity')) {
            $query->where('severity', $request->severity);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $securityEvents = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get statistics
        $stats = [
            'total_events' => SecurityEvent::count(),
            'new_events' => SecurityEvent::where('status', 'new')->count(),
            'critical_events' => SecurityEvent::where('severity', 'critical')->count(),
            'resolved_events' => SecurityEvent::where('status', 'resolved')->count(),
            'today_events' => SecurityEvent::whereDate('created_at', today())->count(),
        ];

        return view('admin.security.security-events', compact('securityEvents', 'stats'));
    }

    public function resolveSecurityEvent(Request $request, SecurityEvent $securityEvent)
    {
        $request->validate([
            'status' => 'required|in:resolved,false_positive,investigating',
            'resolution_notes' => 'nullable|string|max:1000',
        ]);

        $securityEvent->update([
            'status' => $request->status,
            'resolution_notes' => $request->resolution_notes,
            'resolved_by' => auth()->id(),
            'resolved_at' => $request->status === 'resolved' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Security event updated successfully!');
    }

    public function securityDashboard()
    {
        // Recent audit logs
        $recentAuditLogs = AuditLog::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Recent login attempts
        $recentLoginAttempts = LoginAttempt::with('user')
            ->orderBy('attempted_at', 'desc')
            ->limit(10)
            ->get();

        // Recent security events
        $recentSecurityEvents = SecurityEvent::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Security statistics
        $stats = [
            'total_audit_logs' => AuditLog::count(),
            'failed_login_attempts' => LoginAttempt::where('status', 'failed')->whereDate('attempted_at', today())->count(),
            'active_security_events' => SecurityEvent::whereIn('status', ['new', 'investigating'])->count(),
            'critical_events' => SecurityEvent::where('severity', 'critical')->where('status', 'new')->count(),
            'unique_ips_today' => LoginAttempt::whereDate('attempted_at', today())->distinct('ip_address')->count('ip_address'),
            'admin_actions_today' => AuditLog::whereHas('user.roles', function($q) {
                $q->where('name', 'admin');
            })->whereDate('created_at', today())->count(),
        ];

        return view('admin.security.dashboard', compact('recentAuditLogs', 'recentLoginAttempts', 'recentSecurityEvents', 'stats'));
    }
}
