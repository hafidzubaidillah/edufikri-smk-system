<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Student Portal</title>

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
            --student-primary: #007bff;
            --student-secondary: #6c757d;
            --student-success: #28a745;
            --student-info: #17a2b8;
            --student-warning: #ffc107;
            --student-danger: #dc3545;
            --student-dark: #343a40;
            --student-light: #f8f9fa;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .student-container {
            background: white;
            border-radius: 20px;
            margin: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .student-header {
            background: linear-gradient(135deg, var(--student-primary) 0%, #0056b3 100%);
            color: white;
            padding: 20px;
        }

        .student-nav {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #dee2e6;
        }

        .student-nav .nav-link {
            color: var(--student-dark);
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .student-nav .nav-link:hover,
        .student-nav .nav-link.active {
            background: linear-gradient(135deg, var(--student-primary) 0%, #0056b3 100%);
            color: white;
            transform: translateY(-2px);
        }

        .student-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .student-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .student-btn-primary {
            background: linear-gradient(135deg, var(--student-primary) 0%, #0056b3 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .student-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,123,255,0.3);
        }

        .student-stats-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border-radius: 20px;
        }

        .student-profile-card {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            border-radius: 20px;
            padding: 20px;
        }

        .student-menu-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .student-menu-card:hover {
            border-color: var(--student-primary);
            transform: translateY(-5px);
        }

        .student-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 2rem;
        }

        .mobile-nav {
            display: none;
        }

        @media (max-width: 768px) {
            .student-container {
                margin: 10px;
                border-radius: 15px;
            }
            
            .desktop-nav {
                display: none;
            }
            
            .mobile-nav {
                display: block;
                background: white;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                z-index: 1000;
                box-shadow: 0 -5px 15px rgba(0,0,0,0.1);
            }
            
            .mobile-nav .nav-link {
                text-align: center;
                padding: 10px 5px;
                font-size: 0.8rem;
            }
            
            .mobile-nav .nav-link i {
                display: block;
                font-size: 1.2rem;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="student-container">
        <!-- Header -->
        <div class="student-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-1 d-flex align-items-center">
                        <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo SMK IT Ihsanul Fikri" 
                             style="width: 35px; height: 35px; object-fit: contain;" class="me-2">
                        EDUFIKRI Student Portal
                    </h3>
                    <p class="mb-0 opacity-75">Selamat datang, {{ Auth::user()->name }}!</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('learner.profile.edit') }}">
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

        <!-- Navigation -->
        <div class="student-nav desktop-nav">
            <nav class="nav justify-content-center">
                <a class="nav-link {{ request()->routeIs('learner.dashboard') ? 'active' : '' }}" href="{{ route('learner.dashboard') }}">
                    <i class="fas fa-home me-1"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('learner.my-class') ? 'active' : '' }}" href="{{ route('learner.my-class') }}">
                    <i class="fas fa-chalkboard me-1"></i>Kelas Saya
                </a>
                <a class="nav-link {{ request()->routeIs('learner.materials*') ? 'active' : '' }}" href="{{ route('learner.materials') }}">
                    <i class="fas fa-book-open me-1"></i>Materi
                </a>
                <a class="nav-link {{ request()->routeIs('learner.courses') ? 'active' : '' }}" href="{{ route('learner.courses') }}">
                    <i class="fas fa-book me-1"></i>Kursus Saya
                </a>
                <a class="nav-link {{ request()->routeIs('learner.schedule') ? 'active' : '' }}" href="{{ route('learner.schedule') }}">
                    <i class="fas fa-calendar me-1"></i>Jadwal
                </a>
                <a class="nav-link {{ request()->routeIs('learner.messages') ? 'active' : '' }}" href="{{ route('learner.messages') }}">
                    <i class="fas fa-envelope me-1"></i>Pesan
                </a>
                <a class="nav-link {{ request()->routeIs('learner.profile.*') ? 'active' : '' }}" href="{{ route('learner.profile.edit') }}">
                    <i class="fas fa-user-edit me-1"></i>Profil
                </a>
            </nav>
        </div>

        <!-- Page Content -->
        <main class="p-4" style="min-height: 500px;">
            @yield('content')
        </main>
    </div>

    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <nav class="nav justify-content-around">
            <a class="nav-link {{ request()->routeIs('learner.dashboard') ? 'active' : '' }}" href="{{ route('learner.dashboard') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link {{ request()->routeIs('learner.my-class') ? 'active' : '' }}" href="{{ route('learner.my-class') }}">
                <i class="fas fa-chalkboard"></i>
                <span>Kelas</span>
            </a>
            <a class="nav-link {{ request()->routeIs('learner.materials*') ? 'active' : '' }}" href="{{ route('learner.materials') }}">
                <i class="fas fa-book-open"></i>
                <span>Materi</span>
            </a>
            <a class="nav-link {{ request()->routeIs('learner.schedule') ? 'active' : '' }}" href="{{ route('learner.schedule') }}">
                <i class="fas fa-calendar"></i>
                <span>Jadwal</span>
            </a>
            <a class="nav-link {{ request()->routeIs('learner.messages') ? 'active' : '' }}" href="{{ route('learner.messages') }}">
                <i class="fas fa-envelope"></i>
                <span>Pesan</span>
            </a>
            <a class="nav-link {{ request()->routeIs('learner.profile.*') ? 'active' : '' }}" href="{{ route('learner.profile.edit') }}">
                <i class="fas fa-user-edit"></i>
                <span>Profil</span>
            </a>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>