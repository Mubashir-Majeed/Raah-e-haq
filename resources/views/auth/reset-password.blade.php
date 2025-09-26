<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Reset Password</title>

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
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = `toast-notification transform transition-all duration-300 ease-in-out translate-x-full opacity-0`;
            
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

            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100);

            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }, duration);
        }

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

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
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

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            padding: 3rem;
            width: 100%;
            max-width: 450px;
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

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
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
            display: flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
        }

        .form-input:focus ~ .input-icon {
            color: var(--primary);
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

        .reset-btn {
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
        }

        .reset-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(1, 28, 114, 0.4);
        }

        .reset-btn:active {
            transform: translateY(0);
        }

        .reset-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .reset-btn:hover::before {
            left: 100%;
        }

        .back-link {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .back-link p {
            color: var(--light-muted);
            margin-bottom: 1rem;
        }

        .back-btn {
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

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.4);
            color: white;
        }

        .back-btn i {
            margin-right: 0.5rem;
        }

        .session-status {
            background: linear-gradient(135deg, var(--success), #10b981);
            color: white;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            text-align: center;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-text {
            color: var(--light-muted);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 2rem;
            text-align: center;
            background: rgba(1, 28, 114, 0.05);
            padding: 1rem;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
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

        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #059669; width: 100%; }

        @media (max-width: 640px) {
            .login-card {
                margin: 1rem;
                padding: 2rem;
            }
            
            .brand-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Floating Background Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

        <div class="login-card">
            <!-- Logo and Brand -->
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="logo-img">
                </div>
                <h1 class="brand-title">Raah-e-Haq</h1>
                <p class="brand-subtitle">Reset Password</p>
                <p class="brand-description">Create a new secure password for your account</p>
            </div>

            <!-- Info Text -->
            <div class="info-text">
                <i class="fas fa-shield-alt mr-2"></i>
                Please enter your email address and create a new secure password. Make sure to choose a strong password that you haven't used before.
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="session-status">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showToast('{{ session('status') }}', 'success', 8000);
                    });
                </script>
            @endif

            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input id="email" 
                               class="form-input @error('email') border-red-500 @enderror" 
                               type="email" 
                               name="email" 
                               value="{{ old('email', $request->email) }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="Enter your email address">
                    </div>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">New Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password" 
                               class="form-input @error('password') border-red-500 @enderror"
                               type="password"
                               name="password"
                               required 
                               autocomplete="new-password"
                               placeholder="Enter your new password">
                    </div>
                    <div class="password-strength" id="passwordStrength"></div>
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthBar"></div>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input id="password_confirmation" 
                               class="form-input @error('password_confirmation') border-red-500 @enderror"
                               type="password"
                               name="password_confirmation"
                               required 
                               autocomplete="new-password"
                               placeholder="Confirm your new password">
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Reset Button -->
                <button type="submit" class="reset-btn" id="resetBtn">
                    <i class="fas fa-key mr-2" id="resetIcon"></i>
                    <span id="resetText">Reset Password</span>
                </button>
            </form>

            <!-- Back to Login Link -->
            <div class="back-link">
                <p>Remember your password?</p>
                <a href="{{ route('login') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
        // Live validation and form handling
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const resetBtn = document.getElementById('resetBtn');
        const resetIcon = document.getElementById('resetIcon');
        const resetText = document.getElementById('resetText');
        const passwordStrength = document.getElementById('passwordStrength');
        const strengthBar = document.getElementById('strengthBar');

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = [];

            if (password.length >= 8) strength++;
            else feedback.push('At least 8 characters');

            if (/[a-z]/.test(password)) strength++;
            else feedback.push('Lowercase letter');

            if (/[A-Z]/.test(password)) strength++;
            else feedback.push('Uppercase letter');

            if (/[0-9]/.test(password)) strength++;
            else feedback.push('Number');

            if (/[^A-Za-z0-9]/.test(password)) strength++;
            else feedback.push('Special character');

            return { strength, feedback };
        }

        // Update password strength indicator
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const { strength, feedback } = checkPasswordStrength(password);

            if (password.length === 0) {
                passwordStrength.textContent = '';
                strengthBar.className = 'strength-fill';
                strengthBar.style.width = '0%';
                return;
            }

            let strengthText, strengthClass;
            switch(strength) {
                case 0:
                case 1:
                    strengthText = 'Very Weak';
                    strengthClass = 'strength-weak';
                    break;
                case 2:
                    strengthText = 'Weak';
                    strengthClass = 'strength-weak';
                    break;
                case 3:
                    strengthText = 'Fair';
                    strengthClass = 'strength-fair';
                    break;
                case 4:
                    strengthText = 'Good';
                    strengthClass = 'strength-good';
                    break;
                case 5:
                    strengthText = 'Strong';
                    strengthClass = 'strength-strong';
                    break;
            }

            passwordStrength.innerHTML = `
                <span style="color: ${strength < 3 ? 'var(--warning)' : 'var(--success)'};">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Password Strength: ${strengthText}
                </span>
            `;
            strengthBar.className = `strength-fill ${strengthClass}`;
        });

        // Live validation function
        function validateForm() {
            const email = emailInput.value.trim();
            const password = passwordInput.value.trim();
            const confirmPassword = confirmPasswordInput.value.trim();
            
            const isValid = email.length > 0 && 
                          email.includes('@') && 
                          password.length >= 8 && 
                          password === confirmPassword;
            
            resetBtn.disabled = !isValid;
            resetBtn.style.opacity = isValid ? '1' : '0.6';
            resetBtn.style.cursor = isValid ? 'pointer' : 'not-allowed';
        }

        // Add event listeners for live validation
        emailInput.addEventListener('input', validateForm);
        passwordInput.addEventListener('input', validateForm);
        confirmPasswordInput.addEventListener('input', validateForm);

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
        });

        // Password validation
        passwordInput.addEventListener('blur', function() {
            const password = this.value.trim();
            if (password && password.length < 8) {
                this.style.borderColor = 'var(--warning)';
                showFieldError(this, 'Password must be at least 8 characters');
            } else {
                this.style.borderColor = '#e5e7eb';
                hideFieldError(this);
            }
        });

        // Confirm password validation
        confirmPasswordInput.addEventListener('blur', function() {
            const password = passwordInput.value.trim();
            const confirmPassword = this.value.trim();
            if (confirmPassword && password !== confirmPassword) {
                this.style.borderColor = 'var(--warning)';
                showFieldError(this, 'Passwords do not match');
            } else {
                this.style.borderColor = '#e5e7eb';
                hideFieldError(this);
            }
        });

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
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable button and show loading
            resetBtn.disabled = true;
            resetIcon.className = 'fas fa-spinner fa-spin mr-2';
            resetText.textContent = 'Resetting Password...';
            
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

        // Initial validation
        validateForm();
    </script>
</body>
</html>
