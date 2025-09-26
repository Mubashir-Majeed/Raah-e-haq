@extends('layouts.admin')

@section('title', 'Create Notification')

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
            <h1 class="text-3xl font-bold text-gray-900">Create Notification</h1>
            <p class="text-gray-600 mt-2">Send push notifications, email alerts, or in-app messages to users</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.settings.notifications') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-arrow-left mr-2"></i>Back to Notifications
            </a>
        </div>
    </div>

    <!-- Create Notification Form -->
    <div class="stat-card rounded-2xl p-8" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <form method="POST" action="{{ route('admin.settings.notifications.store') }}" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Notification Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                           placeholder="Enter notification title">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Notification Type *</label>
                    <select id="type" name="type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                        <option value="">Select notification type</option>
                        <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Info</option>
                        <option value="success" {{ old('type') == 'success' ? 'selected' : '' }}>Success</option>
                        <option value="warning" {{ old('type') == 'warning' ? 'selected' : '' }}>Warning</option>
                        <option value="error" {{ old('type') == 'error' ? 'selected' : '' }}>Error</option>
                        <option value="promotion" {{ old('type') == 'promotion' ? 'selected' : '' }}>Promotion</option>
                        <option value="announcement" {{ old('type') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea id="message" name="message" rows="4" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                          placeholder="Enter notification message">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Target Audience -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="target_audience" class="block text-sm font-medium text-gray-700 mb-2">Target Audience *</label>
                    <select id="target_audience" name="target_audience" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('target_audience') border-red-500 @enderror">
                        <option value="">Select target audience</option>
                        <option value="all" {{ old('target_audience') == 'all' ? 'selected' : '' }}>All Users</option>
                        <option value="passengers" {{ old('target_audience') == 'passengers' ? 'selected' : '' }}>Passengers Only</option>
                        <option value="drivers" {{ old('target_audience') == 'drivers' ? 'selected' : '' }}>Drivers Only</option>
                        <option value="specific_users" {{ old('target_audience') == 'specific_users' ? 'selected' : '' }}>Specific Users</option>
                    </select>
                    @error('target_audience')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="delivery_method" class="block text-sm font-medium text-gray-700 mb-2">Delivery Method *</label>
                    <select id="delivery_method" name="delivery_method" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('delivery_method') border-red-500 @enderror">
                        <option value="">Select delivery method</option>
                        <option value="push" {{ old('delivery_method') == 'push' ? 'selected' : '' }}>Push Notification</option>
                        <option value="in_app" {{ old('delivery_method') == 'in_app' ? 'selected' : '' }}>In-App Message</option>
                        <option value="email" {{ old('delivery_method') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="sms" {{ old('delivery_method') == 'sms' ? 'selected' : '' }}>SMS</option>
                        <option value="all" {{ old('delivery_method') == 'all' ? 'selected' : '' }}>All Methods</option>
                    </select>
                    @error('delivery_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Specific Users (conditional) -->
            <div id="specific_users_section" class="hidden">
                <label for="target_user_ids" class="block text-sm font-medium text-gray-700 mb-2">Select Users</label>
                <select id="target_user_ids" name="target_user_ids[]" multiple
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('target_user_ids') border-red-500 @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ in_array($user->id, old('target_user_ids', [])) ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('target_user_ids')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Scheduling -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="scheduled_at" class="block text-sm font-medium text-gray-700 mb-2">Schedule (Optional)</label>
                    <input type="datetime-local" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('scheduled_at') border-red-500 @enderror">
                    @error('scheduled_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Leave empty to send immediately</p>
                </div>
            </div>

            <!-- Optional Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Image URL (Optional)</label>
                    <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image_url') border-red-500 @enderror"
                           placeholder="https://example.com/image.jpg">
                    @error('image_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="action_url" class="block text-sm font-medium text-gray-700 mb-2">Action URL (Optional)</label>
                    <input type="url" id="action_url" name="action_url" value="{{ old('action_url') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('action_url') border-red-500 @enderror"
                           placeholder="https://example.com/action">
                    @error('action_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="action_text" class="block text-sm font-medium text-gray-700 mb-2">Action Button Text (Optional)</label>
                <input type="text" id="action_text" name="action_text" value="{{ old('action_text') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('action_text') border-red-500 @enderror"
                       placeholder="Learn More">
                @error('action_text')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.settings.notifications') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 gradient-primary text-white rounded-lg hover:opacity-90 transition-opacity duration-200 hover-scale">
                    <i class="fas fa-paper-plane mr-2"></i>Create Notification
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Show/hide specific users section based on target audience
    document.getElementById('target_audience').addEventListener('change', function() {
        const specificUsersSection = document.getElementById('specific_users_section');
        if (this.value === 'specific_users') {
            specificUsersSection.classList.remove('hidden');
        } else {
            specificUsersSection.classList.add('hidden');
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const targetAudience = document.getElementById('target_audience');
        const specificUsersSection = document.getElementById('specific_users_section');
        if (targetAudience.value === 'specific_users') {
            specificUsersSection.classList.remove('hidden');
        }
    });
</script>
@endsection
