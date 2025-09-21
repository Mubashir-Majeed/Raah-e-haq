@extends('layouts.admin')

@section('title', 'Security Events')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Security Events</h1>
            <p class="text-gray-600">Monitor and manage security incidents</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.security.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Security
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-shield-alt text-blue-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Events</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['total_events']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- New Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">New Events</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['new_events']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-bell text-yellow-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Critical Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-exclamation-circle text-red-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Critical</div>
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

        <!-- Resolved Events -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check-circle text-green-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Resolved</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['resolved_events']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-thumbs-up text-green-500 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-filter text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter Security Events</h3>
                    <p class="text-sm text-gray-600">Search and filter security event records</p>
                </div>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="search" name="search" value="{{ request('search') }}" placeholder="Search events...">
                </div>
                <div>
                    <label for="event_type" class="block text-sm font-medium text-gray-700 mb-2">Event Type</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="event_type" name="event_type">
                        <option value="">All Types</option>
                        <option value="suspicious_login" {{ request('event_type') == 'suspicious_login' ? 'selected' : '' }}>Suspicious Login</option>
                        <option value="multiple_failed_attempts" {{ request('event_type') == 'multiple_failed_attempts' ? 'selected' : '' }}>Multiple Failed Attempts</option>
                        <option value="unusual_activity" {{ request('event_type') == 'unusual_activity' ? 'selected' : '' }}>Unusual Activity</option>
                        <option value="data_breach" {{ request('event_type') == 'data_breach' ? 'selected' : '' }}>Data Breach</option>
                        <option value="unauthorized_access" {{ request('event_type') == 'unauthorized_access' ? 'selected' : '' }}>Unauthorized Access</option>
                    </select>
                </div>
                <div>
                    <label for="severity" class="block text-sm font-medium text-gray-700 mb-2">Severity</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="severity" name="severity">
                        <option value="">All Severities</option>
                        <option value="critical" {{ request('severity') == 'critical' ? 'selected' : '' }}>Critical</option>
                        <option value="high" {{ request('severity') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="medium" {{ request('severity') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="low" {{ request('severity') == 'low' ? 'selected' : '' }}>Low</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="status" name="status">
                        <option value="">All Status</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                        <option value="investigating" {{ request('status') == 'investigating' ? 'selected' : '' }}>Investigating</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                        <option value="false_positive" {{ request('status') == 'false_positive' ? 'selected' : '' }}>False Positive</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.security.security-events') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Security Events Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-shield-alt text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Security Event Records</h3>
                        <p class="text-sm text-gray-600">Detailed security incident history</p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $securityEvents->total() }} events
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Timestamp</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Event Type</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Severity</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Description</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">IP Address</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($securityEvents as $event)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $event->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $event->created_at->format('H:i:s') }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucwords(str_replace('_', ' ', $event->event_type)) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($event->severity === 'critical') bg-red-100 text-red-800
                                    @elseif($event->severity === 'high') bg-orange-100 text-orange-800
                                    @elseif($event->severity === 'medium') bg-yellow-100 text-yellow-800
                                    @elseif($event->severity === 'low') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    @if($event->severity === 'critical')
                                        <i class="fas fa-fire mr-1"></i>
                                    @elseif($event->severity === 'high')
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                    @elseif($event->severity === 'medium')
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                    @elseif($event->severity === 'low')
                                        <i class="fas fa-info-circle mr-1"></i>
                                    @endif
                                    {{ ucwords($event->severity) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($event->status === 'new') bg-yellow-100 text-yellow-800
                                    @elseif($event->status === 'investigating') bg-blue-100 text-blue-800
                                    @elseif($event->status === 'resolved') bg-green-100 text-green-800
                                    @elseif($event->status === 'false_positive') bg-gray-100 text-gray-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    @if($event->status === 'new')
                                        <i class="fas fa-bell mr-1"></i>
                                    @elseif($event->status === 'investigating')
                                        <i class="fas fa-search mr-1"></i>
                                    @elseif($event->status === 'resolved')
                                        <i class="fas fa-check-circle mr-1"></i>
                                    @elseif($event->status === 'false_positive')
                                        <i class="fas fa-times-circle mr-1"></i>
                                    @endif
                                    {{ ucwords($event->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $event->description }}">
                                    {{ $event->description }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-mono text-sm text-gray-600">{{ $event->ip_address ?? 'N/A' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @if($event->status !== 'resolved')
                                    <button onclick="resolveEvent({{ $event->id }})" 
                                            class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-colors text-xs font-medium">
                                        <i class="fas fa-check mr-1"></i>Resolve
                                    </button>
                                @else
                                    <span class="text-gray-400 text-xs italic">Resolved</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-shield-alt text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500 text-lg font-medium">No security events found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters or check back later</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($securityEvents->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $securityEvents->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Resolve Event Modal -->
<div id="resolveModal" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[9999] flex items-center justify-center p-4" style="backdrop-filter: blur(4px);">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md max-h-[90vh] overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Resolve Security Event</h3>
                <button onclick="closeResolveModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
        <form id="resolveForm" method="POST" class="p-6">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Resolution Status</label>
                <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="resolved">Resolved</option>
                    <option value="false_positive">False Positive</option>
                    <option value="investigating">Under Investigation</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Resolution Notes</label>
                <textarea name="resolution_notes" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                          placeholder="Add notes about the resolution..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeResolveModal()" 
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    Cancel
                </button>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Resolve Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function resolveEvent(eventId) {
    const form = document.getElementById('resolveForm');
    form.action = `/admin/security/security-events/${eventId}/resolve`;
    document.getElementById('resolveModal').classList.remove('hidden');
}

function closeResolveModal() {
    document.getElementById('resolveModal').classList.add('hidden');
}
</script>
@endsection
