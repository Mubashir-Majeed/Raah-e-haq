@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">User Details</h1>
            <p class="text-gray-600 mt-2">View detailed information about this user</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.users.edit', $user) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale">
                <i class="fas fa-edit mr-2"></i>Edit User
            </a>
            <a href="{{ route('admin.users.index') }}" 
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Users
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-3xl font-medium">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h3>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($user->status === 'active') bg-green-100 text-green-800
                            @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            <i class="fas fa-circle text-xs mr-2"></i>
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Phone</span>
                        <span class="text-sm text-gray-900">{{ $user->phone ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">CNIC</span>
                        <span class="text-sm text-gray-900">{{ $user->cnic ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Joined</span>
                        <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Last Updated</span>
                        <span class="text-sm text-gray-900">{{ $user->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
                
                <div class="mt-6">
                    <h4 class="text-sm font-medium text-gray-600 mb-3">Roles</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->roles as $role)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($role->name === 'admin') bg-red-100 text-red-800
                                @elseif($role->name === 'driver') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                <i class="fas fa-user-tag text-xs mr-2"></i>
                                {{ $role->display_name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Personal Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user text-blue-600 mr-3"></i>
                    Personal Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Full Name</label>
                        <p class="text-gray-900">{{ $user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Email Address</label>
                        <p class="text-gray-900">{{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Phone Number</label>
                        <p class="text-gray-900">{{ $user->phone ?? 'Not provided' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">CNIC</label>
                        <p class="text-gray-900">{{ $user->cnic ?? 'Not provided' }}</p>
                    </div>
                </div>
                
                @if($user->address)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Address</label>
                    <p class="text-gray-900">{{ $user->address }}</p>
                </div>
                @endif
            </div>
            
            <!-- Account Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-info-circle text-green-600 mr-3"></i>
                    Account Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Account Status</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($user->status === 'active') bg-green-100 text-green-800
                            @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Email Verified</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Member Since</label>
                        <p class="text-gray-900">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Last Updated</label>
                        <p class="text-gray-900">{{ $user->updated_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Role Details -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user-tag text-purple-600 mr-3"></i>
                    Role Details
                </h3>
                
                <div class="space-y-4">
                    @foreach($user->roles as $role)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-medium text-gray-900">{{ $role->display_name }}</h4>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($role->name === 'admin') bg-red-100 text-red-800
                                @elseif($role->name === 'driver') bg-green-100 text-green-800
                                @else bg-blue-100 text-blue-800
                                @endif">
                                {{ $role->name }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600">{{ $role->description }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
