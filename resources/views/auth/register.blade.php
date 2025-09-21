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
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Toast Notification System -->
    <script>
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
            toast.className = `toast-notification transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;
            
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
                case 'info':
                    bgColor = 'bg-blue-500';
                    textColor = 'text-white';
                    icon = 'fas fa-info-circle';
                    break;
                default:
                    bgColor = 'bg-gray-500';
                    textColor = 'text-white';
                    icon = 'fas fa-bell';
            }

            toast.innerHTML = `
                <div class="${bgColor} ${textColor} px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 min-w-80 max-w-96">
                    <i class="${icon} text-xl"></i>
                    <span class="flex-1">${message}</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            // Add to container
            toastContainer.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100);

            // Auto remove
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }, duration);
        }

        // Make showToast globally available
        window.showToast = showToast;
    </script>
    
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
            padding: 2rem 0;
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

        .shape:nth-child(5) {
            width: 90px;
            height: 90px;
            top: 40%;
            left: 5%;
            animation-delay: 3s;
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
            padding: 3rem;
            width: 100%;
            max-width: 700px;
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

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--gold));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 10px 30px rgba(1, 28, 114, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .brand-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .brand-subtitle {
            color: var(--light-muted);
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .brand-description {
            color: var(--light-muted);
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.4;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--light-text);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(1, 28, 114, 0.1);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-muted);
            font-size: 1.1rem;
            transition: color 0.3s ease;
            z-index: 2;
            pointer-events: none;
        }

        .form-input:focus + .input-icon {
            color: var(--primary);
        }

        .form-input:focus ~ .input-icon {
            color: var(--primary);
        }

        /* Ensure form fields stay within card boundaries */
        .form-group {
            overflow: hidden;
        }

        .form-input {
            max-width: 100%;
        }

        /* Special styling for textarea with icons */
        textarea.form-input {
            padding-top: 2.5rem;
            resize: vertical;
        }

        .error-message {
            color: var(--warning);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .error-message i {
            margin-right: 0.5rem;
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .strength-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
            margin-top: 0.25rem;
        }

        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: var(--warning); width: 25%; }
        .strength-fair { background: var(--secondary); width: 50%; }
        .strength-good { background: var(--gold); width: 75%; }
        .strength-strong { background: var(--success); width: 100%; }

        .register-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--primary), #1a237e);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(1, 28, 114, 0.3);
            margin-bottom: 2rem;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(1, 28, 114, 0.4);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .register-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .register-btn:hover::before {
            left: 100%;
        }

        .login-link {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .login-link p {
            color: var(--light-muted);
            margin-bottom: 1rem;
        }

        .login-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, var(--gold), #f4a261);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.4);
            color: white;
        }

        .login-btn i {
            margin-right: 0.5rem;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(1, 28, 114, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(1, 28, 114, 0.1);
        }

        .terms-checkbox input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            margin-right: 0.75rem;
            margin-top: 0.1rem;
        }

        .terms-checkbox label {
            color: var(--light-muted);
            font-size: 0.9rem;
            line-height: 1.4;
            cursor: pointer;
        }

        .terms-checkbox a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .terms-checkbox a:hover {
            color: var(--gold);
        }

        .user-type-selection {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(1, 28, 114, 0.05);
            border-radius: 16px;
            border: 2px solid rgba(1, 28, 114, 0.1);
        }

        .user-type-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--light-text);
            margin-bottom: 1rem;
            text-align: center;
        }

        .user-type-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .user-type-option {
            position: relative;
        }

        .user-type-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .user-type-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            text-align: center;
        }

        .user-type-label:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(1, 28, 114, 0.1);
        }

        .user-type-option input[type="radio"]:checked + .user-type-label {
            border-color: var(--primary);
            background: rgba(1, 28, 114, 0.05);
            box-shadow: 0 5px 15px rgba(1, 28, 114, 0.15);
        }

        .user-type-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            font-size: 1.5rem;
            color: white;
        }

        .driver-icon {
            background: linear-gradient(135deg, var(--success), #10b981);
        }

        .passenger-icon {
            background: linear-gradient(135deg, var(--primary), #1a237e);
        }

        .user-type-name {
            font-weight: 600;
            color: var(--light-text);
            margin-bottom: 0.25rem;
        }

        .user-type-desc {
            font-size: 0.8rem;
            color: var(--light-muted);
            line-height: 1.3;
        }

        .professional-fields {
            visibility: hidden;
            height: 0;
            overflow: hidden;
            margin-top: 1rem;
            padding: 0;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease-out;
        }

        .professional-fields.show {
            visibility: visible;
            height: auto;
            padding: 1rem;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 640px) {
            .register-card {
                margin: 1rem;
                padding: 2rem;
                max-width: 100%;
            }
            
            .brand-title {
                font-size: 1.5rem;
            }
            
            .user-type-options {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
            
            .grid.grid-cols-1.md\\:grid-cols-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Floating Background Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="register-card">
            <!-- Logo and Brand -->
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="logo-img">
                </div>
                <h1 class="brand-title">Raah-e-Haq</h1>
                <p class="brand-subtitle">Join Our Ride-Sharing Community</p>
                <p class="brand-description">Create your account to start your journey with Pakistan's most trusted ride-sharing platform</p>
            </div>

            <!-- Register Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

                <!-- User Type Selection -->
                <div class="user-type-selection">
                    <h3 class="user-type-title">Choose Your Role</h3>
                    <div class="user-type-options">
                        <div class="user-type-option">
                            <input type="radio" id="driver" name="user_type" value="driver" required>
                            <label for="driver" class="user-type-label">
                                <div class="user-type-icon driver-icon">
                                    <i class="fas fa-car"></i>
                                </div>
                                <div class="user-type-name">Driver</div>
                                <div class="user-type-desc">Earn money by providing rides</div>
                            </label>
                        </div>
                        <div class="user-type-option">
                            <input type="radio" id="passenger" name="user_type" value="passenger" required>
                            <label for="passenger" class="user-type-label">
                                <div class="user-type-icon passenger-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="user-type-name">Passenger</div>
                                <div class="user-type-desc">Book rides to your destination</div>
                            </label>
                        </div>
                    </div>
                </div>

        <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input id="name" 
                           class="form-input @error('name') border-red-500 @enderror" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           placeholder="Enter your full name">
                    <i class="fas fa-user input-icon"></i>
                    @error('name')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
        </div>

        <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input id="email" 
                           class="form-input @error('email') border-red-500 @enderror" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           placeholder="Enter your email address">
                    <i class="fas fa-envelope input-icon"></i>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
        </div>

        <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" 
                           class="form-input @error('password') border-red-500 @enderror"
                            type="password"
                            name="password"
                           required 
                           autocomplete="new-password"
                           placeholder="Create a strong password">
                    <i class="fas fa-lock input-icon"></i>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="password-strength" id="password-strength">
                        <div class="strength-bar">
                            <div class="strength-fill" id="strength-fill"></div>
                        </div>
                        <span id="strength-text">Password strength</span>
                    </div>
        </div>

        <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" 
                           class="form-input @error('password_confirmation') border-red-500 @enderror"
                           type="password"
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           placeholder="Confirm your password">
                    <i class="fas fa-lock input-icon"></i>
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Professional Fields for Drivers -->
                <div class="professional-fields" id="driverFields">
                    <h4 class="form-label" style="margin-bottom: 1rem; color: var(--gold);">
                        <i class="fas fa-id-card mr-2"></i>Driver Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="license_number" class="form-label">Driving License</label>
                            <input id="license_number" 
                                   class="form-input" 
                                   type="text" 
                                   name="license_number" 
                                   placeholder="License Number">
                            <i class="fas fa-id-badge input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="vehicle_type" class="form-label">Vehicle Type</label>
                            <select id="vehicle_type" class="form-input" name="vehicle_type">
                                <option value="">Select Vehicle Type</option>
                                <option value="car">Car</option>
                                <option value="motorcycle">Motorcycle</option>
                                <option value="auto">Auto Rickshaw</option>
                            </select>
                            <i class="fas fa-car input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                            <input id="emergency_contact" 
                                   class="form-input" 
                                   type="tel" 
                                   name="emergency_contact" 
                                   placeholder="+92 300 1234567">
                            <i class="fas fa-phone-alt input-icon"></i>
                        </div>

                        <div class="form-group">
                            <label for="preferred_payment" class="form-label">Preferred Payment</label>
                            <select id="preferred_payment" class="form-input" name="preferred_payment">
                                <option value="">Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="card">Credit/Debit Card</option>
                                <option value="mobile">Mobile Payment</option>
                            </select>
                            <i class="fas fa-credit-card input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Professional Fields for Passengers -->
                <div class="professional-fields" id="passengerFields">
                    <h4 class="form-label" style="margin-bottom: 1rem; color: var(--primary);">
                        <i class="fas fa-user mr-2"></i>Passenger Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input id="phone" 
                                   class="form-input" 
                                   type="tel" 
                                   name="phone" 
                                   placeholder="+92 300 1234567">
                            <i class="fas fa-phone input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="cnic" class="form-label">CNIC Number</label>
                            <input id="cnic" 
                                   class="form-input" 
                                   type="text" 
                                   name="cnic" 
                                   placeholder="12345-1234567-1">
                            <i class="fas fa-id-card input-icon"></i>
                        </div>
                        
                        <div class="form-group md:col-span-2">
                            <label for="address" class="form-label">Address</label>
                            <textarea id="address" 
                                      class="form-input" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Enter your complete address"
                                      style="padding-top: 2.5rem; resize: vertical;"></textarea>
                            <i class="fas fa-map-marker-alt input-icon" style="top: 2rem; z-index: 2; pointer-events: none;"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="emergency_contact" class="form-label">Emergency Contact</label>
                            <input id="emergency_contact" 
                                   class="form-input" 
                                   type="tel" 
                                   name="emergency_contact" 
                                   placeholder="+92 300 1234567">
                            <i class="fas fa-phone-alt input-icon"></i>
        </div>

                        <div class="form-group">
                            <label for="preferred_payment" class="form-label">Preferred Payment</label>
                            <select id="preferred_payment" class="form-input" name="preferred_payment">
                                <option value="">Select Payment Method</option>
                                <option value="cash">Cash</option>
                                <option value="card">Credit/Debit Card</option>
                                <option value="mobile">Mobile Payment</option>
                            </select>
                            <i class="fas fa-credit-card input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="terms-checkbox">
                    <input id="terms" type="checkbox" name="terms" required>
                    <label for="terms">
                        I agree to the <a href="#" target="_blank">Terms of Service</a> and <a href="#" target="_blank">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit" class="register-btn" id="registerBtn">
                    <i class="fas fa-user-plus mr-2" id="registerIcon"></i>
                    <span id="registerText">Create Account</span>
                </button>
            </form>

            <!-- Login Link -->
            <div class="login-link">
                <p>Already have an account?</p>
                <a href="{{ route('login') }}" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </a>
            </div>
        </div>
    </div>

    <script>
        // Form elements
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const registerBtn = document.getElementById('registerBtn');
        const registerIcon = document.getElementById('registerIcon');
        const registerText = document.getElementById('registerText');
        const termsCheckbox = document.getElementById('terms');
        const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
        const driverFields = document.getElementById('driverFields');
        const passengerFields = document.getElementById('passengerFields');

        // User type selection handler
        userTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'driver') {
                    driverFields.classList.add('show');
                    passengerFields.classList.remove('show');
                } else if (this.value === 'passenger') {
                    passengerFields.classList.add('show');
                    driverFields.classList.remove('show');
                }
                validateForm();
            });
        });

        // Live validation function
        function validateForm() {
            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();
            const userType = document.querySelector('input[name="user_type"]:checked');
            const terms = termsCheckbox.checked;
            
            const isValid = name.length > 0 && 
                           email.length > 0 && 
                           email.includes('@') && 
                           password.length >= 6 && 
                           password === confirmPassword && 
                           userType && 
                           terms;
            
            registerBtn.disabled = !isValid;
            registerBtn.style.opacity = isValid ? '1' : '0.6';
            registerBtn.style.cursor = isValid ? 'pointer' : 'not-allowed';
        }

        // Password strength checker
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.getElementById('strength-fill');
            const strengthText = document.getElementById('strength-text');
            
            let strength = 0;
            let strengthLabel = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            strengthFill.className = 'strength-fill';
            
            if (strength < 2) {
                strengthFill.classList.add('strength-weak');
                strengthLabel = 'Weak';
            } else if (strength < 3) {
                strengthFill.classList.add('strength-fair');
                strengthLabel = 'Fair';
            } else if (strength < 4) {
                strengthFill.classList.add('strength-good');
                strengthLabel = 'Good';
            } else {
                strengthFill.classList.add('strength-strong');
                strengthLabel = 'Strong';
            }
            
            strengthText.textContent = `Password strength: ${strengthLabel}`;
            validateForm();
        });

        // Email validation
        emailInput.addEventListener('blur', function() {
            const email = this.value.trim();
            if (email && !email.includes('@')) {
                this.style.borderColor = 'var(--warning)';
                showFieldError(this, 'Please enter a valid email address');
            } else {
                this.style.borderColor = '#e5e7eb';
                hideFieldError(this);
            }
            validateForm();
        });

        // Password confirmation validation
        confirmPasswordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.style.borderColor = 'var(--warning)';
                showFieldError(this, 'Passwords do not match');
            } else {
                this.style.borderColor = '#e5e7eb';
                hideFieldError(this);
            }
            validateForm();
        });

        // Name validation
        nameInput.addEventListener('blur', function() {
            const name = this.value.trim();
            if (name && name.length < 2) {
                this.style.borderColor = 'var(--warning)';
                showFieldError(this, 'Name must be at least 2 characters');
            } else {
                this.style.borderColor = '#e5e7eb';
                hideFieldError(this);
            }
            validateForm();
        });

        // Terms checkbox validation
        termsCheckbox.addEventListener('change', validateForm);

        // Show field error
        function showFieldError(input, message) {
            hideFieldError(input);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error';
            errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
            errorDiv.style.cssText = `
                color: var(--warning);
                font-size: 0.875rem;
                margin-top: 0.5rem;
                display: flex;
                align-items: center;
                animation: shake 0.5s ease-in-out;
            `;
            input.parentElement.appendChild(errorDiv);
        }

        // Hide field error
        function hideFieldError(input) {
            const existingError = input.parentElement.querySelector('.field-error');
            if (existingError) {
                existingError.remove();
            }
        }

        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Ensure all fields are included in form submission
            const userType = document.querySelector('input[name="user_type"]:checked');
            
            if (userType && userType.value === 'driver') {
                // Make sure driver fields are visible and enabled
                driverFields.classList.add('show');
                driverFields.querySelectorAll('input, select').forEach(field => {
                    field.disabled = false;
                });
            } else if (userType && userType.value === 'passenger') {
                // Make sure passenger fields are visible and enabled
                passengerFields.classList.add('show');
                passengerFields.querySelectorAll('input, select').forEach(field => {
                    field.disabled = false;
                });
            }
            
            // Disable button and show loading
            registerBtn.disabled = true;
            registerIcon.className = 'fas fa-spinner fa-spin mr-2';
            registerText.textContent = 'Creating Account...';
            
            // Submit the form after a short delay for UX
            setTimeout(() => {
                this.submit();
            }, 500);
        });

        // Add focus animations
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
                this.style.borderColor = 'var(--primary)';
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
                this.style.borderColor = '#e5e7eb';
            });
        });

        // Add event listeners for live validation
        nameInput.addEventListener('input', validateForm);
        emailInput.addEventListener('input', validateForm);
        confirmPasswordInput.addEventListener('input', validateForm);

        // Initial validation
        validateForm();
    </script>
</body>
</html>