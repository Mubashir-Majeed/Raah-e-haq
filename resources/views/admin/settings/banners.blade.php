@extends('layouts.admin')

@section('title', 'Banners Management')

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
            <h1 class="text-3xl font-bold text-gray-900">Banners Management</h1>
            <p class="text-gray-600 mt-2">Manage promotional banners, announcements, and app content</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.settings.banners.create') }}" class="px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                <i class="fas fa-plus mr-2"></i>Create Banner
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
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Types</option>
                    <option value="promotion" {{ request('type') == 'promotion' ? 'selected' : '' }}>Promotion</option>
                    <option value="announcement" {{ request('type') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                    <option value="feature" {{ request('type') == 'feature' ? 'selected' : '' }}>Feature</option>
                    <option value="advertisement" {{ request('type') == 'advertisement' ? 'selected' : '' }}>Advertisement</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search banners..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Banners Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($banners as $banner)
            <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                <!-- Banner Image -->
                <div class="mb-4">
                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" 
                         class="w-full h-48 object-cover rounded-lg">
                </div>
                
                <!-- Banner Info -->
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $banner->title }}</h3>
                    @if($banner->description)
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($banner->description, 100) }}</p>
                    @endif
                    
                    <div class="flex flex-wrap gap-2 mb-3">
                        <span class="px-2 py-1 text-xs font-medium rounded-full
                            @if($banner->is_active) bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $banner->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                            {{ ucfirst($banner->type) }}
                        </span>
                        
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                            {{ ucfirst($banner->position) }}
                        </span>
                        
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                            {{ ucfirst($banner->target_audience) }}
                        </span>
                    </div>
                    
                    <div class="text-xs text-gray-500 space-y-1">
                        <p><i class="fas fa-sort mr-1"></i>Order: {{ $banner->display_order }}</p>
                        @if($banner->start_date)
                            <p><i class="fas fa-calendar-alt mr-1"></i>Start: {{ $banner->start_date->format('M d, Y') }}</p>
                        @endif
                        @if($banner->end_date)
                            <p><i class="fas fa-calendar-times mr-1"></i>End: {{ $banner->end_date->format('M d, Y') }}</p>
                        @endif
                        <p><i class="fas fa-user mr-1"></i>Created by {{ $banner->createdBy->name ?? 'System' }}</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <form method="POST" action="{{ route('admin.settings.banners.toggle', $banner) }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1 text-sm rounded-lg transition-colors duration-200
                                @if($banner->is_active) bg-red-600 text-white hover:bg-red-700
                                @else bg-green-600 text-white hover:bg-green-700
                                @endif">
                                <i class="fas fa-{{ $banner->is_active ? 'pause' : 'play' }} mr-1"></i>
                                {{ $banner->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </div>
                    
                    <div class="flex items-center space-x-1">
                        <a href="{{ route('admin.settings.banners.show', $banner) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        <form method="POST" action="{{ route('admin.settings.banners.delete', $banner) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this banner?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white text-sm rounded-lg hover:bg-red-700 transition-colors duration-200">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full stat-card rounded-2xl p-12 text-center" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-image text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Banners Found</h3>
                <p class="text-gray-600 mb-6">Get started by creating your first banner.</p>
                <a href="{{ route('admin.settings.banners.create') }}" class="px-6 py-3 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                    <i class="fas fa-plus mr-2"></i>Create Banner
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($banners->hasPages())
        <div class="mt-8">
            {{ $banners->links() }}
        </div>
    @endif
</div>
@endsection
