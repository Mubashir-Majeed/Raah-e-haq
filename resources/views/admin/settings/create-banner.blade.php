@extends('layouts.admin')

@section('title', 'Create Banner')

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
            <h1 class="text-3xl font-bold text-gray-900">Create Banner</h1>
            <p class="text-gray-600 mt-2">Create promotional banners, announcements, and app content</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.settings.banners') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-arrow-left mr-2"></i>Back to Banners
            </a>
        </div>
    </div>

    <!-- Create Banner Form -->
    <div class="stat-card rounded-2xl p-8" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="POST" action="{{ route('admin.settings.banners.store') }}" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Banner Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                           placeholder="Enter banner title">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Banner Type *</label>
                    <select id="type" name="type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                        <option value="">Select banner type</option>
                        <option value="promotion" {{ old('type') == 'promotion' ? 'selected' : '' }}>Promotion</option>
                        <option value="announcement" {{ old('type') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                        <option value="feature" {{ old('type') == 'feature' ? 'selected' : '' }}>Feature</option>
                        <option value="advertisement" {{ old('type') == 'advertisement' ? 'selected' : '' }}>Advertisement</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                          placeholder="Enter banner description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image and Action -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Image URL *</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image_url') border-red-500 @enderror"
                           placeholder="https://example.com/banner-image.jpg">
                    @error('image_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Recommended size: 1200x400px</p>
                </div>
                
                <div>
                    <label for="action_url" class="block text-sm font-medium text-gray-700 mb-2">Action URL</label>
                    <input type="url" id="action_url" name="action_url" value="{{ old('action_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('action_url') border-red-500 @enderror"
                           placeholder="https://example.com/action">
                    @error('action_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Text -->
            <div>
                <label for="action_text" class="block text-sm font-medium text-gray-700 mb-2">Action Button Text</label>
                <input type="text" id="action_text" name="action_text" value="{{ old('action_text') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('action_text') border-red-500 @enderror"
                       placeholder="Learn More">
                @error('action_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Position and Target -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position *</label>
                    <select id="position" name="position" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('position') border-red-500 @enderror">
                        <option value="">Select position</option>
                        <option value="home_top" {{ old('position') == 'home_top' ? 'selected' : '' }}>Home Top</option>
                        <option value="home_middle" {{ old('position') == 'home_middle' ? 'selected' : '' }}>Home Middle</option>
                        <option value="home_bottom" {{ old('position') == 'home_bottom' ? 'selected' : '' }}>Home Bottom</option>
                        <option value="ride_complete" {{ old('position') == 'ride_complete' ? 'selected' : '' }}>Ride Complete</option>
                        <option value="profile" {{ old('position') == 'profile' ? 'selected' : '' }}>Profile</option>
                    </select>
                    @error('position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="target_audience" class="block text-sm font-medium text-gray-700 mb-2">Target Audience *</label>
                    <select id="target_audience" name="target_audience" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('target_audience') border-red-500 @enderror">
                        <option value="">Select target audience</option>
                        <option value="all" {{ old('target_audience') == 'all' ? 'selected' : '' }}>All Users</option>
                        <option value="passengers" {{ old('target_audience') == 'passengers' ? 'selected' : '' }}>Passengers Only</option>
                        <option value="drivers" {{ old('target_audience') == 'drivers' ? 'selected' : '' }}>Drivers Only</option>
                    </select>
                    @error('target_audience')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Scheduling -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Display Order -->
            <div>
                <label for="display_order" class="block text-sm font-medium text-gray-700 mb-2">Display Order *</label>
                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" required min="0"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('display_order') border-red-500 @enderror"
                       placeholder="0">
                @error('display_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.settings.banners') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                    <i class="fas fa-image mr-2"></i>Create Banner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
