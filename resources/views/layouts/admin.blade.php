<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Raah-e-Haq') }} - Admin Panel</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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

        /* Minimal Professional Animations */
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Professional Hover Effects */
        .card-hover {
            transition: all 0.2s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(1, 28, 114, 0.1);
        }
        
        .nav-hover {
            transition: all 0.2s ease;
        }
        .nav-hover:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
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
        
        /* Professional Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 256px;
            background: linear-gradient(180deg, var(--primary) 0%, #1a237e 100%);
            box-shadow: 2px 0 10px rgba(1, 28, 114, 0.1);
            overflow-y: auto;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        
        /* Professional Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(1, 28, 114, 0.1);
        }
        
        /* Brand Color Overrides */
        .bg-primary, .bg-blue-600 { background-color: var(--primary) !important; }
        .bg-secondary, .bg-orange-500 { background-color: var(--secondary) !important; }
        .bg-gold, .bg-yellow-500 { background-color: var(--gold) !important; }
        .bg-success, .bg-green-600 { background-color: var(--success) !important; }
        .bg-warning, .bg-red-600 { background-color: var(--warning) !important; }
        
        .text-primary, .text-blue-600 { color: var(--primary) !important; }
        .text-secondary, .text-orange-500 { color: var(--secondary) !important; }
        .text-gold, .text-yellow-600 { color: var(--gold) !important; }
        .text-success, .text-green-600 { color: var(--success) !important; }
        .text-warning, .text-red-600 { color: var(--warning) !important; }
        
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
        
        /* Logout Button Styling */
        .logout-btn {
            transition: all 0.2s ease;
            padding: 8px 12px;
            border-radius: 8px;
        }
        .logout-btn:hover {
            background-color: rgba(206, 10, 10, 0.1);
            color: var(--warning);
        }
        
        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--warning);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* User Profile Dropdown */
        .user-profile {
            position: relative;
        }
        
        .user-dropdown {
            position: fixed !important;
            top: 70px !important;
            right: 20px !important;
            background: white !important;
            border-radius: 12px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
            min-width: 220px !important;
            z-index: 2147483647 !important;
            display: none !important;
            border: 1px solid #e5e7eb !important;
            overflow: hidden !important;
            transform: translateZ(0) !important;
            will-change: transform !important;
        }
        
        .user-dropdown.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: fixed !important;
            z-index: 2147483647 !important;
            animation: dropdownFadeIn 0.2s ease-out !important;
            top: 70px !important;
            right: 20px !important;
        }
        
        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .user-dropdown-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f3f4f6;
            transition: background-color 0.2s ease;
            cursor: pointer;
        }
        
        .user-dropdown-item:hover {
            background-color: #f9fafb;
        }
        
        .user-dropdown-item:last-child {
            border-bottom: none;
        }
        
        .user-dropdown-header {
            padding: 16px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }
        
        /* Ensure dropdown is always on top */
        .user-dropdown {
            transform: translateZ(0);
            will-change: transform;
            z-index: 999999 !important;
        }
        
        /* Override any potential z-index conflicts */
        .user-dropdown * {
            position: relative;
            z-index: inherit;
        }
        
        /* Force dropdown to be above everything */
        .user-dropdown.show {
            z-index: 999999 !important;
            position: fixed !important;
            top: 70px !important;
            right: 20px !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        /* Ensure no other elements can hide the dropdown */
        .user-dropdown {
            isolation: isolate !important;
            contain: layout style paint !important;
            z-index: 2147483647 !important;
            position: fixed !important;
        }
        
        /* Force dropdown to be above everything - most aggressive approach */
        .user-dropdown.show {
            z-index: 2147483647 !important;
            position: fixed !important;
            top: 70px !important;
            right: 20px !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            transform: translateZ(0) !important;
            will-change: transform !important;
        }
        
        /* Override any potential conflicts */
        body .user-dropdown {
            z-index: 2147483647 !important;
        }
        
        html .user-dropdown {
            z-index: 2147483647 !important;
        }
        
        /* Nuclear option - ensure dropdown is always visible */
        .user-dropdown.show {
            all: unset !important;
            position: fixed !important;
            top: 70px !important;
            right: 20px !important;
            background: white !important;
            border-radius: 12px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25) !important;
            min-width: 220px !important;
            z-index: 2147483647 !important;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            border: 1px solid #e5e7eb !important;
            overflow: hidden !important;
            transform: translateZ(0) !important;
            will-change: transform !important;
        }
        
        /* Sidebar Logout Button */
        .sidebar-logout {
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            z-index: 10;
        }
        
        .sidebar-logout:hover {
            background-color: rgba(220, 38, 38, 0.9) !important;
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }
        
        .sidebar-logout:active {
            transform: translateX(2px);
        }
        
        .sidebar-logout:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100">
    <div class="min-h-screen flex">
        <!-- Professional Sidebar -->
        <div id="sidebar" class="w-64 sidebar">
            <div class="p-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center">
                        <img src="{{ asset('logo.jpeg') }}" alt="Raah-e-Haq Logo" class="w-8 h-8 rounded-lg">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Raah-e-Haq</h1>
                        <p class="text-sm text-blue-200">Admin Panel</p>
                    </div>
                </div>
            </div>
            
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                        <a href="{{ route('admin.users.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.users.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-users w-5"></i>
                            <span class="font-medium">User Management</span>
                        </a>
                        
                        <a href="{{ route('admin.driver-verification.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.driver-verification.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-id-card w-5"></i>
                            <span class="font-medium">Driver Verification</span>
                        </a>
                        
                        <a href="{{ route('admin.rides.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.rides.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-car w-5"></i>
                            <span class="font-medium">Ride Management</span>
                        </a>
                        
                        <a href="{{ route('admin.payments.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.payments.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-credit-card w-5"></i>
                            <span class="font-medium">Payment Management</span>
                        </a>
                        
                        <a href="{{ route('admin.settings.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.settings.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-cog w-5"></i>
                            <span class="font-medium">App Settings</span>
                        </a>
                        
                        <a href="{{ route('admin.security.dashboard') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.security.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-shield-alt w-5"></i>
                            <span class="font-medium">Security & Audit</span>
                        </a>
                        
                        <a href="{{ route('admin.analytics.dashboard') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.analytics.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-chart-line w-5"></i>
                            <span class="font-medium">Analytics & Reports</span>
                        </a>
                        
                        <a href="{{ route('admin.driver-tracking.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.driver-tracking.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-map-marker-alt w-5"></i>
                            <span class="font-medium">Driver Tracking</span>
                        </a>
                        
                        <a href="{{ route('admin.referrals.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.referrals.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-users-cog w-5"></i>
                            <span class="font-medium">Referral System</span>
                        </a>
                        
                        <a href="{{ route('admin.support-tickets.index') }}" class="nav-hover flex items-center space-x-3 px-4 py-3 text-white rounded-xl {{ request()->routeIs('admin.support-tickets.*') ? 'bg-white bg-opacity-20 text-white shadow-lg' : 'text-blue-100' }}">
                            <i class="fas fa-headset w-5"></i>
                            <span class="font-medium">Support Tickets</span>
                        </a>
                </div>
            </nav>
            
            <!-- Logout Section -->
            <div class="mt-auto px-4 pb-6">
                <div class="border-t border-blue-300 pt-4">
                    <form method="POST" action="{{ route('logout') }}" id="sidebar-logout-form">
                        @csrf
                        <button type="submit" id="sidebar-logout-btn" class="sidebar-logout nav-hover w-full flex items-center space-x-3 px-4 py-3 text-white rounded-xl text-blue-100 hover:bg-red-500 hover:text-white transition-all duration-200">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="font-medium">Sign Out</span>
                        </button>
                    </form>
                </div>
            </div>
            
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col ml-64">
            <!-- Professional Header -->
            <header class="header">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button id="sidebar-toggle" class="text-primary hover:text-secondary focus:outline-none transition-colors duration-200">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-2xl font-bold text-primary">@yield('title', 'Dashboard')</h2>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-primary hover:text-secondary focus:outline-none transition-colors duration-200 relative">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="notification-badge">3</span>
                            </button>
                        </div>
                        
                        <!-- User Profile Dropdown -->
                        <div class="user-profile">
                            <button id="user-menu-toggle" class="flex items-center space-x-3 bg-white rounded-lg px-4 py-2 shadow-sm border border-gray-200 hover:shadow-md transition-all duration-200">
                                <div class="w-8 h-8 gradient-primary rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                                <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold text-primary">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->roles->first()->display_name ?? 'Administrator' }}</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="user-dropdown" class="user-dropdown">
                                <div class="user-dropdown-header">
                                    <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                
                                <a href="{{ route('profile.show') }}" class="user-dropdown-item flex items-center space-x-3">
                                    <i class="fas fa-user text-gray-400 w-4"></i>
                                    <span class="text-gray-700">View Profile</span>
                                </a>
                                
                                <a href="{{ route('profile.edit') }}" class="user-dropdown-item flex items-center space-x-3">
                                    <i class="fas fa-edit text-gray-400 w-4"></i>
                                    <span class="text-gray-700">Edit Profile</span>
                                </a>
                                
                                <a href="#" class="user-dropdown-item flex items-center space-x-3">
                                    <i class="fas fa-cog text-gray-400 w-4"></i>
                                    <span class="text-gray-700">Preferences</span>
                                </a>
                                
                                <a href="#" class="user-dropdown-item flex items-center space-x-3">
                                    <i class="fas fa-bell text-gray-400 w-4"></i>
                                    <span class="text-gray-700">Notifications</span>
                                </a>
                                
                                <div class="border-t border-gray-200"></div>
                                
                                <form method="POST" action="{{ route('logout') }}" class="user-dropdown-item">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center space-x-3 text-red-600 hover:text-red-700">
                                        <i class="fas fa-sign-out-alt w-4"></i>
                                        <span>Sign Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 bg-gray-50">
                @if(session('success'))
                    <div class="mb-6 bg-white rounded-lg px-6 py-4 border-l-4 border-green-500 shadow-sm">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-white rounded-lg px-6 py-4 border-l-4 border-red-500 shadow-sm">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-exclamation text-white text-sm"></i>
                            </div>
                            <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="fade-in">
                    @yield('content')
                </div>
            </main>

            {{-- Page-specific scripts injected from child views --}}
            @stack('scripts')
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.flex-1.flex.flex-col');
            
            sidebar.classList.toggle('-ml-64');
            mainContent.classList.toggle('ml-0');
        });

        // User dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuToggle = document.getElementById('user-menu-toggle');
            const userDropdown = document.getElementById('user-dropdown');
            
            if (userMenuToggle && userDropdown) {
                userMenuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Position dropdown relative to button
                    const rect = userMenuToggle.getBoundingClientRect();
                    userDropdown.style.top = (rect.bottom + 8) + 'px';
                    userDropdown.style.right = (window.innerWidth - rect.right) + 'px';
                    userDropdown.style.zIndex = '2147483647';
                    userDropdown.style.position = 'fixed';
                    userDropdown.style.display = 'block';
                    userDropdown.style.visibility = 'visible';
                    userDropdown.style.opacity = '1';
                    userDropdown.style.transform = 'translateZ(0)';
                    userDropdown.style.willChange = 'transform';
                    
                    // Force all styles to be applied
                    userDropdown.setAttribute('style', userDropdown.getAttribute('style') + '; z-index: 2147483647 !important; position: fixed !important; display: block !important; visibility: visible !important; opacity: 1 !important;');
                    
                    // Move dropdown to body to avoid z-index issues
                    if (userDropdown.parentElement !== document.body) {
                        document.body.appendChild(userDropdown);
                    }
                    
                    userDropdown.classList.toggle('show');
                    
                    // Debug: Check if dropdown is visible
                    setTimeout(() => {
                        const computedStyle = window.getComputedStyle(userDropdown);
                        console.log('Dropdown z-index:', computedStyle.zIndex);
                        console.log('Dropdown position:', computedStyle.position);
                        console.log('Dropdown display:', computedStyle.display);
                        console.log('Dropdown visibility:', computedStyle.visibility);
                        console.log('Dropdown opacity:', computedStyle.opacity);
                        console.log('Dropdown parent:', userDropdown.parentElement);
                    }, 100);
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                        userDropdown.classList.remove('show');
                    }
                });
                
                // Prevent dropdown from closing when clicking inside it
                userDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Close dropdown when pressing Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        userDropdown.classList.remove('show');
                    }
                });
                
                // Close dropdown on window resize
                window.addEventListener('resize', function() {
                    userDropdown.classList.remove('show');
                });
            }
        });

        // Sidebar logout functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLogoutBtn = document.getElementById('sidebar-logout-btn');
            const sidebarLogoutForm = document.getElementById('sidebar-logout-form');
            
            if (sidebarLogoutBtn && sidebarLogoutForm) {
                sidebarLogoutBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Show loading state
                    this.disabled = true;
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing Out...';
                    
                    // Add a small delay to show the loading state
                    setTimeout(() => {
                        // Submit the form
                        sidebarLogoutForm.submit();
                    }, 100);
                });
            }
        });

        // Add loading states to other buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('button[type="submit"]:not(#sidebar-logout-btn)');
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    if (this.form && this.form.checkValidity()) {
                        this.disabled = true;
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                        
                        // Re-enable after 3 seconds as fallback
                        setTimeout(() => {
                            this.disabled = false;
                            this.innerHTML = originalText;
                        }, 3000);
                    }
                });
            });
        });

        /* Toast Notification System */
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
</body>
</html>
