@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<div class="fade-in">
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-primary" style="color: #011c72ff;">Edit Profile</h1>
                <p class="text-secondary mt-2" style="color: orange;">Update your account information and settings</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.show') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 hover-scale">
                    <i class="fas fa-eye mr-2"></i>View Profile
                </a>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex space-x-1 mb-6">
                <button onclick="switchTab('profile')" id="profile-tab" class="tab-button active px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2">
                    <i class="fas fa-user"></i>
                    <span>Profile Information</span>
                </button>
                <button onclick="switchTab('password')" id="password-tab" class="tab-button px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center space-x-2">
                    <i class="fas fa-key"></i>
                    <span>Change Password</span>
                </button>
            </div>

            <!-- Profile Information Tab -->
            <div id="profile-content" class="tab-content">
                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <!-- Personal Information Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-primary mb-4 flex items-center" style="color: #011c72ff;">
                            <i class="fas fa-user mr-2"></i>
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('name') border-red-500 @enderror" 
                                       required autofocus>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('email') border-red-500 @enderror" 
                                       required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-600">
                                            Your email address is unverified.
                                            <button form="send-verification" class="text-primary hover:underline font-medium">
                                                Click here to re-send the verification email.
                                            </button>
                                        </p>
                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-1 text-sm text-green-600 font-medium">
                                                A new verification link has been sent to your email address.
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('phone') border-red-500 @enderror" 
                                       required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="cnic" class="block text-sm font-medium text-gray-700 mb-2">CNIC *</label>
                                <input type="text" id="cnic" name="cnic" value="{{ old('cnic', $user->cnic) }}" 
                                       placeholder="12345-1234567-1"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('cnic') border-red-500 @enderror" 
                                       required>
                                @error('cnic')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Address Information Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-primary mb-4 flex items-center" style="color: #011c72ff;">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Address Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                                <textarea id="address" name="address" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('address') border-red-500 @enderror" 
                                          required>{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                <select id="country" name="country" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('country') border-red-500 @enderror" 
                                        required>
                                    <option value="">Select Country</option>
                                    <option value="Pakistan" {{ old('country', $user->country) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                    <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : '' }}>India</option>
                                    <option value="Bangladesh" {{ old('country', $user->country) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    <option value="Other" {{ old('country', $user->country) == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Driver Information Section (if applicable) -->
                    @if($user->hasRole('driver') || $user->vehicle_type)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-primary mb-4 flex items-center" style="color: #011c72ff;">
                            <i class="fas fa-car mr-2"></i>
                            Driver Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="license_number" class="block text-sm font-medium text-gray-700 mb-2">License Number</label>
                                <input type="text" id="license_number" name="license_number" value="{{ old('license_number', $user->license_number) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('license_number') border-red-500 @enderror">
                                @error('license_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="vehicle_type" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                                <select id="vehicle_type" name="vehicle_type" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('vehicle_type') border-red-500 @enderror">
                                    <option value="">Select Vehicle Type</option>
                                    <option value="car" {{ old('vehicle_type', $user->vehicle_type) == 'car' ? 'selected' : '' }}>Car</option>
                                    <option value="motorcycle" {{ old('vehicle_type', $user->vehicle_type) == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                                    <option value="bicycle" {{ old('vehicle_type', $user->vehicle_type) == 'bicycle' ? 'selected' : '' }}>Bicycle</option>
                                </select>
                                @error('vehicle_type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact</label>
                                <input type="tel" id="emergency_contact" name="emergency_contact" value="{{ old('emergency_contact', $user->emergency_contact) }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('emergency_contact') border-red-500 @enderror">
                                @error('emergency_contact')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="preferred_payment" class="block text-sm font-medium text-gray-700 mb-2">Preferred Payment</label>
                                <select id="preferred_payment" name="preferred_payment" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('preferred_payment') border-red-500 @enderror">
                                    <option value="">Select Payment Method</option>
                                    <option value="cash" {{ old('preferred_payment', $user->preferred_payment) == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="card" {{ old('preferred_payment', $user->preferred_payment) == 'card' ? 'selected' : '' }}>Card</option>
                                    <option value="wallet" {{ old('preferred_payment', $user->preferred_payment) == 'wallet' ? 'selected' : '' }}>Wallet</option>
                                </select>
                                @error('preferred_payment')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('profile.show') }}" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all duration-200 hover-scale font-medium" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>

                    @if (session('status') === 'profile-updated')
                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-green-800 font-medium">
                                <i class="fas fa-check-circle mr-2"></i>
                                Profile updated successfully!
                            </p>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Password Change Tab -->
            <div id="password-content" class="tab-content hidden">
                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-primary mb-4 flex items-center" style="color: #011c72ff;">
                            <i class="fas fa-key mr-2"></i>
                            Change Password
                        </h3>
                        <p class="text-gray-600 text-sm">Ensure your account is using a long, random password to stay secure.</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password *</label>
                            <input type="password" id="update_password_current_password" name="current_password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('current_password', 'updatePassword') border-red-500 @enderror" 
                                   autocomplete="current-password" required>
                            @error('current_password', 'updatePassword')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">New Password *</label>
                            <input type="password" id="update_password_password" name="password" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('password', 'updatePassword') border-red-500 @enderror" 
                                   autocomplete="new-password" required>
                            @error('password', 'updatePassword')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password *</label>
                            <input type="password" id="update_password_password_confirmation" name="password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 @error('password_confirmation', 'updatePassword') border-red-500 @enderror" 
                                   autocomplete="new-password" required>
                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                        <button type="button" onclick="switchTab('profile')" class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors duration-200">
                            Back to Profile
                        </button>
                        <button type="submit" class="px-8 py-3 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-all duration-200 hover-scale font-medium" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                            <i class="fas fa-key mr-2"></i>
                            Update Password
                        </button>
                    </div>

                    @if (session('status') === 'password-updated')
                        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-green-800 font-medium">
                                <i class="fas fa-check-circle mr-2"></i>
                                Password updated successfully!
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Verification Form (Hidden) -->
<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<style>
.tab-button {
    background: #f8fafc;
    color: #64748b;
    border: 1px solid #e2e8f0;
}

.tab-button.active {
    background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);
    color: white;
    border-color: #011c72ff;
    box-shadow: 0 4px 12px rgba(1, 28, 114, 0.3);
}

.tab-button:hover:not(.active) {
    background: #e2e8f0;
    color: #475569;
}

.tab-content {
    display: block;
}

.tab-content.hidden {
    display: none;
}
</style>

<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-content').classList.remove('hidden');
    
    // Add active class to selected button
    document.getElementById(tabName + '-tab').classList.add('active');
}
</script>
@endsection
