<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EDUFIKRI') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(135deg, #5a67d8, #6b46c1); }
        
        /* Sidebar Animation */
        .sidebar-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Glass Effect */
        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Hover Effects */
        .nav-item:hover {
            transform: translateX(4px);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .nav-item {
            transition: all 0.3s ease;
        }
        
        /* Notification Badge */
        .notification-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Mobile Menu Animation */
        .mobile-menu-enter {
            animation: slideInRight 0.3s ease-out;
        }
        
        @keyframes slideInRight {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-transition w-64 bg-white shadow-xl border-r border-gray-200 fixed inset-y-0 left-0 z-50 lg:relative lg:translate-x-0 transform -translate-x-full">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between h-16 px-6 bg-gradient-to-r from-blue-600 to-purple-600">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-blue-600"></i>
                    </div>
                    <span class="text-xl font-bold text-white font-poppins">EDUFIKRI</span>
                </div>
                <button onclick="toggleSidebar()" class="lg:hidden text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <!-- User Profile -->
            @auth
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 truncate">
                            {{ auth()->user()->email }}
                        </p>
                        <div class="flex items-center mt-1">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-circle text-green-400 text-xs mr-1"></i>
                                Online
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
            
            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white' : '' }}">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <!-- My Courses -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-book-open w-5 h-5 mr-3"></i>
                    <span class="font-medium">Kursus Saya</span>
                    <span class="ml-auto bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">3</span>
                </a>
                
                <!-- Browse Courses -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-search w-5 h-5 mr-3"></i>
                    <span class="font-medium">Jelajahi Kursus</span>
                </a>
                
                <!-- Progress -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                    <span class="font-medium">Progress</span>
                </a>
                
                <!-- Certificates -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-certificate w-5 h-5 mr-3"></i>
                    <span class="font-medium">Sertifikat</span>
                    <span class="ml-auto bg-yellow-100 text-yellow-800 text-xs font-semibold px-2 py-1 rounded-full">2</span>
                </a>
                
                <!-- Community -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-users w-5 h-5 mr-3"></i>
                    <span class="font-medium">Komunitas</span>
                    <span class="ml-auto notification-badge w-2 h-2 bg-red-500 rounded-full"></span>
                </a>
                
                <!-- Messages -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-envelope w-5 h-5 mr-3"></i>
                    <span class="font-medium">Pesan</span>
                    <span class="ml-auto bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">5</span>
                </a>
                
                <!-- Divider -->
                <div class="border-t border-gray-200 my-4"></div>
                
                <!-- Settings -->
                <a href="{{ route('profile.edit') }}" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-cog w-5 h-5 mr-3"></i>
                    <span class="font-medium">Pengaturan</span>
                </a>
                
                <!-- Help -->
                <a href="#" class="nav-item flex items-center px-4 py-3 text-gray-700 rounded-xl">
                    <i class="fas fa-question-circle w-5 h-5 mr-3"></i>
                    <span class="font-medium">Bantuan</span>
                </a>
            </nav>
            
            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-colors">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Top Navigation -->
            <header class="glass-nav sticky top-0 z-40 h-16 flex items-center justify-between px-6 shadow-sm">
                <!-- Mobile Menu Button -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Page Title -->
                @isset($header)
                    <div class="flex-1 lg:flex-none">
                        {{ $header }}
                    </div>
                @endisset
                
                <!-- Top Navigation Items -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="hidden md:block relative">
                        <input type="text" 
                               placeholder="Cari kursus, materi..." 
                               class="w-64 pl-10 pr-4 py-2 bg-gray-100 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    
                    <!-- Notifications -->
                    <div class="relative">
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>
                    </div>
                    
                    <!-- Messages -->
                    <div class="relative">
                        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors">
                            <i class="fas fa-envelope text-xl"></i>
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-blue-500 text-white text-xs rounded-full flex items-center justify-center">2</span>
                        </button>
                    </div>
                    
                    <!-- Profile Dropdown -->
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                            <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-1 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-1 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-user mr-3"></i>
                                Profil Saya
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-cog mr-3"></i>
                                Pengaturan
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-question-circle mr-3"></i>
                                Bantuan
                            </a>
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>
    
    <!-- Scripts -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarButton = event.target.closest('[onclick="toggleSidebar()"]');
            
            if (!sidebar.contains(event.target) && !sidebarButton && window.innerWidth < 1024) {
                sidebar.classList.add('-translate-x-full');
                document.getElementById('sidebarOverlay').classList.add('hidden');
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                document.getElementById('sidebar').classList.remove('-translate-x-full');
                document.getElementById('sidebarOverlay').classList.add('hidden');
            }
        });
    </script>
</body>
</html>
