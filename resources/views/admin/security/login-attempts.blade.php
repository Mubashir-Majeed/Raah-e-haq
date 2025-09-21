@extends('layouts.admin')

@section('title', 'Login Attempts')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Login Attempts</h1>
            <p class="text-gray-600">Monitor and analyze user login attempts</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.security.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Security
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Attempts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-sign-in-alt text-blue-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Total Attempts</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['total_attempts']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-chart-line text-blue-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Successful Logins -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-check-circle text-green-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Successful</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['successful_logins']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-thumbs-up text-green-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Failed Attempts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-times-circle text-red-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Failed</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['failed_attempts']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-500 text-lg"></i>
                </div>
            </div>
        </div>

        <!-- Blocked Attempts -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center mb-2">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-ban text-orange-600 text-sm"></i>
                        </div>
                        <div class="text-sm font-medium text-gray-600">Blocked</div>
                    </div>
                    <div class="text-2xl font-bold text-gray-900">
                        {{ number_format($stats['blocked_attempts']) }}
                    </div>
                </div>
                <div class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-orange-500 text-lg"></i>
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
                    <h3 class="text-lg font-semibold text-gray-900">Filter Login Attempts</h3>
                    <p class="text-sm text-gray-600">Search and filter login attempt records</p>
                </div>
            </div>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                           id="search" name="search" value="{{ request('search') }}" placeholder="Search attempts...">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            id="status" name="status">
                        <option value="">All Status</option>
                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success</option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Blocked</option>
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
                    <a href="{{ route('admin.security.login-attempts') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                        <i class="fas fa-refresh mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Login Attempts Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-list-alt text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Login Attempt Records</h3>
                        <p class="text-sm text-gray-600">Detailed login attempt history</p>
                    </div>
                </div>
                <div class="text-sm text-gray-500">
                    Total: {{ $loginAttempts->total() }} attempts
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Timestamp</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">User</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">IP Address</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">User Agent</th>
                        <th class="text-left py-4 px-6 font-semibold text-gray-700">Failure Reason</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($loginAttempts as $attempt)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-6">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $attempt->attempted_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $attempt->attempted_at->format('H:i:s') }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($attempt->user)
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-blue-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $attempt->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $attempt->email }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-user-slash text-gray-600 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900">Unknown User</div>
                                            <div class="text-sm text-gray-500">{{ $attempt->email }}</div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($attempt->status === 'success') bg-green-100 text-green-800
                                    @elseif($attempt->status === 'failed') bg-red-100 text-red-800
                                    @elseif($attempt->status === 'blocked') bg-orange-100 text-orange-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    @if($attempt->status === 'success')
                                        <i class="fas fa-check-circle mr-1"></i>
                                    @elseif($attempt->status === 'failed')
                                        <i class="fas fa-times-circle mr-1"></i>
                                    @elseif($attempt->status === 'blocked')
                                        <i class="fas fa-ban mr-1"></i>
                                    @endif
                                    {{ ucwords($attempt->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-mono text-sm text-gray-600">{{ $attempt->ip_address ?? 'N/A' }}</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="text-sm text-gray-600 max-w-xs truncate" title="{{ $attempt->user_agent }}">
                                    {{ $attempt->user_agent ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                @if($attempt->failure_reason)
                                    <div class="text-sm text-red-600 max-w-xs truncate" title="{{ $attempt->failure_reason }}">
                                        {{ $attempt->failure_reason }}
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-sign-in-alt text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500 text-lg font-medium">No login attempts found</p>
                                <p class="text-gray-400 text-sm mt-1">Try adjusting your filters or check back later</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($loginAttempts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $loginAttempts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
