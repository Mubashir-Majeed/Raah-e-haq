@extends('layouts.admin')

@section('title', 'Create Support Ticket')

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
            <h1 class="text-3xl font-bold text-gray-900">Create Support Ticket</h1>
            <p class="text-gray-600 mt-2">Create a new support ticket for a customer</p>
        </div>
        <a href="{{ route('admin.support-tickets.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
            <i class="fas fa-arrow-left mr-2"></i>Back to Tickets
        </a>
    </div>

    <!-- Create Ticket Form -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200">
            <form method="POST" action="{{ route('admin.support-tickets.store') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Customer Selection -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Customer *
                        </label>
                        <select name="user_id" id="user_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Select Customer</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }}) - {{ ucfirst($user->roles->first()->name ?? 'N/A') }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tags mr-2"></i>Category *
                        </label>
                        <select name="category" id="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Select Category</option>
                            <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>Technical Support</option>
                            <option value="billing" {{ old('category') == 'billing' ? 'selected' : '' }}>Billing & Payments</option>
                            <option value="account" {{ old('category') == 'account' ? 'selected' : '' }}>Account Issues</option>
                            <option value="ride_issue" {{ old('category') == 'ride_issue' ? 'selected' : '' }}>Ride Issues</option>
                            <option value="driver_issue" {{ old('category') == 'driver_issue' ? 'selected' : '' }}>Driver Issues</option>
                            <option value="general" {{ old('category') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                            <option value="complaint" {{ old('category') == 'complaint' ? 'selected' : '' }}>Complaints</option>
                            <option value="suggestion" {{ old('category') == 'suggestion' ? 'selected' : '' }}>Suggestions</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Priority *
                        </label>
                        <select name="priority" id="priority" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Select Priority</option>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('priority')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Source -->
                    <div>
                        <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-source mr-2"></i>Source *
                        </label>
                        <select name="source" id="source" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Select Source</option>
                            <option value="web" {{ old('source') == 'web' ? 'selected' : '' }}>Web</option>
                            <option value="mobile_app" {{ old('source') == 'mobile_app' ? 'selected' : '' }}>Mobile App</option>
                            <option value="email" {{ old('source') == 'email' ? 'selected' : '' }}>Email</option>
                            <option value="phone" {{ old('source') == 'phone' ? 'selected' : '' }}>Phone</option>
                            <option value="chat" {{ old('source') == 'chat' ? 'selected' : '' }}>Chat</option>
                        </select>
                        @error('source')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-heading mr-2"></i>Subject *
                    </label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter ticket subject" required>
                    @error('subject')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-align-left mr-2"></i>Description *
                    </label>
                    <textarea name="description" id="description" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Describe the issue or inquiry in detail" required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Assignment -->
                <div>
                    <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user-tie mr-2"></i>Assign To (Optional)
                    </label>
                    <select name="assigned_to" id="assigned_to" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Unassigned</option>
                        @foreach($admins as $admin)
                            <option value="{{ $admin->id }}" {{ old('assigned_to') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->name }} ({{ $admin->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('assigned_to')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Information -->
                <div>
                    <label for="metadata" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Additional Information (Optional)
                    </label>
                    <div class="space-y-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="device_info" class="block text-sm text-gray-600 mb-1">Device Information</label>
                                <input type="text" name="metadata[device_info]" id="device_info" value="{{ old('metadata.device_info') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., iPhone 14, Android 13">
                            </div>
                            <div>
                                <label for="app_version" class="block text-sm text-gray-600 mb-1">App Version</label>
                                <input type="text" name="metadata[app_version]" id="app_version" value="{{ old('metadata.app_version') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., 1.2.3">
                            </div>
                        </div>
                        <div>
                            <label for="os_version" class="block text-sm text-gray-600 mb-1">OS Version</label>
                            <input type="text" name="metadata[os_version]" id="os_version" value="{{ old('metadata.os_version') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., iOS 17.0, Android 13">
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.support-tickets.index') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 hover-scale">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                        <i class="fas fa-plus mr-2"></i>Create Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
