<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raah-e-Haq - Your Trusted Journey Partner</title>
    <meta name="description" content="Raah-e-Haq - Professional ride-hailing service with secure authentication, real-time tracking, and seamless user experience. Your trusted journey partner.">
    <meta name="keywords" content="ride, taxi, transportation, booking, app, Raah-e-Haq, journey, reliable, Pakistan">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpeg') }}">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#011c72ff',
                        'secondary': 'orange',
                        'gold': '#D4AF37',
                        'platinum': '#C0C0C0',
                        'success': '#058a0bee',
                        'warning': '#ce0a0aff',
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
        }

        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, #1a237e 100%);
        }
        
        .hero-bg {
            background: linear-gradient(135deg, var(--primary) 0%, #1a237e 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in-left {
            animation: slideInLeft 1s ease-out;
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .slide-in-right {
            animation: slideInRight 1s ease-out;
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(1, 28, 114, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #1a237e 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(1, 28, 114, 0.4);
        }

        /* Professional Gradients */
        .gradient-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #1a237e 100%);
        }
        .gradient-secondary {
            background: linear-gradient(135deg, var(--secondary) 0%, #ff8c00 100%);
        }
        .gradient-gold {
            background: linear-gradient(135deg, var(--gold) 0%, #ffd700 100%);
        }
        .gradient-success {
            background: linear-gradient(135deg, var(--success) 0%, #00c851 100%);
        }
        .gradient-warning {
            background: linear-gradient(135deg, var(--warning) 0%, #ff4444 100%);
        }

        /* Professional Cards */
        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(1, 28, 114, 0.1);
            box-shadow: 0 4px 15px rgba(1, 28, 114, 0.05);
            transition: all 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(1, 28, 114, 0.1);
        }

        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Navigation Styles */
        #navbar {
            background: white !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 9999 !important;
            width: 100% !important;
        }

        #navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* Ensure navbar links are always visible */
        #navbar a {
            color: #374151 !important;
            transition: color 0.3s ease;
        }

        #navbar a:hover {
            color: #1d4ed8 !important;
        }

        /* Ensure navbar is always on top */
        .navbar-fixed {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 9999 !important;
        }

        /* Ensure button text is always visible */
        #navbar a.bg-blue-600 {
            color: white !important;
            font-weight: 500 !important;
        }

        #navbar a.bg-blue-600:hover {
            color: white !important;
            background-color: #1d4ed8 !important;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            #navbar .hidden {
                display: none !important;
            }
            
            #navbar .md\\:block {
                display: none !important;
            }
            
            #navbar .md\\:hidden {
                display: block !important;
            }
            
            /* Mobile menu styles */
            #mobile-menu {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border-top: 1px solid #e5e7eb;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                z-index: 50;
            }
            
            /* Mobile button spacing */
            .mobile-menu-button {
                padding: 8px;
                margin-left: 8px;
            }
            
            /* Mobile logo adjustments */
            .mobile-logo {
                flex: 1;
            }
            
            .mobile-logo h1 {
                font-size: 1.25rem;
            }
            
            .mobile-logo p {
                font-size: 0.625rem;
            }
        }

        /* Extra small screens */
        @media (max-width: 480px) {
            .mobile-logo h1 {
                font-size: 1.125rem;
            }
            
            .mobile-logo p {
                font-size: 0.5rem;
            }
            
            #navbar .flex.items-center.space-x-4 {
                gap: 0.5rem;
            }
        }

        /* Mobile responsive sections */
        @media (max-width: 768px) {
            .hero-section {
                padding-top: 80px;
                min-height: 100vh;
            }
            
            .section-padding {
                padding: 3rem 1rem;
            }
            
            .feature-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .testimonial-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .section-padding {
                padding: 2rem 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .hero-title {
                font-size: 2rem;
                line-height: 1.2;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .feature-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Section -->
                <div class="flex items-center mobile-logo">
                    <div class="flex-shrink-0">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 gradient-primary rounded-xl flex items-center justify-center mr-2 sm:mr-3">
                                <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="w-6 h-6 sm:w-8 sm:h-8 rounded-lg">
                            </div>
                            <div>
                                <h1 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800">Raah-e-Haq</h1>
                                <p class="text-xs text-gray-500 -mt-1 hidden sm:block">Your Trusted Journey</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#home" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Home</a>
                        <a href="#features" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Features</a>
                        <a href="#about" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">About</a>
                        <a href="#contact" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Contact</a>
                    </div>
                </div>
                
                <!-- Desktop Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors shadow-lg hover:shadow-xl">Get Started</a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden mobile-menu-button">
                    <button type="button" class="text-gray-700 hover:text-blue-600 focus:outline-none focus:text-blue-600 p-2" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t shadow-lg">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="#home" class="text-gray-700 hover:text-blue-600 block px-3 py-3 rounded-md text-base font-medium transition-colors border-b border-gray-100" onclick="closeMobileMenu()">Home</a>
                <a href="#features" class="text-gray-700 hover:text-blue-600 block px-3 py-3 rounded-md text-base font-medium transition-colors border-b border-gray-100" onclick="closeMobileMenu()">Features</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600 block px-3 py-3 rounded-md text-base font-medium transition-colors border-b border-gray-100" onclick="closeMobileMenu()">About</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600 block px-3 py-3 rounded-md text-base font-medium transition-colors border-b border-gray-100" onclick="closeMobileMenu()">Contact</a>
                <div class="pt-4 space-y-2">
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 block px-3 py-3 rounded-md text-base font-medium transition-colors bg-gray-50">Login</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white block px-3 py-3 rounded-md text-base font-medium hover:opacity-90 transition-all text-center">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden hero-section">
        <!-- Background Image -->
        <div class="absolute inset-0 gradient-primary">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
            </div>
        </div>
        
        <!-- Floating elements -->
        <div class="absolute top-20 left-10 floating">
            <div class="w-20 h-20 bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-car text-white text-3xl"></i>
            </div>
        </div>
        <div class="absolute top-40 right-20 floating" style="animation-delay: 1s;">
            <div class="w-16 h-16 bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-map-marker-alt text-white text-2xl"></i>
            </div>
        </div>
        <div class="absolute bottom-40 left-20 floating" style="animation-delay: 2s;">
            <div class="w-18 h-18 bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-mobile-alt text-white text-2xl"></i>
            </div>
        </div>
        <div class="absolute top-60 right-40 floating" style="animation-delay: 3s;">
            <div class="w-14 h-14 bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-4 sm:px-6 py-2 mb-4 sm:mb-6 fade-in">
                        <i class="fas fa-star text-yellow-300 mr-2 text-sm sm:text-base"></i>
                        <span class="text-white font-medium text-sm sm:text-base">Trusted by 2,500+ Users</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 sm:mb-6 fade-in leading-tight">
                        Your Trusted
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 block sm:inline">Journey Partner</span>
                    </h1>
                    <p class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-6 sm:mb-8 max-w-2xl mx-auto lg:mx-0 fade-in" style="animation-delay: 0.5s;">
                        Experience seamless transportation with Raah-e-Haq. 
                        Secure, fast, and always reliable - your journey, our commitment.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start fade-in" style="animation-delay: 1s;">
                        <a href="{{ route('register') }}" class="btn-primary text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold inline-flex items-center justify-center shadow-2xl">
                            <i class="fas fa-rocket mr-2"></i>
                            Start Your Journey
                        </a>
                        <a href="#features" class="bg-white bg-opacity-20 backdrop-blur-sm text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg text-base sm:text-lg font-semibold hover:bg-opacity-30 transition-all inline-flex items-center justify-center border border-white border-opacity-30">
                            <i class="fas fa-play mr-2"></i>
                            Watch Demo
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-6 mt-8 sm:mt-12 fade-in" style="animation-delay: 1.5s;">
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-white mb-1">2,500+</div>
                            <div class="text-gray-300 text-xs sm:text-sm">Active Users</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-white mb-1">200+</div>
                            <div class="text-gray-300 text-xs sm:text-sm">Verified Drivers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-bold text-white mb-1">4.8★</div>
                            <div class="text-gray-300 text-xs sm:text-sm">Rating</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Content - Hero Image -->
                <div class="relative fade-in mt-8 lg:mt-0" style="animation-delay: 0.8s;">
                    <div class="relative flex justify-center">
                        <!-- Main Phone Mockup -->
                        <div class="relative mx-auto w-72 h-80 sm:w-80 sm:h-96 bg-gray-900 rounded-3xl p-2 shadow-2xl">
                            <div class="w-full h-full gradient-primary rounded-2xl flex items-center justify-center">
                                <div class="text-center text-white px-4">
                                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-3 sm:mb-4">
                                        <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg">
                                    </div>
                                    <h3 class="text-lg sm:text-xl font-bold">Raah-e-Haq</h3>
                                    <p class="text-xs sm:text-sm opacity-80">Your Journey Partner</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Cards -->
                        <div class="absolute -top-2 -right-2 sm:-top-4 sm:-right-4 bg-white rounded-xl p-3 sm:p-4 shadow-xl floating" style="animation-delay: 2s;">
                            <div class="flex items-center">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center mr-2 sm:mr-3">
                                    <i class="fas fa-check text-green-600 text-sm sm:text-base"></i>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-semibold text-gray-900">Ride Confirmed</div>
                                    <div class="text-xs text-gray-500">Driver arriving in 3 min</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-2 -left-2 sm:-bottom-4 sm:-left-4 bg-white rounded-xl p-3 sm:p-4 shadow-xl floating" style="animation-delay: 2.5s;">
                            <div class="flex items-center">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 rounded-full flex items-center justify-center mr-2 sm:mr-3">
                                    <i class="fas fa-map-marker-alt text-blue-600 text-sm sm:text-base"></i>
                                </div>
                                <div>
                                    <div class="text-xs sm:text-sm font-semibold text-gray-900">Live Tracking</div>
                                    <div class="text-xs text-gray-500">Real-time location</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 sm:py-20 bg-gradient-to-br from-gray-50 to-blue-50 section-padding">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 sm:mb-16">
                    <div class="inline-flex items-center bg-blue-100 text-blue-800 px-3 sm:px-4 py-2 rounded-full text-xs sm:text-sm font-medium mb-4">
                        <i class="fas fa-star mr-2"></i>
                        Why Choose Raah-e-Haq?
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 sm:mb-6 section-title">
                        Advanced Platform
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 block sm:inline">Features</span>
                    </h2>
                    <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
                        Powered by cutting-edge technology with comprehensive admin controls, real-time analytics, and enterprise-grade security
                    </p>
                </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 feature-grid">
                <!-- Feature 1 -->
                <div class="card-hover bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden group feature-card">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 gradient-primary rounded-2xl flex items-center justify-center mb-4 sm:mb-6 shadow-lg">
                            <i class="fas fa-shield-alt text-white text-lg sm:text-2xl"></i>
                        </div>
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4">Advanced Security</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">
                                Enterprise-grade security with dual authentication, login monitoring, security events tracking, and real-time threat detection.
                            </p>
                        <div class="flex items-center text-blue-600 font-medium">
                            <span class="text-sm">Learn More</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 2 -->
                <div class="card-hover bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden group feature-card">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-100 to-green-200 rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 gradient-success rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                        </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Live Driver Tracking</h3>
                            <p class="text-gray-600 mb-4">
                                Real-time GPS tracking with driver location monitoring, route optimization, and comprehensive tracking analytics for complete transparency.
                            </p>
                        <div class="flex items-center text-green-600 font-medium">
                            <span class="text-sm">Learn More</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 3 -->
                <div class="card-hover bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden group feature-card">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 gradient-secondary rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-mobile-alt text-white text-2xl"></i>
                        </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Smart Ride Management</h3>
                            <p class="text-gray-600 mb-4">
                                Intelligent ride management system with automated matching, status tracking, fare calculation, and comprehensive ride analytics.
                            </p>
                        <div class="flex items-center text-purple-600 font-medium">
                            <span class="text-sm">Learn More</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 4 -->
                <div class="card-hover bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden group feature-card">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 gradient-gold rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-credit-card text-white text-2xl"></i>
                        </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Advanced Payment System</h3>
                            <p class="text-gray-600 mb-4">
                                Comprehensive payment processing with multiple options, transaction tracking, revenue analytics, and automated commission management.
                            </p>
                        <div class="flex items-center text-yellow-600 font-medium">
                            <span class="text-sm">Learn More</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 5 -->
                <div class="card-hover bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden group feature-card">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-red-100 to-red-200 rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 gradient-warning rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-headset text-white text-2xl"></i>
                        </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Comprehensive Support System</h3>
                            <p class="text-gray-600 mb-4">
                                Advanced support ticket management with automated categorization, priority handling, and detailed analytics for optimal customer service.
                            </p>
                        <div class="flex items-center text-red-600 font-medium">
                            <span class="text-sm">Learn More</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Feature 6 -->
                <div class="card-hover bg-white p-6 sm:p-8 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden group feature-card">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-full -translate-y-16 translate-x-16 opacity-20 group-hover:opacity-30 transition-opacity"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 gradient-primary rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Real-time Analytics</h3>
                            <p class="text-gray-600 mb-4">
                                Comprehensive analytics dashboard with user insights, revenue tracking, performance metrics, and detailed reporting for data-driven decisions.
                            </p>
                        <div class="flex items-center text-indigo-600 font-medium">
                            <span class="text-sm">Learn More</span>
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23000000" fill-opacity="0.1"><path d="M50 50c0-27.614-22.386-50-50-50v100c27.614 0 50-22.386 50-50z"/></g></svg>');"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-6 py-3 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-info-circle mr-2"></i>
                    About Raah-e-Haq
                </div>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">
                    Your Trusted Journey
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Partner</span>
                </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        A comprehensive ride-hailing platform with advanced admin controls, real-time analytics, and enterprise-grade security for modern transportation needs
                    </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="slide-in-left">
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-road text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Enterprise-Grade Platform</h3>
                                <p class="text-gray-600">
                                    Built with Laravel and modern technologies, featuring comprehensive admin controls, real-time analytics, and advanced security systems for professional ride-hailing operations.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-success rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Advanced Analytics</h3>
                                <p class="text-gray-600">
                                    Comprehensive dashboard with user analytics, revenue tracking, ride performance metrics, and detailed reporting for data-driven business decisions.
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 gradient-secondary rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-cogs text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Comprehensive Management</h3>
                                <p class="text-gray-600">
                                    Complete admin panel with user management, ride monitoring, payment processing, support ticket system, referral management, and security controls.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-8 mt-12">
                        <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
                            <div class="text-4xl font-bold text-blue-600 mb-2">2,500+</div>
                            <div class="text-gray-700 font-medium">Active Users</div>
                        </div>
                        <div class="text-center p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-2xl">
                            <div class="text-4xl font-bold text-green-600 mb-2">200+</div>
                            <div class="text-gray-700 font-medium">Verified Drivers</div>
                        </div>
                        <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl">
                            <div class="text-4xl font-bold text-purple-600 mb-2">200+</div>
                            <div class="text-gray-700 font-medium">Completed Rides</div>
                        </div>
                        <div class="text-center p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl">
                            <div class="text-4xl font-bold text-yellow-600 mb-2">4.8★</div>
                            <div class="text-gray-700 font-medium">Platform Rating</div>
                        </div>
                    </div>
                </div>
                
                <div class="slide-in-right">
                    <div class="relative">
                        <!-- Main Image Container -->
                        <div class="relative gradient-primary rounded-3xl p-8 shadow-2xl">
                            <div class="text-center text-white mb-8">
                                <div class="w-24 h-24 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mx-auto mb-4">
                                    <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="w-12 h-12 rounded-lg">
                                </div>
                                <h3 class="text-2xl font-bold mb-2">Raah-e-Haq</h3>
                                <p class="text-blue-100">Your Trusted Journey Partner</p>
                            </div>
                            
                            <!-- Feature Cards -->
                            <div class="space-y-4">
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 flex items-center">
                                    <div class="w-10 h-10 bg-white bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-white font-semibold">Real-time GPS tracking</div>
                                        <div class="text-blue-100 text-sm">Live location updates</div>
                                    </div>
                                </div>
                                
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 flex items-center">
                                    <div class="w-10 h-10 bg-white bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-shield-alt text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-white font-semibold">Secure payment processing</div>
                                        <div class="text-blue-100 text-sm">Multiple payment options</div>
                                    </div>
                                </div>
                                
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 flex items-center">
                                    <div class="w-10 h-10 bg-white bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-headset text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-white font-semibold">24/7 customer support</div>
                                        <div class="text-blue-100 text-sm">Always here to help</div>
                                    </div>
                                </div>
                                
                                <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4 flex items-center">
                                    <div class="w-10 h-10 bg-white bg-opacity-30 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-lock text-white"></i>
                                    </div>
                                    <div>
                                        <div class="text-white font-semibold">Advanced authentication</div>
                                        <div class="text-blue-100 text-sm">OTP & email security</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Elements -->
                        <div class="absolute -top-6 -right-6 w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-star text-white"></i>
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-16 h-16 bg-green-400 rounded-full flex items-center justify-center shadow-lg">
                            <i class="fas fa-heart text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-br from-blue-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-6 py-3 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-quote-left mr-2"></i>
                    What Our Users Say
                </div>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">
                    Trusted by
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Thousands</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Don't just take our word for it - hear from our satisfied customers
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 relative">
                    <div class="absolute -top-4 left-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Ahmed Ali</h4>
                                <p class="text-gray-600 text-sm">Karachi, Pakistan</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">
                            "The admin panel is incredibly comprehensive. The analytics dashboard gives me real-time insights into our operations, and the security features give me complete peace of mind for our business."
                        </p>
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 relative">
                    <div class="absolute -top-4 left-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Fatima Khan</h4>
                                <p class="text-gray-600 text-sm">Lahore, Pakistan</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">
                            "The driver tracking system is exceptional. We can monitor all our drivers in real-time, and the comprehensive reporting helps us optimize our operations and improve service quality."
                        </p>
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 relative">
                    <div class="absolute -top-4 left-8">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-quote-left text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-user text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Muhammad Hassan</h4>
                                <p class="text-gray-600 text-sm">Islamabad, Pakistan</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">
                            "The support ticket system is incredibly efficient. We can track and resolve customer issues quickly, and the analytics help us identify patterns to improve our service delivery."
                        </p>
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-gradient-to-br from-gray-50 to-blue-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,<svg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23000000" fill-opacity="0.1"><circle cx="40" cy="40" r="3"/></g></svg>');"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 px-6 py-3 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-envelope mr-2"></i>
                    Get In Touch
                </div>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6">
                    Ready to Start Your
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Journey?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Contact Information</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Address</h4>
                                <p class="text-gray-600">DHA Phase 2, Karachi, Pakistan</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Phone</h4>
                                <p class="text-gray-600">+92 21 1234567</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-purple-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Email</h4>
                                <p class="text-gray-600">info@raah-e-haq.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h4 class="font-semibold text-gray-900 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-blue-800 text-white rounded-full flex items-center justify-center hover:bg-blue-900 transition-colors">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div>
                    <form id="contact-form" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Your name" required>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="your@email.com" required>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Subject" required>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Your message" required></textarea>
                        </div>
                        
                        <button type="submit" id="submit-btn" class="w-full btn-primary text-white py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity">
                            <i class="fas fa-paper-plane mr-2"></i>
                            <span class="btn-text">Send Message</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-blue-900 to-purple-900 text-white py-16 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.1"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center mr-4">
                            <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="w-8 h-8 rounded-lg">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">Raah-e-Haq</h3>
                            <p class="text-blue-200 text-sm">Your Trusted Journey</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        A comprehensive ride-hailing platform with advanced admin controls, real-time analytics, and enterprise-grade security. Built for modern transportation businesses with professional management tools.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-all">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Platform Features</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Admin Dashboard</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Analytics & Reports</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Driver Tracking</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Security Management</a></li>
                        </ul>
                    </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-300">
                        © 2025 Raah-e-Haq. All rights reserved. Made with <i class="fas fa-heart text-red-500"></i> for better transportation in Pakistan.
                    </p>
                    <div class="flex items-center space-x-6 text-sm text-gray-400">
                        <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.add('hidden');
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navigation
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Ensure navbar is always visible on page load
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.getElementById('navbar');
            nav.classList.add('navbar-fixed');
        });

        // Form submission
        document.getElementById('contact-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submit-btn');
            const btnText = document.querySelector('.btn-text');
            const formData = new FormData(this);
            
            // Show loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Sending...';
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span class="btn-text">Sending...</span>';
            
            fetch('{{ route("contact") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    btnText.textContent = 'Message Sent!';
                    submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i><span class="btn-text">Message Sent!</span>';
                    submitBtn.classList.remove('btn-primary');
                    submitBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                    
                    // Reset form
                    document.getElementById('contact-form').reset();
                    
                    // Reset button after 3 seconds
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        btnText.textContent = 'Send Message';
                        submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i><span class="btn-text">Send Message</span>';
                        submitBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
                        submitBtn.classList.add('btn-primary');
                    }, 3000);
                } else {
                    // Show error message
                    alert(data.message || 'Sorry, there was an error sending your message. Please try again.');
                    submitBtn.disabled = false;
                    btnText.textContent = 'Send Message';
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i><span class="btn-text">Send Message</span>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Sorry, there was an error sending your message. Please try again.');
                submitBtn.disabled = false;
                btnText.textContent = 'Send Message';
                submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i><span class="btn-text">Send Message</span>';
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.card-hover, .slide-in-left, .slide-in-right').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>
