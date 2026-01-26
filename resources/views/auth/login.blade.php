<x-guest-layout>
    <!-- Custom Styles -->
    <style>
        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }
        
        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
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
            animation-delay: -2s;
        }
        
        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: -4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            border-color: #3b82f6;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="min-h-screen gradient-bg flex items-center justify-center p-4 relative">
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="w-full max-w-md relative z-10">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
            
            <!-- Login Card -->
            <div class="glass-effect rounded-3xl p-8 shadow-2xl">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali!</h1>
                    <p class="text-white/80">Masuk ke akun EDUFIKRI Anda untuk melanjutkan pembelajaran</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-white font-medium mb-2">
                            <i class="fas fa-envelope mr-2"></i>
                            Email Address
                        </label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               placeholder="Masukkan email Anda"
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-glow transition-all duration-200">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-white font-medium mb-2">
                            <i class="fas fa-lock mr-2"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="current-password"
                                   placeholder="Masukkan password Anda"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent input-glow transition-all duration-200 pr-12">
                            <button type="button" 
                                    onclick="togglePassword()" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/60 hover:text-white transition-colors">
                                <i id="passwordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   name="remember"
                                   class="w-4 h-4 text-blue-600 bg-white/10 border-white/20 rounded focus:ring-blue-500 focus:ring-2">
                            <span class="ml-2 text-white/80 text-sm">Ingat saya</span>
                        </label>

                        <button type="button" 
                                onclick="showForgotPasswordInfo()"
                                class="text-sm text-white/80 hover:text-white transition-colors">
                            Lupa password?
                        </button>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform transition-all duration-200 btn-hover">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk ke Dashboard
                    </button>

                    <!-- Contact Admin -->
                    <div class="text-center mt-6">
                        <p class="text-white/80">
                            Belum punya akun? Hubungi administrator untuk mendaftar.
                        </p>
                    </div>
                </form>
            </div>

            <!-- Forgot Password Modal -->
            <div id="forgotPasswordModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
                <div class="glass-effect rounded-3xl p-8 max-w-md mx-4 relative">
                    <button onclick="closeForgotPasswordModal()" 
                            class="absolute top-4 right-4 text-white/60 hover:text-white transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-key text-white text-2xl"></i>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-white mb-4">Lupa Password?</h3>
                        
                        <div class="text-white/80 space-y-4 text-left">
                            <p class="text-center mb-6">Untuk reset password, silakan hubungi administrator sekolah melalui:</p>
                            
                            <div class="space-y-3">
                                <div class="flex items-center p-3 bg-white/10 rounded-xl">
                                    <i class="fas fa-user-shield text-blue-400 mr-3"></i>
                                    <div>
                                        <p class="font-semibold">Administrator</p>
                                        <p class="text-sm text-white/70">SMK IT Ihsanul Fikri</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-3 bg-white/10 rounded-xl">
                                    <i class="fas fa-phone text-green-400 mr-3"></i>
                                    <div>
                                        <p class="font-semibold">WhatsApp</p>
                                        <a href="https://wa.me/6281234567890" target="_blank" 
                                           class="text-sm text-blue-300 hover:text-blue-200">
                                            +62 812-3456-7890
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-3 bg-white/10 rounded-xl">
                                    <i class="fas fa-envelope text-red-400 mr-3"></i>
                                    <div>
                                        <p class="font-semibold">Email</p>
                                        <a href="mailto:admin@smk-ihsanulfikri.edu" 
                                           class="text-sm text-blue-300 hover:text-blue-200">
                                            admin@smk-ihsanulfikri.edu
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="flex items-center p-3 bg-white/10 rounded-xl">
                                    <i class="fas fa-clock text-yellow-400 mr-3"></i>
                                    <div>
                                        <p class="font-semibold">Jam Kerja</p>
                                        <p class="text-sm text-white/70">Senin - Jumat: 07:00 - 16:00</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-6 p-4 bg-blue-500/20 rounded-xl border border-blue-400/30">
                                <div class="flex items-start">
                                    <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i>
                                    <div class="text-sm">
                                        <p class="font-semibold text-blue-300 mb-1">Informasi Penting:</p>
                                        <p class="text-white/80">Sertakan nama lengkap dan kelas Anda saat menghubungi admin untuk mempercepat proses reset password.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button onclick="closeForgotPasswordModal()" 
                                class="w-full mt-6 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform transition-all duration-200">
                            <i class="fas fa-check mr-2"></i>
                            Mengerti
                        </button>
                    </div>
                </div>
            </div>

            <!-- Features Preview -->
            <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                <div class="glass-effect rounded-xl p-4">
                    <i class="fas fa-brain text-white text-2xl mb-2"></i>
                    <p class="text-white/80 text-sm">AI Learning</p>
                </div>
                <div class="glass-effect rounded-xl p-4">
                    <i class="fas fa-certificate text-white text-2xl mb-2"></i>
                    <p class="text-white/80 text-sm">Sertifikat</p>
                </div>
                <div class="glass-effect rounded-xl p-4">
                    <i class="fas fa-users text-white text-2xl mb-2"></i>
                    <p class="text-white/80 text-sm">Komunitas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
        
        function showForgotPasswordInfo() {
            const modal = document.getElementById('forgotPasswordModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        
        function closeForgotPasswordModal() {
            const modal = document.getElementById('forgotPasswordModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
        
        // Close modal when clicking outside
        document.getElementById('forgotPasswordModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeForgotPasswordModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeForgotPasswordModal();
            }
        });
        
        // Add loading state to login button
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = document.querySelector('button[type="submit"]');
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            button.disabled = true;
        });
    </script>

    <!-- Add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-guest-layout>
