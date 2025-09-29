@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
            <p class="text-gray-600 mt-2">Update user information and roles</p>
        </div>
        <a href="{{ route('admin.users.index') }}" 
           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Users
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- User Information Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">User Information</h3>
                
                <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}" id="user-update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @php $roleByName = $roles->keyBy('name'); @endphp
                    <input type="hidden" name="roles[]" id="primary_role_id" value="{{ $user->roles->first()->id ?? '' }}">
                    <input type="hidden" name="user_type" id="user_type" value="{{ old('user_type', $user->roles->first()->name ?? 'passenger') }}">

                    <!-- Role Selection (Radio Cards) -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Role</label>
                        @php $currentRole = old('user_type', $user->roles->first()->name ?? 'passenger'); @endphp
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-3 hover:border-blue-400 transition">
                                <input type="radio" name="role_radio" value="passenger" class="mt-1 role-radio" {{ $currentRole==='passenger'?'checked':'' }}>
                                <div>
                                    <div class="font-semibold">Passenger</div>
                                    <div class="text-sm text-gray-500">Book rides and manage profile</div>
                                </div>
                            </label>
                            <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-3 hover:border-blue-400 transition">
                                <input type="radio" name="role_radio" value="driver" class="mt-1 role-radio" {{ $currentRole==='driver'?'checked':'' }}>
                                <div>
                                    <div class="font-semibold">Driver</div>
                                    <div class="text-sm text-gray-500">Provide rides and manage vehicle</div>
                                </div>
                            </label>
                            <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-3 hover:border-blue-400 transition">
                                <input type="radio" name="role_radio" value="admin" class="mt-1 role-radio" {{ $currentRole==='admin'?'checked':'' }}>
                                <div>
                                    <div class="font-semibold">Administrator</div>
                                    <div class="text-sm text-gray-500">Full access to manage the platform</div>
                                </div>
                            </label>
                        </div>
                    </div>
            <!-- ============================================ -->
            <!-- BASIC ACCOUNT INFORMATION -->
            <!-- ============================================ -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user-circle mr-3 text-blue-600"></i>
                    Basic Account Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="Enter full name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="Enter email address">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                        <input type="password" id="password" name="password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Enter new password (leave blank to keep current)">
                        <p class="mt-1 text-sm text-gray-500">Leave blank to keep current password</p>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Confirm new password">
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- PERSONAL DETAILS -->
            <!-- ============================================ -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-id-card mr-3 text-green-600"></i>
                    Personal Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        @php $g = old('gender', $user->gender); @endphp
                        <select id="gender" name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select Gender</option>
                            <option value="male" {{ $g==='male'?'selected':'' }}>Male</option>
                            <option value="female" {{ $g==='female'?'selected':'' }}>Female</option>
                            <option value="other" {{ $g==='other'?'selected':'' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="languages" class="block text-sm font-medium text-gray-700 mb-2">Languages</label>
                        <input type="text" id="languages" name="languages" value="{{ old('languages', $user->languages) }}" placeholder="English, Urdu, Arabic"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-1 text-sm text-gray-500">Separate multiple languages with commas</p>
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- CONTACT INFORMATION -->
            <!-- ============================================ -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-phone mr-3 text-purple-600"></i>
                    Contact Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <select id="country" name="country" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('country') border-red-500 @enderror">
                            <option value="Pakistan" {{ old('country', $user->country) == 'Pakistan' ? 'selected' : '' }}>🇵🇰 Pakistan</option>
                            <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : '' }}>🇮🇳 India</option>
                            <option value="Bangladesh" {{ old('country', $user->country) == 'Bangladesh' ? 'selected' : '' }}>🇧🇩 Bangladesh</option>
                            <option value="Afghanistan" {{ old('country', $user->country) == 'Afghanistan' ? 'selected' : '' }}>🇦🇫 Afghanistan</option>
                            <option value="Iran" {{ old('country', $user->country) == 'Iran' ? 'selected' : '' }}>🇮🇷 Iran</option>
                            <option value="China" {{ old('country', $user->country) == 'China' ? 'selected' : '' }}>🇨🇳 China</option>
                            <option value="USA" {{ old('country', $user->country) == 'USA' ? 'selected' : '' }}>🇺🇸 United States</option>
                            <option value="UK" {{ old('country', $user->country) == 'UK' ? 'selected' : '' }}>🇬🇧 United Kingdom</option>
                            <option value="Canada" {{ old('country', $user->country) == 'Canada' ? 'selected' : '' }}>🇨🇦 Canada</option>
                            <option value="Australia" {{ old('country', $user->country) == 'Australia' ? 'selected' : '' }}>🇦🇺 Australia</option>
                            <option value="UAE" {{ old('country', $user->country) == 'UAE' ? 'selected' : '' }}>🇦🇪 United Arab Emirates</option>
                            <option value="Saudi Arabia" {{ old('country', $user->country) == 'Saudi Arabia' ? 'selected' : '' }}>🇸🇦 Saudi Arabia</option>
                            <option value="Other" {{ old('country', $user->country) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">+92</span>
                            </div>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="10"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror"
                                   placeholder="3001234567">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Enter 10-digit phone number (without +92)</p>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cnic" class="block text-sm font-medium text-gray-700 mb-2">CNIC Number</label>
                        <input type="text" id="cnic" name="cnic" value="{{ old('cnic', $user->cnic) }}" maxlength="15"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cnic') border-red-500 @enderror"
                               placeholder="35201-1234567-1">
                        <p class="mt-1 text-sm text-gray-500">Format: 35201-1234567-1</p>
                        @error('cnic')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <textarea id="address" name="address" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-500 @enderror"
                              placeholder="Enter complete address">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ============================================ -->
            <!-- ACCOUNT STATUS -->
            <!-- ============================================ -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-cog mr-3 text-gray-600"></i>
                    Account Status
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Account Status *</label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="">Select Account Status</option>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status', $user->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Current status of this user account</p>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
                    
                    <!-- Role-specific fields -->
                    <!-- Personal Details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                            <select id="gender" name="gender" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @php $g = old('gender', $user->gender); @endphp
                                <option value="">Select</option>
                                <option value="male" {{ $g==='male'?'selected':'' }}>Male</option>
                                <option value="female" {{ $g==='female'?'selected':'' }}>Female</option>
                                <option value="other" {{ $g==='other'?'selected':'' }}>Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="languages" class="block text-sm font-medium text-gray-700 mb-2">Languages (comma separated)</label>
                            <input type="text" id="languages" name="languages" value="{{ old('languages', is_array($user->languages) ? implode(',', $user->languages) : '') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div id="passenger-fields">
                            <label for="passenger_preferred_payment" class="block text-sm font-medium text-gray-700 mb-2">Preferred Payment Method</label>
                            <select id="passenger_preferred_payment" name="passenger_preferred_payment"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select Payment Method</option>
                                <option value="cash" {{ old('passenger_preferred_payment', $user->preferred_payment)==='cash'?'selected':'' }}>Cash</option>
                                <option value="card" {{ old('passenger_preferred_payment', $user->preferred_payment)==='card'?'selected':'' }}>Card</option>
                                <option value="mobile_wallet" {{ old('passenger_preferred_payment', $user->preferred_payment)==='mobile_wallet'?'selected':'' }}>Mobile Wallet</option>
                            </select>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="passenger_emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact</label>
                                    <input type="text" id="passenger_emergency_contact" name="passenger_emergency_contact" value="{{ old('passenger_emergency_contact', $user->emergency_contact) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="passenger_emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Name</label>
                                    <input type="text" id="passenger_emergency_contact_name" name="passenger_emergency_contact_name" value="{{ old('passenger_emergency_contact_name', $user->emergency_contact_name) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="passenger_emergency_contact_relation" class="block text-sm font-medium text-gray-700 mb-2">Relation</label>
                                    <select id="passenger_emergency_contact_relation" name="passenger_emergency_contact_relation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @php $rel = old('passenger_emergency_contact_relation', $user->emergency_contact_relation); @endphp
                                        <option value="">Select relation</option>
                                        <option value="father" {{ $rel==='father'?'selected':'' }}>Father</option>
                                        <option value="mother" {{ $rel==='mother'?'selected':'' }}>Mother</option>
                                        <option value="brother" {{ $rel==='brother'?'selected':'' }}>Brother</option>
                                        <option value="sister" {{ $rel==='sister'?'selected':'' }}>Sister</option>
                                        <option value="spouse" {{ $rel==='spouse'?'selected':'' }}>Spouse</option>
                                        <option value="friend" {{ $rel==='friend'?'selected':'' }}>Friend</option>
                                        <option value="other" {{ $rel==='other'?'selected':'' }}>Other</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Passenger images -->
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-images mr-2 text-blue-600"></i>Document Images
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Front</label>
                                        <div class="relative">
                                            <input type="file" name="passenger_cnic_front_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'passenger_cnic_front_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=passenger_cnic_front_image]').click()">
                                                <div class="image-preview" id="passenger_cnic_front_preview">
                                                    @if($user->cnic_front_image)
                                                        <img src="{{ asset('storage/' . $user->cnic_front_image) }}" alt="Current CNIC Front" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Front</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Back</label>
                                        <div class="relative">
                                            <input type="file" name="passenger_cnic_back_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'passenger_cnic_back_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=passenger_cnic_back_image]').click()">
                                                <div class="image-preview" id="passenger_cnic_back_preview">
                                                    @if($user->cnic_back_image)
                                                        <img src="{{ asset('storage/' . $user->cnic_back_image) }}" alt="Current CNIC Back" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Back</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                                        <div class="relative">
                                            <input type="file" name="passenger_profile_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'passenger_profile_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=passenger_profile_image]').click()">
                                                <div class="image-preview" id="passenger_profile_preview">
                                                    @if($user->profile_image)
                                                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Current Profile" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload Profile</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="driver-fields">
                            <div>
                                <label for="license_number" class="block text-sm font-medium text-gray-700 mb-2">Driving License Number</label>
                                <input type="text" id="license_number" name="license_number" value="{{ old('license_number', $user->license_number) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <label for="license_type" class="block text-sm font-medium text-gray-700 mb-2">License Type</label>
                                    <input type="text" id="license_type" name="license_type" value="{{ old('license_type', $user->license_type) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="license_expiry_date" class="block text-sm font-medium text-gray-700 mb-2">License Expiry</label>
                                    <input type="date" id="license_expiry_date" name="license_expiry_date" value="{{ old('license_expiry_date', optional($user->license_expiry_date)->format('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="driving_experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                                    <input type="text" id="driving_experience" name="driving_experience" value="{{ old('driving_experience', $user->driving_experience) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                            <div>
                                <label for="vehicle_type" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                                <select id="vehicle_type" name="vehicle_type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Select Type</option>
                                    <option value="car" {{ old('vehicle_type', $user->vehicle_type)==='car'?'selected':'' }}>Car</option>
                                    <option value="bike" {{ old('vehicle_type', $user->vehicle_type)==='bike'?'selected':'' }}>Bike</option>
                                    <option value="rickshaw" {{ old('vehicle_type', $user->vehicle_type)==='rickshaw'?'selected':'' }}>Rickshaw</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                <div>
                                    <label for="vehicle_make" class="block text-sm font-medium text-gray-700 mb-2">Make</label>
                                    <input type="text" id="vehicle_make" name="vehicle_make" value="{{ old('vehicle_make') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label for="vehicle_model" class="block text-sm font-medium text-gray-700 mb-2">Model</label>
                                    <input type="text" id="vehicle_model" name="vehicle_model" value="{{ old('vehicle_model') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label for="vehicle_year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                                    <input type="number" id="vehicle_year" name="vehicle_year" value="{{ old('vehicle_year') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label for="vehicle_color" class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                                    <input type="text" id="vehicle_color" name="vehicle_color" value="{{ old('vehicle_color') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label for="license_plate" class="block text-sm font-medium text-gray-700 mb-2">License Plate</label>
                                    <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                                <div>
                                    <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2">Registration No.</label>
                                    <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                                </div>
                            </div>
                            <div>
                                <label for="preferred_payment" class="block text-sm font-medium text-gray-700 mb-2">Preferred Payment</label>
                                <select id="preferred_payment" name="preferred_payment"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="">Select Payment Method</option>
                                    <option value="cash" {{ old('preferred_payment', $user->preferred_payment)==='cash'?'selected':'' }}>Cash</option>
                                    <option value="card" {{ old('preferred_payment', $user->preferred_payment)==='card'?'selected':'' }}>Card</option>
                                    <option value="mobile_wallet" {{ old('preferred_payment', $user->preferred_payment)==='mobile_wallet'?'selected':'' }}>Mobile Wallet</option>
                                </select>
                            </div>
                            <!-- Driver images -->
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-images mr-2 text-blue-600"></i>Document & Vehicle Images
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Front</label>
                                        <div class="relative">
                                            <input type="file" name="cnic_front_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'cnic_front_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=cnic_front_image]').click()">
                                                <div class="image-preview" id="cnic_front_preview">
                                                    @if($user->cnic_front_image)
                                                        <img src="{{ asset('storage/' . $user->cnic_front_image) }}" alt="Current CNIC Front" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Front</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Back</label>
                                        <div class="relative">
                                            <input type="file" name="cnic_back_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'cnic_back_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=cnic_back_image]').click()">
                                                <div class="image-preview" id="cnic_back_preview">
                                                    @if($user->cnic_back_image)
                                                        <img src="{{ asset('storage/' . $user->cnic_back_image) }}" alt="Current CNIC Back" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Back</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">License Image</label>
                                        <div class="relative">
                                            <input type="file" name="license_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'license_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=license_image]').click()">
                                                <div class="image-preview" id="license_preview">
                                                    @if($user->license_image)
                                                        <img src="{{ asset('storage/' . $user->license_image) }}" alt="Current License" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload License</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                                        <div class="relative">
                                            <input type="file" name="profile_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'profile_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=profile_image]').click()">
                                                <div class="image-preview" id="profile_preview">
                                                    @if($user->profile_image)
                                                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Current Profile" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload Profile</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Front</label>
                                        <div class="relative">
                                            <input type="file" name="vehicle_front_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_front_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_front_image]').click()">
                                                <div class="image-preview" id="vehicle_front_preview">
                                                    @if($user->vehicles->first() && $user->vehicles->first()->front_image)
                                                        <img src="{{ asset('storage/' . $user->vehicles->first()->front_image) }}" alt="Current Vehicle Front" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Front</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Back</label>
                                        <div class="relative">
                                            <input type="file" name="vehicle_back_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_back_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_back_image]').click()">
                                                <div class="image-preview" id="vehicle_back_preview">
                                                    @if($user->vehicles->first() && $user->vehicles->first()->back_image)
                                                        <img src="{{ asset('storage/' . $user->vehicles->first()->back_image) }}" alt="Current Vehicle Back" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Back</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Left</label>
                                        <div class="relative">
                                            <input type="file" name="vehicle_left_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_left_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_left_image]').click()">
                                                <div class="image-preview" id="vehicle_left_preview">
                                                    @if($user->vehicles->first() && $user->vehicles->first()->left_image)
                                                        <img src="{{ asset('storage/' . $user->vehicles->first()->left_image) }}" alt="Current Vehicle Left" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Left</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="image-upload-container">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Right</label>
                                        <div class="relative">
                                            <input type="file" name="vehicle_right_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_right_preview')">
                                            <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_right_image]').click()">
                                                <div class="image-preview" id="vehicle_right_preview">
                                                    @if($user->vehicles->first() && $user->vehicles->first()->right_image)
                                                        <img src="{{ asset('storage/' . $user->vehicles->first()->right_image) }}" alt="Current Vehicle Right" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                                                    @else
                                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Right</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex justify-end space-x-4">
                        <a href="{{ route('admin.users.index') }}" 
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" 
                                id="update-btn"
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 hover-scale"
                                onclick="this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin mr-2\'></i>Updating...'; const f=this.closest('form'); if(f){ f.submit(); } return false;">
                            <i class="fas fa-save mr-2"></i>Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- User Profile Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">User Profile</h3>
                
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white text-2xl font-medium">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <h4 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h4>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($user->status === 'active') bg-green-100 text-green-800
                            @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Phone</span>
                        <span class="text-sm text-gray-900">{{ $user->phone ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">CNIC</span>
                        <span class="text-sm text-gray-900">{{ $user->cnic ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-2 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Joined</span>
                        <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="py-2">
                        <span class="text-sm text-gray-600 block mb-2">Roles</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($user->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($role->name === 'admin') bg-red-100 text-red-800
                                    @elseif($role->name === 'driver') bg-green-100 text-green-800
                                    @else bg-blue-100 text-blue-800
                                    @endif">
                                    {{ $role->display_name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced form styling */
.hover-scale {
    transition: all 0.3s ease;
}

.hover-scale:hover {
    transform: scale(1.05);
}

.form-input {
    transition: all 0.3s ease;
}

.form-input:focus {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

.role-checkbox {
    transition: all 0.3s ease;
}

.role-checkbox:hover {
    transform: scale(1.1);
}

#update-btn {
    position: relative;
    overflow: hidden;
}

#update-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

#update-btn:hover::before {
    left: 100%;
}

/* Loading animation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.fa-spin {
    animation: spin 1s linear infinite;
}

/* Success message styling */
.alert-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

/* Error message styling */
.text-red-500 {
    color: #ef4444 !important;
    font-weight: 500;
    font-size: 0.875rem;
}
</style>

<style>
.image-upload-container {
    margin-bottom: 1rem;
}

.image-upload-area {
    border: 2px dashed #d1d5db;
    border-radius: 0.5rem;
    padding: 1.5rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: #f9fafb;
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-upload-area:hover {
    border-color: #3b82f6;
    background-color: #eff6ff;
}

.image-preview {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.image-preview img {
    max-width: 100%;
    max-height: 100px;
    border-radius: 0.375rem;
    object-fit: cover;
}

.image-preview .remove-image {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.upload-icon {
    font-size: 2rem;
    color: #9ca3af;
    margin-bottom: 0.5rem;
}

.upload-text {
    color: #6b7280;
    font-size: 0.875rem;
}
</style>

<script>
function previewImage(input, previewId) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div style="position: relative; width: 100%; height: 100px;">
                    <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100px; object-fit: cover; border-radius: 0.375rem;">
                    <button type="button" class="remove-image" onclick="removeImage('${input.name}', '${previewId}')" title="Remove image">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
}

function removeImage(inputName, previewId) {
    const input = document.querySelector(`input[name="${inputName}"]`);
    const preview = document.getElementById(previewId);
    
    input.value = '';
    preview.innerHTML = `
        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
        <p class="text-sm text-gray-500 mt-2">Click to upload</p>
    `;
}

document.addEventListener('DOMContentLoaded', function(){
    const rolesMap = {
        passenger: {{ $roleByName['passenger']->id ?? 'null' }},
        driver: {{ $roleByName['driver']->id ?? 'null' }},
        admin: {{ $roleByName['admin']->id ?? 'null' }}
    };

    function applyRole(roleName){
        const roleId = rolesMap[roleName] || '';
        document.getElementById('primary_role_id').value = roleId;
        document.getElementById('user_type').value = roleName;
        const driverFields = document.getElementById('driver-fields');
        const passengerFields = document.getElementById('passenger-fields');
        if(roleName === 'driver'){
            driverFields.style.display = '';
            passengerFields.style.display = 'none';
        } else if(roleName === 'passenger'){
            driverFields.style.display = 'none';
            passengerFields.style.display = '';
        } else {
            driverFields.style.display = 'none';
            passengerFields.style.display = 'none';
        }
    }

    document.querySelectorAll('.role-radio').forEach(function(r){
        r.addEventListener('change', function(){ applyRole(this.value); });
    });

    // initialize based on current role
    const checked = document.querySelector('.role-radio:checked');
    if(checked){ applyRole(checked.value); }
});
</script>
@endsection
