@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
<div class="fade-in">
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-primary" style="color: #011c72ff;">Profile</h1>
                <p class="text-secondary mt-2" style="color: orange;">Manage your account information and settings</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-opacity-90 transition-colors duration-200 hover-scale" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </a>
            </div>
        </div>

        <!-- Profile Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                    <div class="text-center">
                        <!-- Profile Avatar -->
                        <div class="w-24 h-24 gradient-primary rounded-full flex items-center justify-center mx-auto mb-4" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                            <span class="text-white text-2xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                        
                        <!-- User Info -->
                        <h2 class="text-xl font-bold text-primary mb-2" style="color: #011c72ff;">{{ $user->name }}</h2>
                        <p class="text-secondary mb-4" style="color: orange;">{{ $user->email }}</p>
                        
                        <!-- Status Badge -->
                        @php
                            $status = $user->status ?? 'inactive';
                            $statusClass = $status === 'active' ? 'bg-green-100 text-green-800' : ($status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800');
                            $statusText = ucfirst($status);
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }} mb-4">
                            <i class="fas fa-circle text-[8px] mr-2"></i>
                            {{ $statusText }}
                        </span>
                        
                        <!-- Role Badge -->
                        @if($user->roles->count() > 0)
                            <div class="mb-4">
                                @foreach($user->roles as $role)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-user-tag mr-2"></i>
                                        {{ $role->display_name ?? $role->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        
                        <!-- Member Since -->
                        <p class="text-sm text-gray-500">
                            <i class="fas fa-calendar mr-2"></i>
                            Member since {{ $user->created_at->format('M Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    <!-- Personal Information -->
                    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-primary" style="color: #011c72ff;">Personal Information</h3>
                            <i class="fas fa-user text-primary text-xl" style="color: #011c72ff;"></i>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                                </div>
                            </div>
                            
                            @if($user->phone)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->phone }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->cnic)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">CNIC</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->cnic }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->address)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->address }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Account Information -->
                    <div class="stat-card rounded-2xl p-6 card-hover slide-in-right" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-primary" style="color: #011c72ff;">Account Information</h3>
                            <i class="fas fa-cog text-primary text-xl" style="color: #011c72ff;"></i>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Account Status</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusClass }}">
                                        <i class="fas fa-circle text-[8px] mr-2"></i>
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Verification</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    @if($user->email_verified_at)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            Verified
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            Not Verified
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Member Since</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Updated</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Driver Information (if applicable) -->
                    @if($user->hasRole('driver') || $user->vehicle_type)
                    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-primary" style="color: #011c72ff;">Driver Information</h3>
                            <i class="fas fa-car text-primary text-xl" style="color: #011c72ff;"></i>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($user->license_number)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">License Number</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->license_number }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->vehicle_type)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ ucfirst($user->vehicle_type) }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->emergency_contact)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ $user->emergency_contact }}</p>
                                </div>
                            </div>
                            @endif
                            
                            @if($user->preferred_payment)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Payment</label>
                                <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                                    <p class="text-gray-900 font-medium">{{ ucfirst($user->preferred_payment) }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-up" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-primary" style="color: #011c72ff;">Quick Actions</h3>
                <i class="fas fa-bolt text-primary text-xl" style="color: #011c72ff;"></i>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200 group">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                        <i class="fas fa-edit text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">Edit Profile</h4>
                        <p class="text-sm text-gray-500">Update your personal information</p>
                    </div>
                </a>
                
                <a href="{{ route('profile.edit') }}#password" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200 group">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                        <i class="fas fa-key text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 group-hover:text-green-600 transition-colors duration-200">Change Password</h4>
                        <p class="text-sm text-gray-500">Update your account password</p>
                    </div>
                </a>
                
                <a href="#" class="flex items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200 group">
                    <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform duration-200">
                        <i class="fas fa-bell text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 group-hover:text-purple-600 transition-colors duration-200">Notifications</h4>
                        <p class="text-sm text-gray-500">Manage notification preferences</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
