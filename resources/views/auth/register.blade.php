<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Production Assets -->
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = $manifest['resources/css/app.css']['file'] ?? 'assets/app-DdX-XK6w.css';
        $jsFile = $manifest['resources/js/app.js']['file'] ?? 'assets/app-CXDpL9bK.js';
    @endphp
    <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    <script src="{{ asset('build/' . $jsFile) }}" defer></script>
    
    <style>
        :root {
            --primary: #011c72ff;
            --secondary: orange;
            --gold: #D4AF37;
            --platinum: #C0C0C0;
            --success: #058a0bee;
            --warning: #ce0a0aff;
            --light-bg: #FAFAFA;
            --light-surface: #FFFFFF;
            --light-text: #1B1B1B;
            --light-muted: #5C5C5C;
            --dark-bg: #0E0E0E;
            --dark-surface: #1A1A1A;
            --dark-text: #F5F5F5;
            --dark-muted: #A1A1A1;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, var(--primary) 0%, #1a237e 50%, var(--primary) 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 2rem 1rem;
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 10%;
            right: 20%;
            animation-delay: 1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 100%;
            max-width: 800px;
            position: relative;
            z-index: 10;
            animation: slideUp 0.8s ease-out;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .step-content { display: none; }
        .step-content.active { display: block; }
        
        .progress-bar {
            height: 6px;
            background: rgba(1, 28, 114, 0.1);
            border-radius: 3px;
            overflow: hidden;
            margin: 20px 0;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 0.3s ease;
        }
        
        .input-wrapper { 
            position: relative; 
            margin-bottom: 1.75rem;
        }
        .input-wrapper i { 
            position: absolute; 
            left: 20px; 
            top: 50%; 
            transform: translateY(-50%); 
            color: var(--primary); 
            z-index: 10;
            font-size: 18px;
            transition: all 0.3s ease;
            line-height: 1;
            display: inline-block;
            vertical-align: middle;
        }
        .input-wrapper input, 
        .input-wrapper select, 
        .input-wrapper textarea { 
            width: 100%;
            padding: 18px 24px 18px 56px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 500;
            color: #1f2937;
            background: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
        .input-wrapper input:focus, 
        .input-wrapper select:focus, 
        .input-wrapper textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(1, 28, 114, 0.1), 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        .input-wrapper input:focus + i,
        .input-wrapper select:focus + i,
        .input-wrapper textarea:focus + i {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }
        .input-wrapper input:hover,
        .input-wrapper select:hover,
        .input-wrapper textarea:hover {
            border-color: rgba(1, 28, 114, 0.4);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .input-wrapper label {
            display: block;
            margin-bottom: 10px;
            font-weight: 700;
            color: #374151;
            font-size: 15px;
            letter-spacing: 0.025em;
        }
        .input-wrapper small {
            display: block;
            margin-top: 6px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 500;
        }
        .input-wrapper textarea {
            min-height: 100px;
            resize: vertical;
        }
        .input-wrapper textarea + i {
            top: 50%;
            transform: translateY(-50%);
        }
        .input-wrapper input.error,
        .input-wrapper select.error,
        .input-wrapper textarea.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }
        .error-message {
            color: #ef4444;
            font-size: 13px;
            font-weight: 600;
            margin-top: 6px;
            display: flex;
            align-items: center;
        }
        .error-message::before {
            content: "⚠";
            margin-right: 6px;
            font-size: 12px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
        .form-section {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .form-section:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .form-section h3 {
            color: var(--primary);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid rgba(1, 28, 114, 0.1);
            display: flex;
            align-items: center;
        }
        .form-section h3 i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .file-upload {
            border: 2px dashed rgba(1, 28, 114, 0.3);
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: rgba(1, 28, 114, 0.05);
            min-height: 160px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .file-upload:hover {
            border-color: var(--primary);
            background-color: rgba(1, 28, 114, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(1, 28, 114, 0.15);
        }
        .file-upload.dragover {
            border-color: var(--primary);
            background-color: rgba(1, 28, 114, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(1, 28, 114, 0.25);
        }
        .file-upload i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            color: var(--primary);
        }
        .file-upload p {
            margin: 4px 0;
        }
        .file-upload .text-sm {
            font-weight: 600;
            color: #374151;
        }
        .file-upload .text-xs {
            color: #6b7280;
        }
        .preview-container {
            position: relative;
            display: inline-block;
            margin: 8px;
        }
        .preview-image {
            max-width: 120px;
            max-height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: block;
        }
        .remove-preview {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 10;
        }
        .remove-preview:hover {
            background: #dc2626;
            transform: scale(1.1);
        }
        .remove-preview i {
            font-size: 10px;
            line-height: 1;
        }
        .file-upload.uploaded {
            border-color: var(--success);
            background-color: rgba(5, 138, 11, 0.1);
        }
        .file-upload.uploaded i {
            color: var(--success);
        }
        
        /* Fix for hidden file inputs to prevent focus errors */
        .file-upload input[type="file"] {
            position: absolute !important;
            left: -9999px !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }
        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 50%;
            width: 100%;
            height: 3px;
            background: rgba(1, 28, 114, 0.2);
            z-index: 1;
        }
        .step-item.completed:not(:last-child)::after {
            background: var(--success);
        }
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(1, 28, 114, 0.2);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }
        .step-item.active .step-circle {
            background: var(--primary);
            color: white;
        }
        .step-item.completed .step-circle {
            background: var(--success);
            color: white;
        }
        .step-title {
            margin-top: 8px;
            font-size: 12px;
            font-weight: 600;
            color: var(--primary);
            text-align: center;
        }
        .step-item.active .step-title {
            color: var(--primary);
        }
        .step-item.completed .step-title {
            color: var(--success);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #1a237e);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(1, 28, 114, 0.3);
        }

        .btn-secondary {
            background: rgba(1, 28, 114, 0.1);
            border: 2px solid var(--primary);
            border-radius: 12px;
            padding: 12px 24px;
            color: var(--primary);
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }

        .account-type-card {
            transition: all 0.3s ease;
        }
        .account-type-card:hover {
            transform: translateY(-5px);
        }
        .account-type-card.selected .card-content {
            border-color: var(--primary);
            background: rgba(1, 28, 114, 0.05);
            box-shadow: 0 10px 25px rgba(1, 28, 114, 0.2);
        }
        .account-type-card.selected .card-content::before {
            content: '✓';
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--primary);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        .card-content {
            position: relative;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }
        
        /* Error Toast Animation */
        @keyframes slide-in {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="register-container">
        <!-- Floating Background Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <!-- Error Messages -->
        @if ($errors->any())
        <div class="fixed top-4 right-4 z-50 max-w-md">
            @foreach ($errors->all() as $error)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-2 shadow-lg animate-slide-in">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span class="text-sm font-medium">{{ $error }}</span>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Registration Card -->
        <div class="register-card">
            <!-- Header -->
            <div class="text-center mb-6">
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq" class="h-12 w-auto mr-3">
                    <h1 class="text-3xl font-bold text-gray-900">Join Raah-e-Haq</h1>
                </div>
                <p class="text-gray-600">Complete your registration in a few simple steps</p>
            </div>
                <!-- Progress Bar -->
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progress-fill" style="width: 20%"></div>
                    </div>
                </div>

                <!-- Step Indicators -->
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <div class="step-indicator">
                        <div class="step-item active" data-step="1">
                            <div class="step-circle">1</div>
                            <div class="step-title">Account Type</div>
                        </div>
                        <div class="step-item" data-step="2">
                            <div class="step-circle">2</div>
                            <div class="step-title">Basic Info</div>
                        </div>
                        <div class="step-item" data-step="3">
                            <div class="step-circle">3</div>
                            <div class="step-title">Role Details</div>
                        </div>
                        <div class="step-item" data-step="4">
                            <div class="step-circle">4</div>
                            <div class="step-title">Documents</div>
                        </div>
                        <div class="step-item" data-step="5">
                            <div class="step-circle">5</div>
                            <div class="step-title">Review</div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form id="registration-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_type" id="user_type" value="driver">

                        <!-- Step 1: Account Type Selection -->
                        <div id="step-1" class="step-content active">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Choose Your Account Type</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Driver Option -->
                                <div class="account-type-card" data-type="driver">
                                    <div class="card-content">
                                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-car text-2xl text-blue-600"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Driver</h3>
                                        <p class="text-gray-600 mb-4">Earn money by providing rides to passengers</p>
                                        <ul class="text-sm text-gray-500 text-left space-y-1">
                                            <li>• Flexible working hours</li>
                                            <li>• Earn competitive rates</li>
                                            <li>• Meet new people</li>
                                            <li>• Vehicle verification required</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Passenger Option -->
                                <div class="account-type-card" data-type="passenger">
                                    <div class="card-content">
                                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <i class="fas fa-user text-2xl text-green-600"></i>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Passenger</h3>
                                        <p class="text-gray-600 mb-4">Book rides and travel conveniently</p>
                                        <ul class="text-sm text-gray-500 text-left space-y-1">
                                            <li>• Easy booking process</li>
                                            <li>• Safe and reliable rides</li>
                                            <li>• Multiple payment options</li>
                                            <li>• Real-time tracking</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Basic Information -->
                        <div id="step-2" class="step-content">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Basic Information</h2>
                            
                            <div class="max-w-4xl mx-auto">
                                <div class="form-section">
                                    <h3>
                                        <i class="fas fa-user mr-2"></i>Personal Details
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="input-wrapper">
                                            <i class="fas fa-user"></i>
                                            <label for="name">Full Name *</label>
                                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                                                   placeholder="Enter your full name">
                                            @error('name')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-envelope"></i>
                                            <label for="email">Email Address *</label>
                                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" 
                                                   placeholder="Enter your email address">
                                            @error('email')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-phone"></i>
                                            <label for="phone">Phone Number *</label>
                                            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required 
                                                   placeholder="Enter your phone number">
                                            @error('phone')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-calendar"></i>
                                            <label for="date_of_birth">Date of Birth *</label>
                                            <input id="date_of_birth" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                            @error('date_of_birth')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-venus-mars"></i>
                                            <label for="gender">Gender *</label>
                                            <select name="gender" required>
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                            @error('gender')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-id-card"></i>
                                            <label for="cnic">CNIC Number *</label>
                                            <input id="cnic" type="text" name="cnic" value="{{ old('cnic') }}" required 
                                                   placeholder="12345-1234567-1">
                                            <small>Format: 12345-1234567-1</small>
                                            @error('cnic')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-wrapper">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <label for="address">Complete Address *</label>
                                        <textarea name="address" rows="3" required 
                                                  placeholder="Enter your complete address">{{ old('address') }}</textarea>
                                        @error('address')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Role Details -->
                        <div id="step-3" class="step-content">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Role Details</h2>
                            
                            <div class="max-w-4xl mx-auto">
                                <!-- Driver Specific Information -->
                                <div class="form-section" id="driver-fields">
                                    <h3>
                                        <i class="fas fa-car mr-2"></i>Driver Information
                                    </h3>

                                    <div class="input-wrapper">
                                        <i class="fas fa-id-badge"></i>
                                        <label for="license_number">Driving License Number *</label>
                                        <input id="license_number" type="text" name="license_number" value="{{ old('license_number') }}" 
                                               placeholder="Enter your driving license number">
                                        @error('license_number')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-row">
                                        <div class="input-wrapper">
                                            <i class="fas fa-calendar-check"></i>
                                            <label for="license_expiry_date">License Expiry Date *</label>
                                            <input id="license_expiry_date" type="date" name="license_expiry_date" value="{{ old('license_expiry_date') }}">
                                            @error('license_expiry_date')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-certificate"></i>
                                            <label for="license_type">License Type *</label>
                                            <select name="license_type">
                                                <option value="">Select License Type</option>
                                                <option value="A" {{ old('license_type') == 'A' ? 'selected' : '' }}>A (Motorcycle)</option>
                                                <option value="B" {{ old('license_type') == 'B' ? 'selected' : '' }}>B (Car)</option>
                                                <option value="C" {{ old('license_type') == 'C' ? 'selected' : '' }}>C (Truck)</option>
                                                <option value="D" {{ old('license_type') == 'D' ? 'selected' : '' }}>D (Bus)</option>
                                            </select>
                                            @error('license_type')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="input-wrapper">
                                        <i class="fas fa-clock"></i>
                                        <label for="driving_experience">Driving Experience *</label>
                                        <input id="driving_experience" type="text" name="driving_experience" value="{{ old('driving_experience') }}" 
                                               placeholder="e.g., 5 years">
                                        <small>How many years have you been driving?</small>
                                        @error('driving_experience')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-row">
                                        <div class="input-wrapper">
                                            <i class="fas fa-car"></i>
                                            <label for="vehicle_type">Vehicle Type *</label>
                                            <select name="vehicle_type">
                                                <option value="">Select Vehicle Type</option>
                                                <option value="car" {{ old('vehicle_type') == 'car' ? 'selected' : '' }}>Car</option>
                                                <option value="bike" {{ old('vehicle_type') == 'bike' ? 'selected' : '' }}>Bike</option>
                                                <option value="rickshaw" {{ old('vehicle_type') == 'rickshaw' ? 'selected' : '' }}>Rickshaw</option>
                                                <option value="van" {{ old('vehicle_type') == 'van' ? 'selected' : '' }}>Van</option>
                                            </select>
                                            @error('vehicle_type')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-credit-card"></i>
                                            <label for="preferred_payment">Preferred Payment *</label>
                                            <select name="preferred_payment">
                                                <option value="">Select Payment Method</option>
                                                <option value="cash" {{ old('preferred_payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                                                <option value="card" {{ old('preferred_payment') == 'card' ? 'selected' : '' }}>Card</option>
                                                <option value="mobile_wallet" {{ old('preferred_payment') == 'mobile_wallet' ? 'selected' : '' }}>Mobile Wallet</option>
                                            </select>
                                            @error('preferred_payment')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Banking Information -->
                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-semibold text-gray-900 mb-4">
                                            <i class="fas fa-university mr-2"></i>Banking Information
                                        </h4>

                                        <div class="form-row">
                                            <div class="input-wrapper">
                                                <i class="fas fa-credit-card"></i>
                                                <label for="bank_account_number">Bank Account Number *</label>
                                                <input id="bank_account_number" type="text" name="bank_account_number" value="{{ old('bank_account_number') }}" 
                                                       placeholder="Enter your bank account number">
                                                @error('bank_account_number')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-wrapper">
                                                <i class="fas fa-building"></i>
                                                <label for="bank_name">Bank Name *</label>
                                                <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}" 
                                                       placeholder="Enter your bank name">
                                                @error('bank_name')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="input-wrapper">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <label for="bank_branch">Bank Branch *</label>
                                            <input id="bank_branch" type="text" name="bank_branch" value="{{ old('bank_branch') }}" 
                                                   placeholder="Enter your bank branch">
                                            @error('bank_branch')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Vehicle Details -->
                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-semibold text-gray-900 mb-4">
                                            <i class="fas fa-car mr-2"></i>Vehicle Details
                                        </h4>

                                        <div class="form-row">
                                            <div class="input-wrapper">
                                                <i class="fas fa-car"></i>
                                                <label for="vehicle_make">Vehicle Make *</label>
                                                <input id="vehicle_make" type="text" name="vehicle_make" value="{{ old('vehicle_make') }}" 
                                                       placeholder="e.g., Toyota, Honda, Suzuki">
                                                @error('vehicle_make')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-wrapper">
                                                <i class="fas fa-car"></i>
                                                <label for="vehicle_model">Vehicle Model *</label>
                                                <input id="vehicle_model" type="text" name="vehicle_model" value="{{ old('vehicle_model') }}" 
                                                       placeholder="e.g., Corolla, Civic, Swift">
                                                @error('vehicle_model')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="input-wrapper">
                                                <i class="fas fa-calendar"></i>
                                                <label for="vehicle_year">Vehicle Year *</label>
                                                <input id="vehicle_year" type="number" name="vehicle_year" value="{{ old('vehicle_year') }}" 
                                                       placeholder="e.g., 2020" min="1990" max="2025">
                                                @error('vehicle_year')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-wrapper">
                                                <i class="fas fa-palette"></i>
                                                <label for="vehicle_color">Vehicle Color *</label>
                                                <input id="vehicle_color" type="text" name="vehicle_color" value="{{ old('vehicle_color') }}" 
                                                       placeholder="e.g., White, Black, Red">
                                                @error('vehicle_color')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="input-wrapper">
                                                <i class="fas fa-id-card"></i>
                                                <label for="license_plate">License Plate *</label>
                                                <input id="license_plate" type="text" name="license_plate" value="{{ old('license_plate') }}" 
                                                       placeholder="e.g., ABC-123">
                                                @error('license_plate')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-wrapper">
                                                <i class="fas fa-file-alt"></i>
                                                <label for="registration_number">Registration Number *</label>
                                                <input id="registration_number" type="text" name="registration_number" value="{{ old('registration_number') }}" 
                                                       placeholder="Enter vehicle registration number">
                                                @error('registration_number')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Emergency Contact Section -->
                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-semibold text-gray-900 mb-4">
                                            <i class="fas fa-phone-alt mr-2"></i>Emergency Contact
                                        </h4>

                                        <div class="input-wrapper">
                                            <i class="fas fa-phone"></i>
                                            <label for="emergency_contact">Emergency Contact Number *</label>
                                            <input id="emergency_contact" type="tel" name="emergency_contact" value="{{ old('emergency_contact') }}" 
                                                   placeholder="Enter emergency contact number">
                                            @error('emergency_contact')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <div class="input-wrapper">
                                                <i class="fas fa-user-friends"></i>
                                                <label for="emergency_contact_name">Contact Name *</label>
                                                <input id="emergency_contact_name" type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" 
                                                       placeholder="Enter contact name">
                                                @error('emergency_contact_name')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-wrapper">
                                                <i class="fas fa-heart"></i>
                                                <label for="emergency_contact_relation">Relation *</label>
                                                <select name="emergency_contact_relation">
                                                    <option value="">Select Relation</option>
                                                    <option value="father" {{ old('emergency_contact_relation') == 'father' ? 'selected' : '' }}>Father</option>
                                                    <option value="mother" {{ old('emergency_contact_relation') == 'mother' ? 'selected' : '' }}>Mother</option>
                                                    <option value="brother" {{ old('emergency_contact_relation') == 'brother' ? 'selected' : '' }}>Brother</option>
                                                    <option value="sister" {{ old('emergency_contact_relation') == 'sister' ? 'selected' : '' }}>Sister</option>
                                                    <option value="spouse" {{ old('emergency_contact_relation') == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                                    <option value="friend" {{ old('emergency_contact_relation') == 'friend' ? 'selected' : '' }}>Friend</option>
                                                    <option value="other" {{ old('emergency_contact_relation') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('emergency_contact_relation')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Passenger Specific Information -->
                                <div class="form-section" id="passenger-fields" style="display: none;">
                                    <h3>
                                        <i class="fas fa-user mr-2"></i>Passenger Information
                                    </h3>

                                    <div class="input-wrapper">
                                        <i class="fas fa-credit-card"></i>
                                        <label for="passenger_preferred_payment">Preferred Payment Method *</label>
                                        <select name="passenger_preferred_payment">
                                            <option value="">Select Payment Method</option>
                                            <option value="cash" {{ old('passenger_preferred_payment') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="card" {{ old('passenger_preferred_payment') == 'card' ? 'selected' : '' }}>Card</option>
                                            <option value="mobile_wallet" {{ old('passenger_preferred_payment') == 'mobile_wallet' ? 'selected' : '' }}>Mobile Wallet</option>
                                        </select>
                                        @error('passenger_preferred_payment')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-wrapper">
                                        <i class="fas fa-language"></i>
                                        <label for="languages">Languages Spoken</label>
                                        <select name="languages[]" multiple>
                                            <option value="urdu">Urdu</option>
                                            <option value="english">English</option>
                                            <option value="punjabi">Punjabi</option>
                                            <option value="sindhi">Sindhi</option>
                                            <option value="balochi">Balochi</option>
                                            <option value="pashto">Pashto</option>
                                        </select>
                                        <small>Hold Ctrl to select multiple languages</small>
                                        @error('languages')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-wrapper">
                                        <i class="fas fa-user-circle"></i>
                                        <label for="bio">Bio (Optional)</label>
                                        <textarea name="bio" rows="3" 
                                                  placeholder="Tell us about yourself (optional)">{{ old('bio') }}</textarea>
                                        <small>Brief description about yourself</small>
                                        @error('bio')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Emergency Contact Section for Passenger -->
                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <h4 class="text-md font-semibold text-gray-900 mb-4">
                                            <i class="fas fa-phone-alt mr-2"></i>Emergency Contact
                                        </h4>

                                        <div class="input-wrapper">
                                            <i class="fas fa-phone"></i>
                                            <label for="passenger_emergency_contact">Emergency Contact Number *</label>
                                            <input id="passenger_emergency_contact" type="tel" name="passenger_emergency_contact" value="{{ old('passenger_emergency_contact') }}" 
                                                   placeholder="Enter emergency contact number">
                                            @error('passenger_emergency_contact')
                                                <p class="error-message">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-row">
                                            <div class="input-wrapper">
                                                <i class="fas fa-user-friends"></i>
                                                <label for="passenger_emergency_contact_name">Contact Name *</label>
                                                <input id="passenger_emergency_contact_name" type="text" name="passenger_emergency_contact_name" value="{{ old('passenger_emergency_contact_name') }}" 
                                                       placeholder="Enter contact name">
                                                @error('passenger_emergency_contact_name')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="input-wrapper">
                                                <i class="fas fa-heart"></i>
                                                <label for="passenger_emergency_contact_relation">Relation *</label>
                                                <select name="passenger_emergency_contact_relation">
                                                    <option value="">Select Relation</option>
                                                    <option value="father" {{ old('passenger_emergency_contact_relation') == 'father' ? 'selected' : '' }}>Father</option>
                                                    <option value="mother" {{ old('passenger_emergency_contact_relation') == 'mother' ? 'selected' : '' }}>Mother</option>
                                                    <option value="brother" {{ old('passenger_emergency_contact_relation') == 'brother' ? 'selected' : '' }}>Brother</option>
                                                    <option value="sister" {{ old('passenger_emergency_contact_relation') == 'sister' ? 'selected' : '' }}>Sister</option>
                                                    <option value="spouse" {{ old('passenger_emergency_contact_relation') == 'spouse' ? 'selected' : '' }}>Spouse</option>
                                                    <option value="friend" {{ old('passenger_emergency_contact_relation') == 'friend' ? 'selected' : '' }}>Friend</option>
                                                    <option value="other" {{ old('passenger_emergency_contact_relation') == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('passenger_emergency_contact_relation')
                                                    <p class="error-message">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Document Upload -->
                        <div id="step-4" class="step-content">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Document Upload</h2>
                            
                            <!-- Driver Documents -->
                            <div id="driver-documents" class="space-y-8">
                                <!-- Personal Documents -->
                                <div class="form-section">
                                    <h3>
                                        <i class="fas fa-id-card mr-2"></i>Personal Documents
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- CNIC Front -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="cnic_front_image" name="cnic_front_image" accept="image/*" class="hidden" onchange="previewImage(this, 'cnic_front_preview')" required>
                                            <i class="fas fa-id-card text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">CNIC Front *</p>
                                            <p class="text-xs text-gray-500">Required for verification</p>
                                            <div id="cnic_front_preview" class="mt-2"></div>
                                        </div>

                                        <!-- CNIC Back -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="cnic_back_image" name="cnic_back_image" accept="image/*" class="hidden" onchange="previewImage(this, 'cnic_back_preview')" required>
                                            <i class="fas fa-id-card text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">CNIC Back *</p>
                                            <p class="text-xs text-gray-500">Required for verification</p>
                                            <div id="cnic_back_preview" class="mt-2"></div>
                                        </div>

                                        <!-- License -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="license_image" name="license_image" accept="image/*" class="hidden" onchange="previewImage(this, 'license_preview')" required>
                                            <i class="fas fa-id-badge text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Driving License *</p>
                                            <p class="text-xs text-gray-500">Required for drivers</p>
                                            <div id="license_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicle Images -->
                                <div class="form-section">
                                    <h3>
                                        <i class="fas fa-car mr-2"></i>Vehicle Images (Minimum 4)
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                        <!-- Vehicle Front -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="vehicle_front_image" name="vehicle_front_image" accept="image/*" class="hidden" onchange="previewImage(this, 'vehicle_front_preview')" required>
                                            <i class="fas fa-car text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Front View *</p>
                                            <p class="text-xs text-gray-500">Required</p>
                                            <div id="vehicle_front_preview" class="mt-2"></div>
                                        </div>

                                        <!-- Vehicle Back -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="vehicle_back_image" name="vehicle_back_image" accept="image/*" class="hidden" onchange="previewImage(this, 'vehicle_back_preview')" required>
                                            <i class="fas fa-car text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Back View *</p>
                                            <p class="text-xs text-gray-500">Required</p>
                                            <div id="vehicle_back_preview" class="mt-2"></div>
                                        </div>

                                        <!-- Vehicle Left -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="vehicle_left_image" name="vehicle_left_image" accept="image/*" class="hidden" onchange="previewImage(this, 'vehicle_left_preview')" required>
                                            <i class="fas fa-car text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Left Side *</p>
                                            <p class="text-xs text-gray-500">Required</p>
                                            <div id="vehicle_left_preview" class="mt-2"></div>
                                        </div>

                                        <!-- Vehicle Right -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="vehicle_right_image" name="vehicle_right_image" accept="image/*" class="hidden" onchange="previewImage(this, 'vehicle_right_preview')" required>
                                            <i class="fas fa-car text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Right Side *</p>
                                            <p class="text-xs text-gray-500">Required</p>
                                            <div id="vehicle_right_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Picture -->
                                <div class="form-section">
                                    <h3>
                                        <i class="fas fa-user-circle mr-2"></i>Profile Picture
                                    </h3>
                                    
                                    <div class="max-w-xs">
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(this, 'profile_preview')" required>
                                            <i class="fas fa-user-circle text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Profile Picture *</p>
                                            <p class="text-xs text-gray-500">Required for drivers</p>
                                            <div id="profile_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Passenger Documents -->
                            <div id="passenger-documents" class="space-y-8" style="display: none;">
                                <!-- Personal Documents -->
                                <div class="form-section">
                                    <h3>
                                        <i class="fas fa-id-card mr-2"></i>Personal Documents
                                    </h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- CNIC Front -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="passenger_cnic_front_image" name="passenger_cnic_front_image" accept="image/*" class="hidden" onchange="previewImage(this, 'passenger_cnic_front_preview')" required>
                                            <i class="fas fa-id-card text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">CNIC Front *</p>
                                            <p class="text-xs text-gray-500">Required for verification</p>
                                            <div id="passenger_cnic_front_preview" class="mt-2"></div>
                                        </div>

                                        <!-- CNIC Back -->
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="passenger_cnic_back_image" name="passenger_cnic_back_image" accept="image/*" class="hidden" onchange="previewImage(this, 'passenger_cnic_back_preview')" required>
                                            <i class="fas fa-id-card text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">CNIC Back *</p>
                                            <p class="text-xs text-gray-500">Required for verification</p>
                                            <div id="passenger_cnic_back_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Picture (Optional for Passengers) -->
                                <div class="form-section">
                                    <h3>
                                        <i class="fas fa-user-circle mr-2"></i>Profile Picture (Optional)
                                    </h3>
                                    
                                    <div class="max-w-xs">
                                        <div class="file-upload" onclick="this.querySelector('input[type=file]').click()">
                                            <input type="file" id="passenger_profile_image" name="passenger_profile_image" accept="image/*" class="hidden" onchange="previewImage(this, 'passenger_profile_preview')">
                                            <i class="fas fa-user-circle text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-600 font-medium">Profile Picture</p>
                                            <p class="text-xs text-gray-500">Optional but recommended</p>
                                            <div id="passenger_profile_preview" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Review and Submit -->
                        <div id="step-5" class="step-content">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Review Your Information</h2>
                            
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Summary</h3>
                                <div id="review-content">
                                    <!-- Review content will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div class="form-section">
                                <h3>
                                    <i class="fas fa-lock mr-2"></i>Create Password
                                </h3>
                                
                                <div class="form-row">
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <label for="password">Password *</label>
                                        <input id="password" type="password" name="password" required autocomplete="new-password" 
                                               placeholder="Enter your password">
                                        <small>Minimum 8 characters with letters and numbers</small>
                                        @error('password')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <label for="password_confirmation">Confirm Password *</label>
                                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                                               placeholder="Confirm your password">
                                        <small>Re-enter your password to confirm</small>
                                        @error('password_confirmation')
                                            <p class="error-message">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="flex justify-between mt-8">
                            <button type="button" id="prev-btn" class="btn-secondary" style="display: none;">
                                <i class="fas fa-arrow-left mr-2"></i>Previous
                            </button>
                            
                            <div class="ml-auto">
                                <button type="button" id="next-btn" class="btn-primary opacity-50 cursor-not-allowed" disabled>
                                    Next <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                                
                                <button type="submit" id="submit-btn" class="btn-primary" style="display: none;">
                                    <i class="fas fa-check mr-2"></i>Complete Registration
                                </button>
                            </div>
                        </div>

                        <!-- Login Link -->
                        <div class="mt-6 text-center">
                            <p class="text-gray-600">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">Sign in here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 5;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateStepDisplay();
            setupAccountTypeSelection();
            setupFileUploads();
        });

        // Account type selection
        function setupAccountTypeSelection() {
            const accountCards = document.querySelectorAll('.account-type-card');
            accountCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selected class from all cards
                    accountCards.forEach(c => c.classList.remove('selected'));
                    
                    // Add selected class to clicked card
                    this.classList.add('selected');
                    
                    // Update user type
                    const userType = this.dataset.type;
                    document.getElementById('user_type').value = userType;
                    
                    // Show/hide relevant fields
                    if (userType === 'driver') {
                        document.getElementById('driver-fields').style.display = 'block';
                        document.getElementById('passenger-fields').style.display = 'none';
                        document.getElementById('driver-documents').style.display = 'block';
                        document.getElementById('passenger-documents').style.display = 'none';
                    } else {
                        document.getElementById('driver-fields').style.display = 'none';
                        document.getElementById('passenger-fields').style.display = 'block';
                        document.getElementById('driver-documents').style.display = 'none';
                        document.getElementById('passenger-documents').style.display = 'block';
                    }
                    
                    // Enable next button
                    document.getElementById('next-btn').disabled = false;
                    document.getElementById('next-btn').classList.remove('opacity-50', 'cursor-not-allowed');
                });
            });
        }

        // File upload setup
        function setupFileUploads() {
            document.querySelectorAll('.file-upload').forEach(upload => {
                // Drag and drop events
                upload.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.add('dragover');
                });

                upload.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.remove('dragover');
                });

                upload.addEventListener('drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.classList.remove('dragover');
                    
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        const input = this.querySelector('input[type="file"]');
                        if (input) {
                            input.files = files;
                            const previewDiv = this.querySelector('[id$="_preview"]');
                            const previewId = previewDiv ? previewDiv.id : null;
                            previewImage(input, previewId);
                        }
                    }
                });

                // Click to upload - handled by onclick attribute
                // upload.addEventListener('click', function(e) {
                //     e.preventDefault();
                //     e.stopPropagation();
                //     const input = this.querySelector('input[type="file"]');
                //     if (input) {
                //         console.log('File upload clicked, opening file dialog...', input.id);
                //         input.focus();
                //         setTimeout(() => {
                //             input.click();
                //         }, 10);
                //     } else {
                //         console.log('No file input found in upload area');
                //     }
                // });

                // File input change event
                const input = upload.querySelector('input[type="file"]');
                if (input) {
                    input.addEventListener('change', function(e) {
                        console.log('File selected:', this.files[0]);
                        const previewDiv = this.closest('.file-upload').querySelector('[id$="_preview"]');
                        const previewId = previewDiv ? previewDiv.id : null;
                        console.log('Preview ID:', previewId);
                        if (previewId) {
                            previewImage(this, previewId);
                        }
                    });
                }
            });
        }

        // Image preview functionality
        function previewImage(input, previewId) {
            console.log('previewImage called with:', input.id, previewId);
            const file = input.files[0];
            if (file) {
                console.log('File found:', file.name, file.type, file.size);
                
                // Check if file is an image
                if (!file.type.startsWith('image/')) {
                    console.log('Not an image file:', file.type);
                    showToast('Please select an image file', 'error');
                    return;
                }
                
                // Check file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    console.log('File too large:', file.size);
                    showToast('Image size should be less than 5MB', 'error');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    console.log('FileReader loaded, looking for preview element:', previewId);
                    const preview = document.getElementById(previewId);
                    if (preview) {
                        console.log('Preview element found, creating preview');
                        preview.innerHTML = `
                            <div class="preview-container">
                                <img src="${e.target.result}" class="preview-image" alt="Preview">
                                <button type="button" class="remove-preview" onclick="removePreview('${previewId}', '${input.id}')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        
                        // Add success feedback
                        const uploadArea = input.closest('.file-upload');
                        if (uploadArea) {
                            uploadArea.classList.add('uploaded');
                        }
                        console.log('Preview created successfully');
                    } else {
                        console.log('Preview element not found:', previewId);
                    }
                };
                reader.readAsDataURL(file);
            } else {
                console.log('No file selected');
            }
        }
        
        // Remove preview function
        function removePreview(previewId, inputId) {
            const preview = document.getElementById(previewId);
            const input = document.getElementById(inputId);
            
            if (preview) {
                preview.innerHTML = '';
            }
            if (input) {
                input.value = '';
            }
            
            // Remove uploaded class
            const uploadArea = input.closest('.file-upload');
            if (uploadArea) {
                uploadArea.classList.remove('uploaded');
            }
        }

        // Navigation
        document.getElementById('next-btn').addEventListener('click', function() {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateStepDisplay();
                }
            }
        });

        document.getElementById('prev-btn').addEventListener('click', function() {
            if (currentStep > 1) {
                currentStep--;
                updateStepDisplay();
            }
        });

        // Update step display
        function updateStepDisplay() {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(step => {
                step.classList.remove('active');
            });

            // Show current step
            document.getElementById(`step-${currentStep}`).classList.add('active');

            // Update step indicators
            document.querySelectorAll('.step-item').forEach((item, index) => {
                const stepNumber = index + 1;
                item.classList.remove('active', 'completed');
                
                if (stepNumber < currentStep) {
                    item.classList.add('completed');
                } else if (stepNumber === currentStep) {
                    item.classList.add('active');
                }
            });

            // Update progress bar
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progress-fill').style.width = progress + '%';

            // Update navigation buttons
            document.getElementById('prev-btn').style.display = currentStep > 1 ? 'block' : 'none';
            
            // Update navigation buttons
            if (currentStep === totalSteps) {
                document.getElementById('next-btn').style.display = 'none';
                document.getElementById('submit-btn').style.display = 'block';
                updateReviewContent();
            } else {
                document.getElementById('next-btn').style.display = 'block';
                document.getElementById('submit-btn').style.display = 'none';
            }
        }

        // Validate current step
        function validateCurrentStep() {
            const currentStepElement = document.getElementById(`step-${currentStep}`);
            let isValid = true;
            const missingFields = [];

            console.log('Validating step:', currentStep);
            console.log('Current step element:', currentStepElement);

            // Special validation for step 1 (account type selection)
            if (currentStep === 1) {
                const selectedCard = document.querySelector('.account-type-card.selected');
                if (!selectedCard) {
                    showToast('Please select an account type before proceeding.', 'warning');
                    return false;
                }
                return true;
            }

            // Regular validation for other steps
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            console.log('Found required fields:', requiredFields.length);
            
            requiredFields.forEach(field => {
                // Skip validation for hidden fields
                const fieldContainer = field.closest('.form-section') || field.closest('div');
                if (fieldContainer && fieldContainer.style.display === 'none') {
                    console.log('Skipping hidden field:', field.id);
                    return;
                }
                
                // Get user type from selected account type card
                const selectedCard = document.querySelector('.account-type-card.selected');
                let userType = null;
                if (selectedCard) {
                    userType = selectedCard.getAttribute('data-type');
                }
                
                console.log('User type detected:', userType);
                
                // Skip validation for driver fields when passenger is selected
                if (userType === 'passenger') {
                    const driverFields = ['cnic_front_image', 'cnic_back_image', 'license_image', 'vehicle_front_image', 'vehicle_back_image', 'vehicle_left_image', 'vehicle_right_image', 'profile_image'];
                    if (driverFields.includes(field.id)) {
                        console.log('Skipping driver field for passenger:', field.id);
                        return;
                    }
                }
                
                // Skip validation for passenger fields when driver is selected
                if (userType === 'driver') {
                    const passengerFields = ['passenger_cnic_front_image', 'passenger_cnic_back_image', 'passenger_profile_image'];
                    if (passengerFields.includes(field.id)) {
                        console.log('Skipping passenger field for driver:', field.id);
                        return;
                    }
                }
                
                const wrapper = field.closest('.input-wrapper') || field.closest('.file-upload');
                let hasValue = false;
                
                if (field.type === 'file') {
                    hasValue = field.files && field.files.length > 0;
                    console.log('File field:', field.id, 'hasValue:', hasValue, 'files:', field.files.length);
                    
                    // For file inputs, also check if the field is actually visible/required for current user type
                    if (!hasValue && field.offsetParent === null) {
                        console.log('File field is hidden, skipping validation:', field.id);
                        return;
                    }
                } else {
                    hasValue = field.value.trim() !== '';
                    console.log('Text field:', field.id, 'hasValue:', hasValue, 'value:', field.value);
                }
                
                if (!hasValue) {
                    field.classList.add('error');
                    if (wrapper) {
                        wrapper.classList.add('error');
                    }
                    isValid = false;
                    missingFields.push(field.id || field.name || 'Unknown field');
                } else {
                    field.classList.remove('error');
                    if (wrapper) {
                        wrapper.classList.remove('error');
                    }
                }
            });

            console.log('Missing fields:', missingFields);
            console.log('Is valid:', isValid);

            if (!isValid) {
                showToast(`Please fill in all required fields before proceeding. Missing: ${missingFields.join(', ')}`, 'error');
            }

            return isValid;
        }

        // Toast notification function
        function showToast(message, type = 'success', duration = 5000) {
            // Create toast container if it doesn't exist
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
                document.body.appendChild(toastContainer);
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.className = `transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;
            
            // Set colors based on type
            let bgColor, textColor, icon;
            switch(type) {
                case 'success':
                    bgColor = 'bg-green-500';
                    textColor = 'text-white';
                    icon = 'fas fa-check-circle';
                    break;
                case 'error':
                    bgColor = 'bg-red-500';
                    textColor = 'text-white';
                    icon = 'fas fa-exclamation-circle';
                    break;
                case 'warning':
                    bgColor = 'bg-yellow-500';
                    textColor = 'text-white';
                    icon = 'fas fa-exclamation-triangle';
                    break;
                default:
                    bgColor = 'bg-blue-500';
                    textColor = 'text-white';
                    icon = 'fas fa-info-circle';
            }

            toast.innerHTML = `
                <div class="${bgColor} ${textColor} px-6 py-4 rounded-lg shadow-lg max-w-sm w-full">
                    <div class="flex items-center">
                        <i class="${icon} mr-3"></i>
                        <span class="font-medium">${message}</span>
                    </div>
                </div>
            `;

            toastContainer.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
            }, 100);

            // Auto remove
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }, duration);
        }

        // Update review content
        function updateReviewContent() {
            const userType = document.getElementById('user_type').value;
            const reviewContent = document.getElementById('review-content');
            
            let html = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Account Type:</strong> ${userType.charAt(0).toUpperCase() + userType.slice(1)}</p>
                        <p><strong>Name:</strong> ${document.getElementById('name').value}</p>
                        <p><strong>Email:</strong> ${document.getElementById('email').value}</p>
                        <p><strong>Phone:</strong> ${document.getElementById('phone').value}</p>
                        <p><strong>CNIC:</strong> ${document.getElementById('cnic').value}</p>
                    </div>
                    <div>
                        <p><strong>Date of Birth:</strong> ${document.getElementById('date_of_birth').value}</p>
                        <p><strong>Gender:</strong> ${document.querySelector('[name="gender"]').value}</p>
                        <p><strong>Address:</strong> ${document.querySelector('[name="address"]').value}</p>
            `;

            if (userType === 'driver') {
                html += `
                        <p><strong>License Number:</strong> ${document.getElementById('license_number').value}</p>
                        <p><strong>Vehicle Type:</strong> ${document.querySelector('[name="vehicle_type"]').value}</p>
                `;
            }

            html += `
                    </div>
                </div>
            `;

            reviewContent.innerHTML = html;
        }

        // Form submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registration-form');
            const submitBtn = document.getElementById('submit-btn');
            
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    console.log('Submit button clicked, starting form submission...');
                    console.log('Current step:', currentStep);
                    
                    // Only allow submission on final step
                    if (currentStep !== totalSteps) {
                        console.log('Not on final step, preventing submission');
                        return;
                    }
                    
                    // Get user type and remove required from irrelevant fields
                    const selectedCard = document.querySelector('.account-type-card.selected');
                    if (selectedCard) {
                        const userType = selectedCard.getAttribute('data-type');
                        console.log('User type for form submission:', userType);
                        
                        if (userType === 'passenger') {
                            const driverFields = ['cnic_front_image', 'cnic_back_image', 'license_image', 'vehicle_front_image', 'vehicle_back_image', 'vehicle_left_image', 'vehicle_right_image', 'profile_image'];
                            driverFields.forEach(fieldId => {
                                const field = document.getElementById(fieldId);
                                if (field) {
                                    console.log('Removing required from driver field:', fieldId);
                                    field.removeAttribute('required');
                                }
                            });
                        } else if (userType === 'driver') {
                            const passengerFields = ['passenger_cnic_front_image', 'passenger_cnic_back_image', 'passenger_profile_image'];
                            passengerFields.forEach(fieldId => {
                                const field = document.getElementById(fieldId);
                                if (field) {
                                    console.log('Removing required from passenger field:', fieldId);
                                    field.removeAttribute('required');
                                }
                            });
                        }
                    }
                    
                    // Remove required attribute from all hidden fields
                    const allFileFields = document.querySelectorAll('input[type="file"][required]');
                    allFileFields.forEach(field => {
                        const fieldContainer = field.closest('.form-section') || field.closest('div');
                        if (fieldContainer && fieldContainer.style.display === 'none') {
                            console.log('Removing required from hidden field:', field.id);
                            field.removeAttribute('required');
                        }
                    });
                    
                    if (validateCurrentStep()) {
                        console.log('Validation passed, submitting form...');
                        
                        // Convert languages array to comma-separated string
                        const languagesField = document.querySelector('select[name="languages[]"]');
                        if (languagesField) {
                            const selectedOptions = Array.from(languagesField.selectedOptions);
                            const languagesArray = selectedOptions.map(option => option.value);
                            
                            // Create a hidden input with the converted value
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'languages';
                            hiddenInput.value = languagesArray.join(',');
                            form.appendChild(hiddenInput);
                            
                            // Remove the original array input
                            languagesField.remove();
                            
                            console.log('Languages converted to string:', hiddenInput.value);
                        }
                        
                        // Show loading state
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';
                        this.disabled = true;
                        
                        // Submit form
                        if (form) {
                            form.submit();
                        }
                    } else {
                        console.log('Validation failed, not submitting form');
                    }
                });
            }
        });
    </script>
</body>
</html>
