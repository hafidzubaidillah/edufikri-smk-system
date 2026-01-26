<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --admin-primary: #dc3545;
            --admin-secondary: #6c757d;
            --admin-success: #198754;
            --admin-info: #0dcaf0;
            --admin-warning: #ffc107;
            --admin-danger: #dc3545;
            --admin-dark: #212529;
            --admin-light: #f8f9fa;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f5f5f5;
        }

        .admin-sidebar {
            background: linear-gradient(135deg, var(--admin-danger) 0%, #b02a37 100%);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .admin-sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 2px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }

        .admin-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid var(--admin-danger);
        }

        .admin-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .admin-card:hover {
            transform: translateY(-5px);
        }

        .admin-btn-primary {
            background: linear-gradient(135deg, var(--admin-danger) 0%, #b02a37 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }

        .admin-stats-card {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            color: white;
            border-radius: 15px;
        }

        .admin-logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="admin-sidebar" style="width: 280px;">
            <div class="p-4">
                <div class="admin-logo mb-4 d-flex align-items-center">
                    <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMK IT Ihsanul Fikri" 
                         style="width: 40px; height: 40px; object-fit: contain;" class="me-2">
                    <div>
                        <div style="font-size: 1.2rem; font-weight: bold; line-height: 1.2;">EDUFIKRI</div>
                        <small style="font-size: 0.75rem; opacity: 0.8;">Admin Panel</small>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="text-center mb-4 p-3" style="background: rgba(255,255,255,0.1); border-radius: 10px;">
                    <div class="mb-2">
                        <i class="fas fa-user-shield fa-2x text-white"></i>
                    </div>
                    <h6 class="text-white mb-1">{{ Auth::user()->name }}</h6>
                    <small class="text-white-50">Administrator</small>
                </div>

                <!-- Navigation -->
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}" href="{{ route('admin.classes.index') }}">
                        <i class="fas fa-chalkboard me-2"></i>Manajemen Kelas
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.learners.*') ? 'active' : '' }}" href="{{ route('admin.learners.index') }}">
                        <i class="fas fa-users me-2"></i>Data Siswa
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}" href="{{ route('admin.teachers.index') }}">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Data Guru
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}" href="{{ route('admin.subjects.index') }}">
                        <i class="fas fa-book me-2"></i>Mata Pelajaran
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.majors.*') ? 'active' : '' }}" href="{{ route('admin.majors.index') }}">
                        <i class="fas fa-graduation-cap me-2"></i>Jurusan
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}" href="{{ route('admin.attendance.index') }}">
                        <i class="fas fa-calendar-check me-2"></i>Absensi
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">
                        <i class="fas fa-bullhorn me-2"></i>Pengumuman
                    </a>
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="fas fa-user-cog me-2"></i>Manajemen User
                    </a>
                    <a class="nav-link {{ request()->routeIs('email.*') ? 'active' : '' }}" href="{{ route('email.logs') }}">
                        <i class="fas fa-envelope me-2"></i>Log Email
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.social-media.*') ? 'active' : '' }}" href="{{ route('admin.social-media.index') }}">
                        <i class="fas fa-share-alt me-2"></i>Sosial Media
                    </a>
                    <a class="nav-link {{ request()->routeIs('admin.users.passwords') ? 'active' : '' }}" href="{{ route('admin.users.passwords') }}">
                        <i class="fas fa-key me-2"></i>Kelola Password
                    </a>
                    
                    <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
                    
                    <a class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
                        <i class="fas fa-user-edit me-2"></i>Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Header -->
            <header class="admin-header p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-dark">
                        <i class="fas fa-shield-alt text-danger me-2"></i>
                        Panel Administrator
                    </h4>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-danger me-3">
                            <i class="fas fa-crown me-1"></i>ADMIN
                        </span>
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                    <i class="fas fa-user-edit me-2"></i>Profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>