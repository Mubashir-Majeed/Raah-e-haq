@extends('layouts.admin')

@section('title', 'Audit Logs')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Audit Logs</h1>
            <p class="text-gray-600">System activity and security audit trail</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.security.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Security
            </a>
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
                    <h3 class="text-lg font-semibold text-gray-900">Filter Logs</h3>
                    <p class="text-sm text-gray-600">Search and filter audit log entries</p>
                </div>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="search" name="search" value="{{ request('search') }}" placeholder="Search logs...">
                </div>
                <div>
                    <label for="action" class="block text-sm font-medium text-gray-700 mb-2">Action</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="action" name="action">
                        <option value="">All Actions</option>
                        <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Created</option>
                        <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Updated</option>
                        <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                        <option value="login" {{ request('action') == 'login' ? 'selected' : '' }}>Login</option>
                        <option value="logout" {{ request('action') == 'logout' ? 'selected' : '' }}>Logout</option>
                        <option value="viewed" {{ request('action') == 'viewed' ? 'selected' : '' }}>Viewed</option>
                    </select>
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">User</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="user_id" name="user_id">
                        <option value="">All Users</option>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                    <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="date_from" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium">
                        <i class="fas fa-search mr-2"></i>Filter
                    </button>
                    <a href="{{ route('admin.security.audit-logs') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Audit Logs Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-list-alt text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Audit Log Entries</h3>
                        <p class="text-sm text-gray-600">System activity and user actions</p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $auditLogs->total() }} entries
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Timestamp</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">User</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Action</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Model</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Description</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Severity</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($auditLogs as $log)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $log->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $log->created_at->format('H:i:s') }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($log->user)
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $log->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $log->user->email }}</div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-500 italic">System</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($log->action === 'created') bg-green-100 text-green-800
                                    @elseif($log->action === 'updated') bg-yellow-100 text-yellow-800
                                    @elseif($log->action === 'deleted') bg-red-100 text-red-800
                                    @elseif($log->action === 'login') bg-blue-100 text-blue-800
                                    @elseif($log->action === 'logout') bg-gray-100 text-gray-800
                                    @elseif($log->action === 'viewed') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucwords($log->action) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-900">
                                    {{ $log->model_type ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $log->description }}">
                                    {{ $log->description }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($log->severity === 'critical') bg-red-100 text-red-800
                                    @elseif($log->severity === 'high') bg-orange-100 text-orange-800
                                    @elseif($log->severity === 'medium') bg-yellow-100 text-yellow-800
                                    @elseif($log->severity === 'low') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucwords($log->severity) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-clipboard-list text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500 text-lg font-medium">No audit logs found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters or check back later</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($auditLogs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $auditLogs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
