@extends('layouts.admin')

@section('title', 'Add New User')

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

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach($errors->all() as $error)
                    showToast('{{ $error }}', 'error');
                @endforeach
            });
        </script>
    @endif
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Add New User</h1>
            <p class="text-gray-600 mt-2">Create a new user account for the platform</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
            <i class="fas fa-arrow-left mr-2"></i>Back to Users
        </a>
    </div>

    <!-- Create User Form -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6" id="create-user-form" novalidate enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="roles[]" id="primary_role_id" value="">
            <input type="hidden" name="user_type" id="user_type" value="passenger">

            <!-- Role Selection (Radio Cards) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Select Role</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4" id="role-cards">
                    @php $roleByName = $roles->keyBy('name'); @endphp
                    <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-3 hover:border-blue-400 transition" data-role="passenger">
                        <input type="radio" name="role_radio" value="passenger" class="mt-1 role-radio" checked>
                        <div>
                            <div class="font-semibold">Passenger</div>
                            <div class="text-sm text-gray-500">Book rides and manage profile</div>
                        </div>
                    </label>
                    <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-3 hover:border-blue-400 transition" data-role="driver">
                        <input type="radio" name="role_radio" value="driver" class="mt-1 role-radio">
                        <div>
                            <div class="font-semibold">Driver</div>
                            <div class="text-sm text-gray-500">Provide rides and manage vehicle</div>
                        </div>
                    </label>
                    <label class="border rounded-lg p-4 cursor-pointer flex items-start space-x-3 hover:border-blue-400 transition" data-role="admin">
                        <input type="radio" name="role_radio" value="admin" class="mt-1 role-radio">
                        <div>
                            <div class="font-semibold">Administrator</div>
                            <div class="text-sm text-gray-500">Full access to manage the platform</div>
                        </div>
                    </label>
                </div>
                <p class="mt-2 text-sm text-gray-500">By default, Passenger is selected.</p>
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
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                               placeholder="Enter full name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                               placeholder="Enter email address">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                               placeholder="Enter password (min 8 characters)">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Confirm password">
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
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        @php $g = old('gender'); @endphp
                        <select id="gender" name="gender" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select Gender</option>
                            <option value="male" {{ $g==='male'?'selected':'' }}>Male</option>
                            <option value="female" {{ $g==='female'?'selected':'' }}>Female</option>
                            <option value="other" {{ $g==='other'?'selected':'' }}>Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="languages" class="block text-sm font-medium text-gray-700 mb-2">Languages</label>
                        <input type="text" id="languages" name="languages" value="{{ old('languages') }}" placeholder="English, Urdu, Arabic"
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
                            <option value="Pakistan" selected>🇵🇰 Pakistan</option>
                            <option value="India">🇮🇳 India</option>
                            <option value="Bangladesh">🇧🇩 Bangladesh</option>
                            <option value="Afghanistan">🇦🇫 Afghanistan</option>
                            <option value="Iran">🇮🇷 Iran</option>
                            <option value="China">🇨🇳 China</option>
                            <option value="USA">🇺🇸 United States</option>
                            <option value="UK">🇬🇧 United Kingdom</option>
                            <option value="Canada">🇨🇦 Canada</option>
                            <option value="Australia">🇦🇺 Australia</option>
                            <option value="UAE">🇦🇪 United Arab Emirates</option>
                            <option value="Saudi Arabia">🇸🇦 Saudi Arabia</option>
                            <option value="Other">Other</option>
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
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" maxlength="10"
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
                        <input type="text" id="cnic" name="cnic" value="{{ old('cnic') }}" maxlength="15"
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
                              placeholder="Enter complete address">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- ============================================ -->
            <!-- PASSENGER SPECIFIC INFORMATION -->
            <!-- ============================================ -->
            <div id="passenger-fields" class="bg-blue-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-user mr-3 text-blue-600"></i>
                    Passenger Information
                </h3>
                
                <!-- Emergency Contact Details -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-phone-alt mr-2 text-red-500"></i>
                        Emergency Contact Details
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="passenger_emergency_contact" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Number</label>
                            <input type="text" id="passenger_emergency_contact" name="passenger_emergency_contact" value="{{ old('passenger_emergency_contact') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="+92 300 1234567">
                        </div>
                        <div>
                            <label for="passenger_emergency_contact_name" class="block text-sm font-medium text-gray-700 mb-2">Emergency Contact Name</label>
                            <input type="text" id="passenger_emergency_contact_name" name="passenger_emergency_contact_name" value="{{ old('passenger_emergency_contact_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Full name of emergency contact">
                        </div>
                        <div>
                            <label for="passenger_emergency_contact_relation" class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                            <select id="passenger_emergency_contact_relation" name="passenger_emergency_contact_relation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select relationship</option>
                                <option value="father">Father</option>
                                <option value="mother">Mother</option>
                                <option value="brother">Brother</option>
                                <option value="sister">Sister</option>
                                <option value="spouse">Spouse</option>
                                <option value="friend">Friend</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Payment Preferences -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-credit-card mr-2 text-green-500"></i>
                        Payment Preferences
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="passenger_preferred_payment" class="block text-sm font-medium text-gray-700 mb-2">Preferred Payment Method</label>
                            <select id="passenger_preferred_payment" name="passenger_preferred_payment"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select Payment Method</option>
                                <option value="cash" {{ old('passenger_preferred_payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ old('passenger_preferred_payment') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                                <option value="mobile_wallet" {{ old('passenger_preferred_payment') == 'mobile_wallet' ? 'selected' : '' }}>Mobile Wallet</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Document Images -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-purple-500"></i>
                        Document Images
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Front *</label>
                            <div class="relative">
                                <input type="file" name="passenger_cnic_front_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'passenger_cnic_front_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=passenger_cnic_front_image]').click()">
                                    <div class="image-preview" id="passenger_cnic_front_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Front</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Back *</label>
                            <div class="relative">
                                <input type="file" name="passenger_cnic_back_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'passenger_cnic_back_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=passenger_cnic_back_image]').click()">
                                    <div class="image-preview" id="passenger_cnic_back_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Back</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image *</label>
                            <div class="relative">
                                <input type="file" name="passenger_profile_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'passenger_profile_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=passenger_profile_image]').click()">
                                    <div class="image-preview" id="passenger_profile_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload Profile</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- DRIVER SPECIFIC INFORMATION -->
            <!-- ============================================ -->
            <div id="driver-fields" style="display:none;" class="bg-green-50 rounded-lg p-6 mb-8">
                <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-car mr-3 text-green-600"></i>
                    Driver Information
                </h3>
                
                <!-- Driving License Details -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-id-badge mr-2 text-blue-500"></i>
                        Driving License Details
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="license_number" class="block text-sm font-medium text-gray-700 mb-2">License Number</label>
                            <input type="text" id="license_number" name="license_number" value="{{ old('license_number') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. L-1234567">
                        </div>
                        <div>
                            <label for="license_type" class="block text-sm font-medium text-gray-700 mb-2">License Type</label>
                            <input type="text" id="license_type" name="license_type" value="{{ old('license_type') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. LTV, HTV">
                        </div>
                        <div>
                            <label for="license_expiry_date" class="block text-sm font-medium text-gray-700 mb-2">License Expiry Date</label>
                            <input type="date" id="license_expiry_date" name="license_expiry_date" value="{{ old('license_expiry_date') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="driving_experience" class="block text-sm font-medium text-gray-700 mb-2">Driving Experience</label>
                            <input type="text" id="driving_experience" name="driving_experience" value="{{ old('driving_experience') }}" 
                                   placeholder="e.g. 3 years"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Banking Information -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-university mr-2 text-yellow-500"></i>
                        Banking Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="bank_account_number" class="block text-sm font-medium text-gray-700 mb-2">Account Number</label>
                            <input type="text" id="bank_account_number" name="bank_account_number" value="{{ old('bank_account_number') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter account number">
                        </div>
                        <div>
                            <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">Bank Name</label>
                            <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. HBL, UBL, MCB">
                        </div>
                        <div>
                            <label for="bank_branch" class="block text-sm font-medium text-gray-700 mb-2">Branch Name</label>
                            <input type="text" id="bank_branch" name="bank_branch" value="{{ old('bank_branch') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter branch name">
                        </div>
                    </div>
                </div>

                <!-- Vehicle Information -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-car-side mr-2 text-red-500"></i>
                        Vehicle Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="vehicle_type" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                            <select id="vehicle_type" name="vehicle_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select Vehicle Type</option>
                                <option value="car" {{ old('vehicle_type')=='car'?'selected':'' }}>Car</option>
                                <option value="bike" {{ old('vehicle_type')=='bike'?'selected':'' }}>Bike</option>
                                <option value="rickshaw" {{ old('vehicle_type')=='rickshaw'?'selected':'' }}>Rickshaw</option>
                            </select>
                        </div>
                        <div>
                            <label for="vehicle_make" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Make</label>
                            <input type="text" id="vehicle_make" name="vehicle_make" value="{{ old('vehicle_make') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. Toyota, Honda, Suzuki">
                        </div>
                        <div>
                            <label for="vehicle_model" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Model</label>
                            <input type="text" id="vehicle_model" name="vehicle_model" value="{{ old('vehicle_model') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. Corolla, Civic, Swift">
                        </div>
                        <div>
                            <label for="vehicle_year" class="block text-sm font-medium text-gray-700 mb-2">Manufacturing Year</label>
                            <input type="number" id="vehicle_year" name="vehicle_year" value="{{ old('vehicle_year') }}" 
                                   min="1990" max="2025"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="2020">
                        </div>
                        <div>
                            <label for="vehicle_color" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Color</label>
                            <input type="text" id="vehicle_color" name="vehicle_color" value="{{ old('vehicle_color') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. White, Black, Silver">
                        </div>
                        <div>
                            <label for="license_plate" class="block text-sm font-medium text-gray-700 mb-2">License Plate</label>
                            <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="e.g. KHI-2023-1234">
                        </div>
                        <div>
                            <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2">Registration Number</label>
                            <input type="text" id="registration_number" name="registration_number" value="{{ old('registration_number') }}" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter registration number">
                        </div>
                    </div>
                </div>

                <!-- Payment Preferences -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-credit-card mr-2 text-green-500"></i>
                        Payment Preferences
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="preferred_payment" class="block text-sm font-medium text-gray-700 mb-2">Preferred Payment Method</label>
                            <select id="preferred_payment" name="preferred_payment"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select Payment Method</option>
                                <option value="cash" {{ old('preferred_payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="card" {{ old('preferred_payment') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                                <option value="mobile_wallet" {{ old('preferred_payment') == 'mobile_wallet' ? 'selected' : '' }}>Mobile Wallet</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Document & Vehicle Images -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-images mr-2 text-purple-500"></i>
                        Document & Vehicle Images
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Front *</label>
                            <div class="relative">
                                <input type="file" name="cnic_front_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'cnic_front_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=cnic_front_image]').click()">
                                    <div class="image-preview" id="cnic_front_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Front</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">CNIC Back *</label>
                            <div class="relative">
                                <input type="file" name="cnic_back_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'cnic_back_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=cnic_back_image]').click()">
                                    <div class="image-preview" id="cnic_back_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload CNIC Back</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">License Image *</label>
                            <div class="relative">
                                <input type="file" name="license_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'license_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=license_image]').click()">
                                    <div class="image-preview" id="license_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload License</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image *</label>
                            <div class="relative">
                                <input type="file" name="profile_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'profile_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=profile_image]').click()">
                                    <div class="image-preview" id="profile_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload Profile</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Front *</label>
                            <div class="relative">
                                <input type="file" name="vehicle_front_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_front_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_front_image]').click()">
                                    <div class="image-preview" id="vehicle_front_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Front</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Back *</label>
                            <div class="relative">
                                <input type="file" name="vehicle_back_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_back_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_back_image]').click()">
                                    <div class="image-preview" id="vehicle_back_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Back</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Left *</label>
                            <div class="relative">
                                <input type="file" name="vehicle_left_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_left_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_left_image]').click()">
                                    <div class="image-preview" id="vehicle_left_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Left</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="image-upload-container">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Right *</label>
                            <div class="relative">
                                <input type="file" name="vehicle_right_image" accept="image/*" class="image-upload-input hidden" onchange="previewImage(this, 'vehicle_right_preview')">
                                <div class="image-upload-area" onclick="document.querySelector('input[name=vehicle_right_image]').click()">
                                    <div class="image-preview" id="vehicle_right_preview">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                        <p class="text-sm text-gray-500 mt-2">Click to upload Vehicle Right</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Set the initial status for this user account</p>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        id="create-user-btn"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200"
                        onclick="this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin mr-2\'></i>Creating User...'; const f=this.closest('form'); if(f){ f.submit(); } return false;">
                    <i class="fas fa-plus mr-2"></i>Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

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

@push('scripts')
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
            driverFields.style.display = 'block';
            passengerFields.style.display = 'none';
        } else if(roleName === 'passenger'){
            driverFields.style.display = 'none';
            passengerFields.style.display = 'block';
        } else {
            driverFields.style.display = 'none';
            passengerFields.style.display = 'none';
        }
    }

    document.querySelectorAll('.role-radio').forEach(function(r){
        r.addEventListener('change', function(){ applyRole(this.value); });
    });

    // initialize default
    const checked = document.querySelector('.role-radio:checked');
    if(checked){ applyRole(checked.value); }
});
</script>
@endpush
