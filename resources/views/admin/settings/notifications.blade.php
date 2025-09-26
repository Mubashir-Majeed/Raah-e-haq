@extends('layouts.admin')

@section('title', 'Notifications Management')

@section('content')
<div class="fade-in">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Notifications Management</h1>
            <p class="text-gray-600 mt-2">Manage push notifications, email alerts, and in-app messages</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.settings.notifications.create') }}" class="px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                <i class="fas fa-plus mr-2"></i>Create Notification
            </a>
            <a href="{{ route('admin.settings.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-arrow-left mr-2"></i>Back to Settings
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="stat-card rounded-2xl p-6 mb-6" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    <option value="sent" {{ request('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="info" {{ request('type') == 'info' ? 'selected' : '' }}>Info</option>
                    <option value="success" {{ request('type') == 'success' ? 'selected' : '' }}>Success</option>
                    <option value="warning" {{ request('type') == 'warning' ? 'selected' : '' }}>Warning</option>
                    <option value="error" {{ request('type') == 'error' ? 'selected' : '' }}>Error</option>
                    <option value="promotion" {{ request('type') == 'promotion' ? 'selected' : '' }}>Promotion</option>
                    <option value="announcement" {{ request('type') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search notifications..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Notifications List -->
    <div class="space-y-6">
        @forelse($notifications as $notification)
            <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center
                                @if($notification->type == 'info') bg-blue-100 text-blue-600
                                @elseif($notification->type == 'success') bg-green-100 text-green-600
                                @elseif($notification->type == 'warning') bg-yellow-100 text-yellow-600
                                @elseif($notification->type == 'error') bg-red-100 text-red-600
                                @elseif($notification->type == 'promotion') bg-purple-100 text-purple-600
                                @else bg-gray-100 text-gray-600
                                @endif">
                                <i class="fas fa-{{ $notification->type == 'info' ? 'info-circle' : ($notification->type == 'success' ? 'check-circle' : ($notification->type == 'warning' ? 'exclamation-triangle' : ($notification->type == 'error' ? 'times-circle' : ($notification->type == 'promotion' ? 'gift' : 'bullhorn'))) }}"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $notification->title }}</h3>
                                <p class="text-sm text-gray-500">
                                    Created by {{ $notification->createdBy->name ?? 'System' }} • 
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 mb-4">{{ Str::limit($notification->message, 200) }}</p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                @if($notification->status == 'draft') bg-gray-100 text-gray-800
                                @elseif($notification->status == 'scheduled') bg-blue-100 text-blue-800
                                @elseif($notification->status == 'sent') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($notification->status) }}
                            </span>
                            
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                {{ ucfirst($notification->type) }}
                            </span>
                            
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                {{ ucfirst($notification->target_audience) }}
                            </span>
                            
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                                {{ ucfirst($notification->delivery_method) }}
                            </span>
                        </div>
                        
                        @if($notification->scheduled_at)
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-clock mr-1"></i>
                                Scheduled for {{ $notification->scheduled_at->format('M d, Y H:i') }}
                            </p>
                        @endif
                    </div>
                    
                    <div class="flex items-center space-x-2 ml-4">
                        @if($notification->status == 'draft')
                            <form method="POST" action="{{ route('admin.settings.notifications.send', $notification) }}" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-colors duration-200">
                                    <i class="fas fa-paper-plane mr-1"></i>Send
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('admin.settings.notifications.show', $notification) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-eye mr-1"></i>View
                        </a>
                        
                        <form method="POST" action="{{ route('admin.settings.notifications.delete', $notification) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this notification?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors duration-200">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="stat-card rounded-2xl p-12 text-center" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-bell text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Notifications Found</h3>
                <p class="text-gray-600 mb-6">Get started by creating your first notification.</p>
                <a href="{{ route('admin.settings.notifications.create') }}" class="px-6 py-3 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                    <i class="fas fa-plus mr-2"></i>Create Notification
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
@endsection