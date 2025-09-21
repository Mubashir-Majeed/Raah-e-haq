@extends('layouts.admin')

@section('title', 'Security Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Security Dashboard</h1>
            <p class="text-gray-600">Monitor system security and audit activities</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Security Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Audit Logs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clipboard-list text-blue-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Audit Logs</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['total_audit_logs']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Failed Login Attempts Today -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Failed Logins Today</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['failed_login_attempts']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-red-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Active Security Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-bell text-yellow-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Active Events</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['active_security_events']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-yellow-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Critical Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-fire text-red-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Critical Events</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['critical_events']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-fire text-red-500 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.security.audit-logs') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-clipboard-list text-blue-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">Audit Logs</h3>
                    <p class="text-sm text-gray-600">View system activity logs</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.security.login-attempts') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-sign-in-alt text-green-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-green-600 transition-colors">Login Attempts</h3>
                    <p class="text-sm text-gray-600">Monitor login activities</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.security.security-events') }}" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200 group">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4 group-hover:bg-red-200 transition-colors">
                    <i class="fas fa-shield-alt text-red-600 text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-red-600 transition-colors">Security Events</h3>
                    <p class="text-sm text-gray-600">Manage security incidents</p>
                </div>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Audit Logs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clipboard-list text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Audit Logs</h3>
                            <p class="text-sm text-gray-600">Latest system activities</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.security.audit-logs') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentAuditLogs->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentAuditLogs as $log)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $log->user->name ?? 'System' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $log->action }} - {{ $log->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($log->severity === 'critical') bg-red-100 text-red-800
                                    @elseif($log->severity === 'high') bg-orange-100 text-orange-800
                                    @elseif($log->severity === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucwords($log->severity) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clipboard-list text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500">No recent audit logs</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Security Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-shield-alt text-red-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Recent Security Events</h3>
                            <p class="text-sm text-gray-600">Latest security incidents</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.security.security-events') }}" class="text-red-600 hover:text-red-700 text-sm font-medium">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentSecurityEvents->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentSecurityEvents as $event)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-exclamation-triangle text-red-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ ucwords(str_replace('_', ' ', $event->event_type)) }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $event->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($event->severity === 'critical') bg-red-100 text-red-800
                                        @elseif($event->severity === 'high') bg-orange-100 text-orange-800
                                        @elseif($event->severity === 'medium') bg-yellow-100 text-yellow-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ ucwords($event->severity) }}
                                    </span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($event->status === 'new') bg-yellow-100 text-yellow-800
                                        @elseif($event->status === 'investigating') bg-blue-100 text-blue-800
                                        @elseif($event->status === 'resolved') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucwords($event->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500">No recent security events</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection