<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight font-poppins">
                    Dashboard
                </h2>
                <p class="text-gray-600 mt-1">Selamat datang kembali, {{ auth()->user()->name }}! 👋</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    <i class="fas fa-crown mr-2"></i>
                    Premium Member
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Custom Styles -->
    <style>
        .font-poppins { font-family: 'Poppins', sans-serif; }
        
        .gradient-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .pulse-dot {
            animation: pulse-dot 2s infinite;
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            stroke-dasharray: 251.2;
            stroke-dashoffset: 251.2;
            transition: stroke-dashoffset 0.5s ease-in-out;
        }
    </style>

    <div class="py-8 bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Courses -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Kursus</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">24</p>
                            <p class="text-green-600 text-sm mt-2">
                                <i class="fas fa-arrow-up mr-1"></i>
                                +3 bulan ini
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-book text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Completed Courses -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Kursus Selesai</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">18</p>
                            <p class="text-green-600 text-sm mt-2">
                                <i class="fas fa-arrow-up mr-1"></i>
                                75% completion rate
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Learning Hours -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Jam Belajar</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">156</p>
                            <p class="text-blue-600 text-sm mt-2">
                                <i class="fas fa-clock mr-1"></i>
                                +12h minggu ini
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Certificates -->
                <div class="bg-white rounded-2xl p-6 shadow-lg hover-lift border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Sertifikat</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">12</p>
                            <p class="text-yellow-600 text-sm mt-2">
                                <i class="fas fa-trophy mr-1"></i>
                                +2 baru
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center">
                            <i class="fas fa-certificate text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Current Learning Progress -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 font-poppins">Progress Pembelajaran</h3>
                            <button class="text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</button>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Course 1 -->
                            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-code text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Full Stack Web Development</h4>
                                    <p class="text-gray-600 text-sm">React, Node.js, MongoDB</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2 mr-4">
                                            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full" style="width: 75%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">75%</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">Sisa</div>
                                    <div class="font-semibold text-gray-900">2 minggu</div>
                                </div>
                            </div>
                            
                            <!-- Course 2 -->
                            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-robot text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Machine Learning Fundamentals</h4>
                                    <p class="text-gray-600 text-sm">Python, TensorFlow, Scikit-learn</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2 mr-4">
                                            <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-2 rounded-full" style="width: 45%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">45%</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">Sisa</div>
                                    <div class="font-semibold text-gray-900">4 minggu</div>
                                </div>
                            </div>
                            
                            <!-- Course 3 -->
                            <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl">
                                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-mobile-alt text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Flutter Mobile Development</h4>
                                    <p class="text-gray-600 text-sm">Dart, Flutter, Firebase</p>
                                    <div class="flex items-center mt-2">
                                        <div class="flex-1 bg-gray-200 rounded-full h-2 mr-4">
                                            <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-2 rounded-full" style="width: 90%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">90%</span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">Sisa</div>
                                    <div class="font-semibold text-gray-900">3 hari</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 font-poppins">Aktivitas Terbaru</h3>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full pulse-dot"></div>
                                <span class="text-sm text-gray-500">Live</span>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Activity 1 -->
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-play text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">Menyelesaikan video "Advanced React Hooks"</p>
                                    <p class="text-gray-500 text-sm">Full Stack Web Development • 2 jam yang lalu</p>
                                </div>
                                <div class="text-green-600 font-semibold text-sm">+50 XP</div>
                            </div>
                            
                            <!-- Activity 2 -->
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">Menyelesaikan quiz "Python Basics"</p>
                                    <p class="text-gray-500 text-sm">Machine Learning Fundamentals • 5 jam yang lalu</p>
                                </div>
                                <div class="text-green-600 font-semibold text-sm">+100 XP</div>
                            </div>
                            
                            <!-- Activity 3 -->
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-trophy text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">Mendapatkan badge "Flutter Expert"</p>
                                    <p class="text-gray-500 text-sm">Flutter Mobile Development • 1 hari yang lalu</p>
                                </div>
                                <div class="text-yellow-600 font-semibold text-sm">Badge</div>
                            </div>
                            
                            <!-- Activity 4 -->
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-fire text-white text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-900 font-medium">Mencapai streak belajar 7 hari</p>
                                    <p class="text-gray-500 text-sm">Konsistensi pembelajaran • 2 hari yang lalu</p>
                                </div>
                                <div class="text-orange-600 font-semibold text-sm">Streak</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    
                    <!-- Learning Goals -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 font-poppins mb-6">Target Pembelajaran</h3>
                        
                        <!-- Weekly Goal -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-gray-700 font-medium">Target Mingguan</span>
                                <span class="text-blue-600 font-semibold">12/15 jam</span>
                            </div>
                            <div class="relative">
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full" style="width: 80%"></div>
                                </div>
                                <div class="absolute -top-1 right-0 transform translate-x-1/2">
                                    <div class="w-5 h-5 bg-blue-600 rounded-full border-2 border-white shadow-lg"></div>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">3 jam lagi untuk mencapai target</p>
                        </div>
                        
                        <!-- Monthly Goal -->
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-gray-700 font-medium">Target Bulanan</span>
                                <span class="text-green-600 font-semibold">45/60 jam</span>
                            </div>
                            <div class="relative">
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full" style="width: 75%"></div>
                                </div>
                                <div class="absolute -top-1 right-0 transform translate-x-1/2" style="left: 75%;">
                                    <div class="w-5 h-5 bg-green-600 rounded-full border-2 border-white shadow-lg"></div>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm mt-2">15 jam lagi untuk mencapai target</p>
                        </div>
                        
                        <!-- Streak Counter -->
                        <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="flex items-center space-x-2">
                                        <i class="fas fa-fire text-orange-500 text-xl"></i>
                                        <span class="font-bold text-gray-900">Streak Belajar</span>
                                    </div>
                                    <div class="text-3xl font-bold text-orange-600 mt-1">7 Hari</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500">Terbaik</div>
                                    <div class="font-semibold text-gray-900">21 hari</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Progress -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 font-poppins mb-6">Progress Skill</h3>
                        
                        <div class="space-y-6">
                            <!-- JavaScript -->
                            <div class="flex items-center space-x-4">
                                <div class="relative w-16 h-16">
                                    <svg class="w-16 h-16 progress-ring">
                                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="transparent"></circle>
                                        <circle cx="32" cy="32" r="28" stroke="#f59e0b" stroke-width="4" fill="transparent" 
                                                class="progress-ring-circle" style="stroke-dashoffset: 62.8;"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold text-gray-900">75%</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">JavaScript</h4>
                                    <p class="text-gray-500 text-sm">Advanced Level</p>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-arrow-up text-green-500 text-xs mr-1"></i>
                                        <span class="text-green-500 text-xs">+5% minggu ini</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Python -->
                            <div class="flex items-center space-x-4">
                                <div class="relative w-16 h-16">
                                    <svg class="w-16 h-16 progress-ring">
                                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="transparent"></circle>
                                        <circle cx="32" cy="32" r="28" stroke="#10b981" stroke-width="4" fill="transparent" 
                                                class="progress-ring-circle" style="stroke-dashoffset: 100.48;"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold text-gray-900">60%</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">Python</h4>
                                    <p class="text-gray-500 text-sm">Intermediate Level</p>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-arrow-up text-green-500 text-xs mr-1"></i>
                                        <span class="text-green-500 text-xs">+8% minggu ini</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- React -->
                            <div class="flex items-center space-x-4">
                                <div class="relative w-16 h-16">
                                    <svg class="w-16 h-16 progress-ring">
                                        <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="4" fill="transparent"></circle>
                                        <circle cx="32" cy="32" r="28" stroke="#3b82f6" stroke-width="4" fill="transparent" 
                                                class="progress-ring-circle" style="stroke-dashoffset: 50.24;"></circle>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold text-gray-900">80%</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">React</h4>
                                    <p class="text-gray-500 text-sm">Advanced Level</p>
                                    <div class="flex items-center mt-1">
                                        <i class="fas fa-arrow-up text-green-500 text-xs mr-1"></i>
                                        <span class="text-green-500 text-xs">+3% minggu ini</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 font-poppins mb-6">Aksi Cepat</h3>
                        
                        <div class="space-y-3">
                            <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-play mr-2"></i>
                                Lanjutkan Belajar
                            </button>
                            
                            <button class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white p-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-search mr-2"></i>
                                Jelajahi Kursus Baru
                            </button>
                            
                            <button class="w-full bg-gradient-to-r from-purple-500 to-purple-600 text-white p-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-users mr-2"></i>
                                Gabung Komunitas
                            </button>
                            
                            <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white p-4 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-certificate mr-2"></i>
                                Lihat Sertifikat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>
