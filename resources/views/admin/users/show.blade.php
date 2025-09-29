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
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Date of Birth</label>
                        <p class="text-gray-900">{{ $user->date_of_birth ? $user->date_of_birth->format('M d, Y') : 'Not provided' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Gender</label>
                        <p class="text-gray-900">{{ $user->gender ? ucfirst($user->gender) : 'Not provided' }}</p>
                    </div>
                </div>
                
                @if($user->address)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Address</label>
                    <p class="text-gray-900">{{ $user->address }}</p>
                </div>
                @endif
                
                @if($user->emergency_contact || $user->emergency_contact_name || $user->emergency_contact_relation)
                <div class="mt-6">
                    <h4 class="text-md font-semibold text-gray-900 mb-4">Emergency Contact</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($user->emergency_contact)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Contact Number</label>
                            <p class="text-gray-900">{{ $user->emergency_contact }}</p>
                        </div>
                        @endif
                        
                        @if($user->emergency_contact_name)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Contact Name</label>
                            <p class="text-gray-900">{{ $user->emergency_contact_name }}</p>
                        </div>
                        @endif
                        
                        @if($user->emergency_contact_relation)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Relation</label>
                            <p class="text-gray-900">{{ ucfirst($user->emergency_contact_relation) }}</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                @if($user->bio)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Bio</label>
                    <p class="text-gray-900">{{ $user->bio }}</p>
                </div>
                @endif
                
                @if($user->languages)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">Languages Spoken</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(json_decode($user->languages, true) as $language)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($language) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Document Images -->
            @if($user->cnic_front_image || $user->cnic_back_image || $user->profile_image)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-id-card text-indigo-600 mr-3"></i>
                    Document Images
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if($user->cnic_front_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">CNIC Front</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->cnic_front_image) }}" 
                                 alt="CNIC Front" 
                                 class="w-full h-32 object-cover rounded"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div style="display:none;" class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">
                                Image not found
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($user->cnic_back_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">CNIC Back</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->cnic_back_image) }}" 
                                 alt="CNIC Back" 
                                 class="w-full h-32 object-cover rounded"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div style="display:none;" class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">
                                Image not found
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($user->profile_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Profile Picture</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->profile_image) }}" 
                                 alt="Profile Picture" 
                                 class="w-full h-32 object-cover rounded"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div style="display:none;" class="w-full h-32 bg-gray-100 flex items-center justify-center text-gray-500">
                                Image not found
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
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
            
            @if($user->hasRole('driver'))
            <!-- Driver License Information -->
            @if($user->license_number || $user->license_type || $user->license_expiry_date || $user->driving_experience)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-id-card text-orange-600 mr-3"></i>
                    License Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($user->license_number)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">License Number</label>
                        <p class="text-gray-900">{{ $user->license_number }}</p>
                    </div>
                    @endif
                    
                    @if($user->license_type)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">License Type</label>
                        <p class="text-gray-900">{{ $user->license_type }}</p>
                    </div>
                    @endif
                    
                    @if($user->license_expiry_date)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">License Expiry Date</label>
                        <p class="text-gray-900">{{ $user->license_expiry_date->format('M d, Y') }}</p>
                    </div>
                    @endif
                    
                    @if($user->driving_experience)
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Driving Experience</label>
                        <p class="text-gray-900">{{ $user->driving_experience }}</p>
                    </div>
                    @endif
                </div>
                
                @if($user->license_image)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-600 mb-2">License Image</label>
                    <div class="border border-gray-200 rounded-lg p-2 max-w-xs">
                        <img src="{{ asset('storage/' . str_replace('public/uploads/', 'uploads/', $user->license_image)) }}" 
                             alt="License Image" 
                             class="w-full h-32 object-cover rounded">
                    </div>
                </div>
                @endif
            </div>
            @endif
            
            <!-- Banking Information -->
            @if($user->bank_account_number || $user->bank_name || $user->bank_branch)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-university text-green-600 mr-3"></i>
                    Banking Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($user->bank_account_number)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Bank Account Number</label>
                        <p class="text-gray-900">{{ $user->bank_account_number }}</p>
                    </div>
                    @endif
                    
                    @if($user->bank_name)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Bank Name</label>
                        <p class="text-gray-900">{{ $user->bank_name }}</p>
                    </div>
                    @endif
                    
                    @if($user->bank_branch)
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Bank Branch</label>
                        <p class="text-gray-900">{{ $user->bank_branch }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            <!-- Vehicle Information -->
            @if($user->vehicles && $user->vehicles->count() > 0)
                @foreach($user->vehicles as $vehicle)
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-car text-blue-600 mr-3"></i>
                        Vehicle Information
                        @if($user->vehicles->count() > 1)
                        <span class="ml-2 text-sm text-gray-500">(Vehicle {{ $loop->iteration }})</span>
                        @endif
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Type</label>
                            <p class="text-gray-900">{{ ucfirst($vehicle->vehicle_type) }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Make</label>
                            <p class="text-gray-900">{{ $vehicle->make }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Model</label>
                            <p class="text-gray-900">{{ $vehicle->model }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Year</label>
                            <p class="text-gray-900">{{ $vehicle->year }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Color</label>
                            <p class="text-gray-900">{{ $vehicle->color }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">License Plate</label>
                            <p class="text-gray-900">{{ $vehicle->license_plate }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Registration Number</label>
                            <p class="text-gray-900">{{ $vehicle->registration_number }}</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">Verification Status</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($vehicle->verification_status === 'approved') bg-green-100 text-green-800
                                @elseif($vehicle->verification_status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                <i class="fas fa-circle text-xs mr-2"></i>
                                {{ ucfirst($vehicle->verification_status) }}
                            </span>
                        </div>
                    </div>
                    
                    @if($vehicle->rejection_reason)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-600 mb-2">Rejection Reason</label>
                        <p class="text-red-600 bg-red-50 p-3 rounded-lg">{{ $vehicle->rejection_reason }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            @elseif($user->vehicle_type || $user->vehicle_make || $user->vehicle_model || $user->vehicle_year || $user->vehicle_color || $user->license_plate || $user->registration_number)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-car text-blue-600 mr-3"></i>
                    Vehicle Information (Legacy Data)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($user->vehicle_type)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Type</label>
                        <p class="text-gray-900">{{ ucfirst($user->vehicle_type) }}</p>
                    </div>
                    @endif
                    
                    @if($user->vehicle_make)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Make</label>
                        <p class="text-gray-900">{{ $user->vehicle_make }}</p>
                    </div>
                    @endif
                    
                    @if($user->vehicle_model)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Model</label>
                        <p class="text-gray-900">{{ $user->vehicle_model }}</p>
                    </div>
                    @endif
                    
                    @if($user->vehicle_year)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Year</label>
                        <p class="text-gray-900">{{ $user->vehicle_year }}</p>
                    </div>
                    @endif
                    
                    @if($user->vehicle_color)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Vehicle Color</label>
                        <p class="text-gray-900">{{ $user->vehicle_color }}</p>
                    </div>
                    @endif
                    
                    @if($user->license_plate)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">License Plate</label>
                        <p class="text-gray-900">{{ $user->license_plate }}</p>
                    </div>
                    @endif
                    
                    @if($user->registration_number)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Registration Number</label>
                        <p class="text-gray-900">{{ $user->registration_number }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            <!-- Vehicle Images -->
            @if($user->vehicles && $user->vehicles->count() > 0)
                @foreach($user->vehicles as $vehicle)
                    @if($vehicle->front_image || $vehicle->back_image || $vehicle->left_image || $vehicle->right_image)
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                            <i class="fas fa-images text-purple-600 mr-3"></i>
                            Vehicle Images
                            @if($user->vehicles->count() > 1)
                            <span class="ml-2 text-sm text-gray-500">(Vehicle {{ $loop->iteration }})</span>
                            @endif
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @if($vehicle->front_image)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Front View</label>
                                <div class="border border-gray-200 rounded-lg p-2">
                                    <img src="{{ Storage::url($vehicle->front_image) }}" 
                                         alt="Vehicle Front" 
                                         class="w-full h-32 object-cover rounded">
                                </div>
                            </div>
                            @endif
                            
                            @if($vehicle->back_image)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Back View</label>
                                <div class="border border-gray-200 rounded-lg p-2">
                                    <img src="{{ Storage::url($vehicle->back_image) }}" 
                                         alt="Vehicle Back" 
                                         class="w-full h-32 object-cover rounded">
                                </div>
                            </div>
                            @endif
                            
                            @if($vehicle->left_image)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Left View</label>
                                <div class="border border-gray-200 rounded-lg p-2">
                                    <img src="{{ asset('storage/' . str_replace('public/uploads/', 'uploads/', $vehicle->left_image)) }}" 
                                         alt="Vehicle Left" 
                                         class="w-full h-32 object-cover rounded">
                                </div>
                            </div>
                            @endif
                            
                            @if($vehicle->right_image)
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-2">Right View</label>
                                <div class="border border-gray-200 rounded-lg p-2">
                                    <img src="{{ asset('storage/' . str_replace('public/uploads/', 'uploads/', $vehicle->right_image)) }}" 
                                         alt="Vehicle Right" 
                                         class="w-full h-32 object-cover rounded">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            @elseif($user->vehicle_front_image || $user->vehicle_back_image || $user->vehicle_left_image || $user->vehicle_right_image)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-images text-purple-600 mr-3"></i>
                    Vehicle Images (Legacy Data)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if($user->vehicle_front_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Front View</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->vehicle_front_image) }}" 
                                 alt="Vehicle Front" 
                                 class="w-full h-32 object-cover rounded">
                        </div>
                    </div>
                    @endif
                    
                    @if($user->vehicle_back_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Back View</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->vehicle_back_image) }}" 
                                 alt="Vehicle Back" 
                                 class="w-full h-32 object-cover rounded">
                        </div>
                    </div>
                    @endif
                    
                    @if($user->vehicle_left_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Left View</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->vehicle_left_image) }}" 
                                 alt="Vehicle Left" 
                                 class="w-full h-32 object-cover rounded">
                        </div>
                    </div>
                    @endif
                    
                    @if($user->vehicle_right_image)
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-2">Right View</label>
                        <div class="border border-gray-200 rounded-lg p-2">
                            <img src="{{ Storage::url($user->vehicle_right_image) }}" 
                                 alt="Vehicle Right" 
                                 class="w-full h-32 object-cover rounded">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            @endif
            
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
