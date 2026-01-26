<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Sekolah - SMK IT Ihsanul Fikri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="navbar-school fixed top-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <x-school-logo />
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="nav-link">Beranda</a>
                    <a href="#visi-misi" class="nav-link">Visi & Misi</a>
                    <a href="#sejarah" class="nav-link">Sejarah</a>
                    <a href="#struktur" class="nav-link">Struktur Organisasi</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="btn-school-outline">Portal Siswa</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section islamic-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <h1 class="text-5xl lg:text-7xl font-bold font-poppins mb-6">
                    Sekolah Menengah Kejuruan
                    <span class="block text-yellow-300">Islam Terpadu</span>
                    <span class="block">Ihsanul Fikri</span>
                </h1>
                <p class="text-xl lg:text-2xl mb-8 max-w-4xl mx-auto">
                    Mungkid, Kabupaten Magelang, Jawa Tengah
                </p>
                <div class="text-lg mb-8">
                    <p class="mb-2">📍 Jl. Raya Mungkid, Magelang, Jawa Tengah 56511</p>
                    <p class="mb-2">📞 +62 293 123456</p>
                    <p>✉️ info@smkitihsanulfikri.sch.id</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Visi & <span class="text-school-green">Misi</span>
                </h2>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Visi -->
                <div class="school-card">
                    <div class="school-card-header">
                        <i class="fas fa-eye text-4xl mb-4"></i>
                        <h3 class="text-2xl font-bold">VISI</h3>
                    </div>
                    <div class="school-card-body">
                        <p class="text-lg leading-relaxed text-gray-700">
                            Menjadi SMK Islam terdepan yang menghasilkan lulusan beriman, bertaqwa, 
                            berakhlak mulia, dan berkompetensi tinggi di bidang teknologi untuk 
                            menghadapi tantangan global dengan tetap berpegang teguh pada nilai-nilai Islam.
                        </p>
                    </div>
                </div>
                
                <!-- Misi -->
                <div class="school-card">
                    <div class="school-card-header">
                        <i class="fas fa-bullseye text-4xl mb-4"></i>
                        <h3 class="text-2xl font-bold">MISI</h3>
                    </div>
                    <div class="school-card-body">
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex items-start">
                                <i class="fas fa-check text-school-green mt-1 mr-3"></i>
                                <span>Menyelenggarakan pendidikan kejuruan berbasis Islam yang berkualitas</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-school-green mt-1 mr-3"></i>
                                <span>Mengembangkan kompetensi siswa sesuai dengan kebutuhan industri dan teknologi terkini</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-school-green mt-1 mr-3"></i>
                                <span>Membentuk karakter Islami yang kuat dan berakhlak mulia</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-school-green mt-1 mr-3"></i>
                                <span>Membangun kemitraan dengan dunia usaha dan industri</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-school-green mt-1 mr-3"></i>
                                <span>Menciptakan lingkungan belajar yang kondusif dan Islami</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section id="sejarah" class="py-20 bg-school-light-green">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Sejarah <span class="text-school-green">Sekolah</span>
                </h2>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="school-card">
                    <div class="school-card-body">
                        <div class="prose prose-lg max-w-none text-gray-700">
                            <p class="text-xl leading-relaxed mb-6">
                                SMK Islam Terpadu Ihsanul Fikri didirikan pada tahun 2010 dengan visi 
                                menjadi lembaga pendidikan kejuruan yang menggabungkan keunggulan akademik 
                                dengan nilai-nilai Islam yang kuat.
                            </p>
                            
                            <h4 class="text-2xl font-bold text-school-green mb-4">Tonggak Sejarah</h4>
                            
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="bg-school-green text-white rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                        2010
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-lg">Pendirian Sekolah</h5>
                                        <p>SMK IT Ihsanul Fikri resmi didirikan dengan 2 program keahlian: TJKT dan TSM</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-school-green text-white rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                        2015
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-lg">Akreditasi A</h5>
                                        <p>Meraih akreditasi A dari Badan Akreditasi Nasional Sekolah/Madrasah</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-school-green text-white rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                        2018
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-lg">Penambahan Program</h5>
                                        <p>Membuka program keahlian baru: PPLG, TKR, dan AKL</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-school-green text-white rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                        2020
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-lg">Digitalisasi</h5>
                                        <p>Implementasi sistem pembelajaran digital dan manajemen sekolah online</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="bg-school-yellow text-gray-900 rounded-full w-12 h-12 flex items-center justify-center font-bold mr-4 flex-shrink-0">
                                        2025
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-lg">Pengembangan Berkelanjutan</h5>
                                        <p>Terus berinovasi dalam pendidikan kejuruan berbasis teknologi dan nilai Islam</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section id="struktur" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-gray-900 mb-6">
                    Struktur <span class="text-school-green">Organisasi</span>
                </h2>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Kepala Sekolah -->
                <div class="text-center">
                    <div class="school-card">
                        <div class="school-card-body">
                            <div class="w-24 h-24 bg-school-gradient rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-user-tie text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Drs. Ahmad Fauzi, M.Pd</h3>
                            <p class="text-school-green font-semibold">Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
                
                <!-- Wakil Kepala Sekolah -->
                <div class="text-center">
                    <div class="school-card">
                        <div class="school-card-body">
                            <div class="w-24 h-24 bg-school-gradient rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-user-graduate text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Siti Nurhaliza, S.Pd</h3>
                            <p class="text-school-green font-semibold">Wakil Kepala Sekolah</p>
                        </div>
                    </div>
                </div>
                
                <!-- Kepala Tata Usaha -->
                <div class="text-center">
                    <div class="school-card">
                        <div class="school-card-body">
                            <div class="w-24 h-24 bg-school-gradient rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-clipboard-list text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Budi Santoso, S.E</h3>
                            <p class="text-school-green font-semibold">Kepala Tata Usaha</p>
                        </div>
                    </div>
                </div>
                
                <!-- Koordinator Program -->
                <div class="text-center">
                    <div class="school-card">
                        <div class="school-card-body">
                            <div class="w-24 h-24 bg-school-gradient rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-laptop-code text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Eko Prasetyo, S.Kom</h3>
                            <p class="text-school-green font-semibold">Koordinator TJKT & PPLG</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="school-card">
                        <div class="school-card-body">
                            <div class="w-24 h-24 bg-school-gradient rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-tools text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Agus Wijaya, S.T</h3>
                            <p class="text-school-green font-semibold">Koordinator TKR & TSM</p>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="school-card">
                        <div class="school-card-body">
                            <div class="w-24 h-24 bg-school-gradient rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-calculator text-white text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Maya Sari, S.E</h3>
                            <p class="text-school-green font-semibold">Koordinator AKL</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 school-gradient">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl lg:text-5xl font-bold font-poppins text-white mb-6">
                Bergabunglah Dengan Kami
            </h2>
            <p class="text-xl text-white/90 mb-8">
                Wujudkan cita-cita Anda bersama SMK IT Ihsanul Fikri
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="bg-white text-school-green px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-200">
                    Masuk Sekarang
                </a>
                <a href="/" class="border-2 border-white text-white px-8 py-4 rounded-full font-bold text-lg hover:bg-white hover:text-school-green transition-all duration-200">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-school">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <x-school-logo />
                <p class="text-gray-400 mt-4 max-w-2xl mx-auto">
                    SMK Islam Terpadu Ihsanul Fikri - Membentuk generasi yang beriman, bertaqwa, 
                    berakhlak mulia, dan berkompetensi tinggi.
                </p>
                <div class="mt-8 pt-8 border-t border-gray-800">
                    <p class="text-gray-400">
                        &copy; {{ date('Y') }} SMK Islam Terpadu Ihsanul Fikri. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>