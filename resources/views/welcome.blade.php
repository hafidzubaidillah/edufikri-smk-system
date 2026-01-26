<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMK Islam Terpadu Ihsanul Fikri - Mungkid, Kabupaten Magelang</title>
    <meta name="description" content="Sekolah Menengah Kejuruan Islam Terpadu Ihsanul Fikri Mungkid - Membentuk generasi yang berakhlak mulia dan berkompetensi tinggi">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(255, 193, 7, 0.3); }
            50% { box-shadow: 0 0 40px rgba(255, 193, 7, 0.6); }
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        .animate-gradient { animation: gradient-shift 8s ease infinite; }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #1a5f1a, #2d4a2d, #ffc107, #ff8f00, #1a5f1a, #2d4a2d);
            background-size: 400% 400%;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #1a5f1a 0%, #ffc107 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { 
            background: linear-gradient(135deg, #1a5f1a, #ffc107);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(135deg, #155015, #e6ac00); }
        
        .school-colors {
            background: linear-gradient(135deg, #1a5f1a, #ffc107);
        }
    </style>
</head>
<body class="bg-gray-50 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <x-school-logo />
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#home" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Beranda</a>
                    <a href="/informasi-sekolah" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Tentang</a>
                    <a href="#programs" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Program Keahlian</a>
                    <a href="#facilities" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Fasilitas</a>
                    <a href="#news" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Berita</a>
                    <a href="#contact" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Kontak</a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="school-colors text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="school-colors text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Masuk
                        </a>
                    @endauth
                    
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden glass-effect border-t border-white/20">
            <div class="px-4 py-4 space-y-3">
                <a href="#home" class="block text-gray-700 hover:text-green-600 font-medium">Beranda</a>
                <a href="/informasi-sekolah" class="block text-gray-700 hover:text-green-600 font-medium">Tentang</a>
                <a href="#programs" class="block text-gray-700 hover:text-green-600 font-medium">Program Keahlian</a>
                <a href="#facilities" class="block text-gray-700 hover:text-green-600 font-medium">Fasilitas</a>
                <a href="#news" class="block text-gray-700 hover:text-green-600 font-medium">Berita</a>
                <a href="#contact" class="block text-gray-700 hover:text-green-600 font-medium">Kontak</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen gradient-bg animate-gradient flex items-center relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
            <div class="absolute top-40 right-20 w-32 h-32 bg-white/5 rounded-full animate-float" style="animation-delay: -2s;"></div>
            <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-white/10 rounded-full animate-float" style="animation-delay: -4s;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-4xl lg:text-6xl font-bold font-poppins leading-tight">
                            <span class="block text-yellow-300">SMK Islam Terpadu</span>
                            <span class="block">Ihsanul Fikri</span>
                            <span class="block text-2xl lg:text-3xl">Mungkid, Magelang</span>
                        </h1>
                        <p class="text-xl lg:text-2xl text-white/90 leading-relaxed">
                            Membentuk generasi yang berakhlak mulia, berkompetensi tinggi, 
                            dan siap menghadapi tantangan masa depan dengan nilai-nilai Islam.
                        </p>
                    </div>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}" class="bg-white text-gray-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 text-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk Sekarang
                        </a>
                        <a href="/informasi-sekolah" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transition-all duration-200 text-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">500+</div>
                            <div class="text-white/80">Siswa Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">5</div>
                            <div class="text-white/80">Program Keahlian</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-yellow-300">95%</div>
                            <div class="text-white/80">Kelulusan</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Content - School Logo/Image -->
                <div class="relative">
                    <div class="relative z-10">
                        <!-- Main School Card -->
                        <div class="glass-effect rounded-3xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                            <div class="bg-white rounded-2xl p-6 shadow-2xl">
                                <div class="text-center mb-6">
                                    <div class="w-24 h-24 school-colors rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-mosque text-white text-3xl"></i>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-lg">Sekolah Menengah Kejuruan</h3>
                                    <h2 class="font-bold text-green-600 text-xl">Islam Terpadu</h2>
                                    <h1 class="font-bold text-yellow-500 text-2xl">IHSANUL FIKRI</h1>
                                    <p class="text-gray-600 text-sm mt-2">Mungkid, Kabupaten Magelang</p>
                                </div>
                                <div class="space-y-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-green-600">A</div>
                                            <div class="text-gray-500 text-sm">Akreditasi</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-yellow-500">15+</div>
                                            <div class="text-gray-500 text-sm">Tahun Berdiri</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Floating Achievement Cards -->
                        <div class="absolute -top-4 -right-4 glass-effect rounded-2xl p-4 animate-float">
                            <div class="bg-yellow-400 rounded-xl p-3">
                                <i class="fas fa-star text-white text-xl"></i>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-4 -left-4 glass-effect rounded-2xl p-4 animate-float" style="animation-delay: -3s;">
                            <div class="bg-green-600 rounded-xl p-3">
                                <i class="fas fa-award text-white text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <i class="fas fa-chevron-down text-2xl"></i>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Tentang <span class="text-gradient">SMK IT Ihsanul Fikri</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Sekolah yang menggabungkan pendidikan kejuruan berkualitas dengan nilai-nilai Islam 
                    untuk membentuk lulusan yang kompeten dan berakhlak mulia.
                </p>
            </div>
            
            <!-- About Content -->
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h3 class="text-3xl font-bold text-gray-900">Visi & Misi</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-green-50 rounded-2xl p-6">
                            <h4 class="text-xl font-bold text-green-600 mb-3">
                                <i class="fas fa-eye mr-2"></i>Visi
                            </h4>
                            <p class="text-gray-700 leading-relaxed">
                                Menjadi SMK Islam terdepan yang menghasilkan lulusan beriman, bertaqwa, 
                                berakhlak mulia, dan berkompetensi tinggi di bidang teknologi.
                            </p>
                        </div>
                        
                        <div class="bg-yellow-50 rounded-2xl p-6">
                            <h4 class="text-xl font-bold text-yellow-600 mb-3">
                                <i class="fas fa-bullseye mr-2"></i>Misi
                            </h4>
                            <ul class="text-gray-700 space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-yellow-500 mt-1 mr-2"></i>
                                    Menyelenggarakan pendidikan kejuruan berbasis Islam
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-yellow-500 mt-1 mr-2"></i>
                                    Mengembangkan kompetensi siswa sesuai kebutuhan industri
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-yellow-500 mt-1 mr-2"></i>
                                    Membentuk karakter Islami yang kuat dan berakhlak mulia
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 text-center">
                            <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-green-600">500+</div>
                            <div class="text-gray-600">Total Siswa</div>
                        </div>
                        
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 text-center">
                            <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-yellow-600">50+</div>
                            <div class="text-gray-600">Tenaga Pengajar</div>
                        </div>
                        
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 text-center">
                            <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-building text-white text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-blue-600">20+</div>
                            <div class="text-gray-600">Ruang Kelas</div>
                        </div>
                        
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 text-center">
                            <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-trophy text-white text-2xl"></i>
                            </div>
                            <div class="text-3xl font-bold text-purple-600">A</div>
                            <div class="text-gray-600">Akreditasi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Program <span class="text-gradient">Keahlian</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pilihan program keahlian yang sesuai dengan kebutuhan industri dan 
                    perkembangan teknologi terkini.
                </p>
            </div>
            
            <!-- Programs Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Program 1 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 school-colors relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-400 text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">Populer</span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-laptop-code text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Teknik Komputer & Jaringan</h3>
                        <p class="text-gray-600 mb-4">
                            Mempelajari instalasi, konfigurasi, dan maintenance sistem komputer dan jaringan.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">3 Tahun</span>
                            <button class="school-colors text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Program 2 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 school-colors relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-green-400 text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">Baru</span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-mobile-alt text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pengembangan Perangkat Lunak dan Gim</h3>
                        <p class="text-gray-600 mb-4">
                            Mengembangkan aplikasi mobile, web, dan game dengan teknologi terkini.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">3 Tahun</span>
                            <button class="school-colors text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Program 3 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 school-colors relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-car text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Teknik Kendaraan Ringan</h3>
                        <p class="text-gray-600 mb-4">
                            Mempelajari perawatan dan perbaikan kendaraan bermotor roda empat.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">3 Tahun</span>
                            <button class="school-colors text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Program 4 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 school-colors relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-motorcycle text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Teknik Sepeda Motor</h3>
                        <p class="text-gray-600 mb-4">
                            Spesialisasi dalam perawatan dan perbaikan sepeda motor.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">3 Tahun</span>
                            <button class="school-colors text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Program 5 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 school-colors relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-calculator text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Akuntansi & Keuangan</h3>
                        <p class="text-gray-600 mb-4">
                            Mengelola keuangan dan akuntansi perusahaan dengan sistem modern.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">3 Tahun</span>
                            <button class="school-colors text-white px-4 py-2 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Fasilitas <span class="text-gradient">Sekolah</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Fasilitas lengkap dan modern untuk mendukung proses pembelajaran yang optimal.
                </p>
            </div>
            
            <!-- Facilities Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Facility 1 -->
                <div class="group bg-gradient-to-br from-green-50 to-emerald-100 rounded-3xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-desktop text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Lab Komputer</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Laboratorium komputer dengan perangkat terbaru untuk mendukung pembelajaran TJKT dan PPLG.
                    </p>
                </div>
                
                <!-- Facility 2 -->
                <div class="group bg-gradient-to-br from-yellow-50 to-orange-100 rounded-3xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-tools text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Workshop Otomotif</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Bengkel lengkap dengan peralatan modern untuk praktik teknik kendaraan ringan dan sepeda motor.
                    </p>
                </div>
                
                <!-- Facility 3 -->
                <div class="group bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-mosque text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Masjid Sekolah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Masjid yang nyaman untuk kegiatan ibadah dan pembinaan spiritual siswa.
                    </p>
                </div>
                
                <!-- Facility 4 -->
                <div class="group bg-gradient-to-br from-purple-50 to-pink-100 rounded-3xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Perpustakaan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Perpustakaan dengan koleksi buku lengkap dan akses internet untuk mendukung pembelajaran.
                    </p>
                </div>
                
                <!-- Facility 5 -->
                <div class="group bg-gradient-to-br from-red-50 to-rose-100 rounded-3xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-futbol text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Lapangan Olahraga</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Lapangan olahraga untuk kegiatan fisik dan pengembangan bakat siswa di bidang olahraga.
                    </p>
                </div>
                
                <!-- Facility 6 -->
                <div class="group bg-gradient-to-br from-teal-50 to-cyan-100 rounded-3xl p-8 hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="w-16 h-16 school-colors rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-utensils text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kantin Sekolah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Kantin dengan makanan halal dan bergizi untuk memenuhi kebutuhan siswa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="news" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Berita & <span class="text-gradient">Kegiatan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Informasi terkini tentang kegiatan dan prestasi SMK IT Ihsanul Fikri.
                </p>
            </div>
            
            <!-- News Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- News 1 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 bg-gradient-to-r from-green-500 to-emerald-600 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">Prestasi</span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-trophy text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-500 text-sm mb-2">15 Januari 2026</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Juara 1 Lomba Programming</h3>
                        <p class="text-gray-600 mb-4">
                            Siswa SMK IT Ihsanul Fikri meraih juara 1 dalam lomba programming tingkat kabupaten.
                        </p>
                        <a href="#" class="text-green-600 font-semibold hover:text-green-700">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <!-- News 2 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 bg-gradient-to-r from-yellow-500 to-orange-600 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">Kegiatan</span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-graduation-cap text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-500 text-sm mb-2">10 Januari 2026</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Wisuda Angkatan 2025</h3>
                        <p class="text-gray-600 mb-4">
                            Upacara wisuda siswa angkatan 2025 dengan tingkat kelulusan 98%.
                        </p>
                        <a href="#" class="text-yellow-600 font-semibold hover:text-yellow-700">Baca Selengkapnya →</a>
                    </div>
                </div>
                
                <!-- News 3 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 relative">
                        <div class="absolute inset-0 bg-black/20"></div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-white text-gray-900 px-3 py-1 rounded-full text-sm font-semibold">Pengumuman</span>
                        </div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <i class="fas fa-bullhorn text-4xl"></i>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-500 text-sm mb-2">5 Januari 2026</div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pendaftaran Siswa Baru</h3>
                        <p class="text-gray-600 mb-4">
                            Pendaftaran siswa baru tahun ajaran 2026/2027 telah dibuka.
                        </p>
                        <a href="#" class="text-blue-600 font-semibold hover:text-blue-700">Baca Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg animate-gradient relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white/5 rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-10 w-24 h-24 bg-white/10 rounded-full animate-float" style="animation-delay: -2s;"></div>
        </div>
        
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-10">
            <h2 class="text-4xl lg:text-6xl font-bold font-poppins text-white mb-6">
                Bergabunglah Dengan Kami
            </h2>
            <p class="text-xl lg:text-2xl text-white/90 mb-8 leading-relaxed">
                Wujudkan cita-cita Anda bersama SMK IT Ihsanul Fikri. 
                Dapatkan pendidikan berkualitas dengan nilai-nilai Islam yang kuat.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="bg-white text-gray-900 px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk Sekarang
                </a>
                <a href="#contact" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-gray-900 transition-all duration-200">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- School Info -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 school-colors rounded-xl flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <div>
                            <span class="text-xl font-bold font-poppins">SMK IT Ihsanul Fikri</span>
                            <div class="text-sm text-gray-400">Mungkid, Magelang</div>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        Sekolah Menengah Kejuruan Islam Terpadu yang menghasilkan lulusan 
                        beriman, bertaqwa, dan berkompetensi tinggi.
                    </p>
                    <div class="flex space-x-4">
                        @if(config('social.facebook'))
                        <a href="{{ config('social.facebook') }}" target="_blank" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif
                        <a href="{{ config('social.instagram') }}" target="_blank" class="w-10 h-10 bg-pink-600 rounded-full flex items-center justify-center hover:bg-pink-700 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ config('social.youtube') }}" target="_blank" class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="{{ config('social.whatsapp') }}" target="_blank" class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Menu Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">Tentang</a></li>
                        <li><a href="#programs" class="text-gray-400 hover:text-white transition-colors">Program Keahlian</a></li>
                        <li><a href="#facilities" class="text-gray-400 hover:text-white transition-colors">Fasilitas</a></li>
                        <li><a href="#news" class="text-gray-400 hover:text-white transition-colors">Berita</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Portal Siswa</a></li>
                    </ul>
                </div>
                
                <!-- Programs -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Program Keahlian</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Teknik Jaringan Komputer dan Telekomunikasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Pengembangan Perangkat Lunak dan Gim</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Teknik Kendaraan Ringan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Teknik Sepeda Motor</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Akuntansi & Keuangan</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-6">Kontak Kami</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-yellow-400"></i>
                            <span class="text-gray-400">Jl. Raya Mungkid, Magelang, Jawa Tengah</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-phone text-yellow-400"></i>
                            <span class="text-gray-400">+62 293 123456</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-yellow-400"></i>
                            <span class="text-gray-400">info@smkitihsanulfikri.sch.id</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-clock text-yellow-400"></i>
                            <span class="text-gray-400">Senin - Jumat: 07:00 - 16:00</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-center md:text-left">
                    &copy; {{ date('Y') }} SMK Islam Terpadu Ihsanul Fikri. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        // Smooth Scrolling
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
        
        // Navbar Background on Scroll
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 100) {
                nav.classList.add('bg-white/90');
            } else {
                nav.classList.remove('bg-white/90');
            }
        });
        
        // Animation on Scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);
        
        // Observe all sections
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>
</html>