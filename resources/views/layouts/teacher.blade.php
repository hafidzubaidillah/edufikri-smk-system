<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Teacher Portal</title>

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
            --teacher-primary: #28a745;
            --teacher-secondary: #6c757d;
            --teacher-success: #20c997;
            --teacher-info: #17a2b8;
            --teacher-warning: #ffc107;
            --teacher-danger: #dc3545;
            --teacher-dark: #343a40;
            --teacher-light: #f8f9fa;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            min-height: 100vh;
        }

        .teacher-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .teacher-sidebar {
            width: 280px;
            background: linear-gradient(135deg, var(--teacher-primary) 0%, #1e7e34 100%);
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }

        .teacher-sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 15px 20px;
            margin: 3px 15px;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .teacher-sidebar .nav-link:hover,
        .teacher-sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(8px);
        }

        .teacher-main {
            flex: 1;
            background: white;
            margin: 15px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .teacher-header {
            background: linear-gradient(135deg, var(--teacher-primary) 0%, #20c997 100%);
            color: white;
            padding: 25px;
        }

        .teacher-content {
            padding: 30px;
        }

        .teacher-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid var(--teacher-primary);
        }

        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
        }

        .teacher-btn-primary {
            background: linear-gradient(135deg, var(--teacher-primary) 0%, #20c997 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .teacher-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(40,167,69,0.3);
        }

        .teacher-stats-card {
            background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
            color: white;
            border-radius: 15px;
        }

        .teacher-profile-section {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .teacher-logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .teacher-user-info {
            text-align: center;
            padding: 20px;
            background: rgba(255,255,255,0.1);
            margin: 15px;
            border-radius: 15px;
        }

        .teacher-nav-section {
            padding: 20px 0;
        }

        .teacher-nav-title {
            color: rgba(255,255,255,0.6);
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
            padding: 0 20px;
            margin-bottom: 10px;
        }

        .teacher-badge {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="teacher-wrapper">
        <!-- Sidebar -->
        <div class="teacher-sidebar">
            <div class="teacher-logo d-flex align-items-center">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMK IT Ihsanul Fikri" 
                     style="width: 45px; height: 45px; object-fit: contain;" class="me-2">
                <div>
                    <div style="font-size: 1.4rem; font-weight: bold; line-height: 1.2;">EDUFIKRI</div>
                    <small style="font-size: 0.8rem; opacity: 0.9;">Teacher Portal</small>
                </div>
            </div>
            
            <!-- User Info -->
            <div class="teacher-user-info">
                <div class="mb-3">
                    <i class="fas fa-user-tie fa-3x text-white"></i>
                </div>
                <h6 class="text-white mb-1">{{ Auth::user()->name }}</h6>
                <div class="teacher-badge">Guru/Pengajar</div>
            </div>

            <!-- Navigation -->
            <div class="teacher-nav-section">
                <div class="teacher-nav-title">Menu Utama</div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}" href="{{ route('employee.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a class="nav-link {{ request()->routeIs('teacher.classes.*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-chalkboard me-2"></i>Kelas Saya
                    </a>
                    <a class="nav-link {{ request()->routeIs('teacher.students.*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-users me-2"></i>Data Siswa
                    </a>
                    <a class="nav-link {{ request()->routeIs('teacher.attendance.*') ? 'active' : '' }}" href="{{ route('admin.attendance.index') }}">
                        <i class="fas fa-calendar-check me-2"></i>Absensi
                    </a>
                    <a class="nav-link {{ request()->routeIs('teacher.grades.*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-clipboard-list me-2"></i>Input Nilai
                    </a>
                </nav>
                
                <div class="teacher-nav-title mt-4">Komunikasi</div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('teacher.announcements') ? 'active' : '' }}" href="{{ route('teacher.announcements') }}">
                        <i class="fas fa-bullhorn me-2"></i>Pengumuman
                    </a>
                    <a class="nav-link {{ request()->routeIs('teacher.messages.*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-envelope me-2"></i>Pesan
                    </a>
                </nav>
                
                <div class="teacher-nav-title mt-4">Pengaturan</div>
                <nav class="nav flex-column">
                    <a class="nav-link {{ request()->routeIs('teacher.profile.*') ? 'active' : '' }}" href="{{ route('teacher.profile.edit') }}">
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
        <div class="teacher-main">
            <!-- Header -->
            <div class="teacher-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1">
                            <i class="fas fa-chalkboard-teacher me-2"></i>
                            Portal Guru
                        </h3>
                        <p class="mb-0 opacity-75">Kelola pembelajaran dengan mudah</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="teacher-badge me-3">
                            <i class="fas fa-graduation-cap me-1"></i>GURU
                        </span>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('teacher.profile.edit') }}">
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
            </div>

            <!-- Page Content -->
            <div class="teacher-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>