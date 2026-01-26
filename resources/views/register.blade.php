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
            animation: float 8s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 15%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 70%;
            right: 15%;
            animation-delay: -3s;
        }
        
        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 30%;
            left: 25%;
            animation-delay: -6s;
        }
        
        .shape:nth-child(4) {
            width: 60px;
            height: 60px;
            top: 40%;
            right: 30%;
            animation-delay: -1s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(-15px) rotate(240deg); }
        }
        
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
            border-color: #3b82f6;
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .step-indicator {
            transition: all 0.3s ease;
        }
        
        .step-indicator.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        
        .password-strength {
            height: 4px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #059669; width: 100%; }
    </style>

    <div class="min-h-screen gradient-bg flex items-center justify-center p-4 relative">
        <!-- Floating Shapes -->
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="w-full max-w-lg relative z-10">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ url('/') }}" class="inline-flex items-center text-white/80 hover:text-white transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
            
            <!-- Register Card -->
            <div class="glass-effect rounded-3xl p-8 shadow-2xl">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-white mb-2">Bergabung dengan EDUFIKRI</h1>
                    <p class="text-white/80">Mulai perjalanan pembelajaran Anda hari ini</p>
                </div>

                <!-- Progress Steps -->
                <div class="flex justify-center mb-8">
                    <div class="flex items-center space-x-4">
                        <div class="step-indicator active w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">1</div>
                        <div class="w-12 h-1 bg-white/20 rounded"></div>
                        <div class="step-indicator w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold text-white/60">2</div>
                        <div class="w-12 h-1 bg-white/20 rounded"></div>
                        <div class="step-indicator w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-sm font-bold text-white/60">3</div>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form id="registerForm" method="POST" action="{{ route('register.submit') }}" class="space-y-6">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-white font-medium mb-2">
                            <i class="fas fa-user mr-2"></i>
                            Nama Lengkap
                        </label>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama lengkap Anda"
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent input-glow transition-all duration-200">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Email -->
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
                               autocomplete="email"
                               placeholder="Masukkan email Anda"
                               class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent input-glow transition-all duration-200">
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
                                   autocomplete="new-password"
                                   placeholder="Buat password yang kuat"
                                   oninput="checkPasswordStrength()"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent input-glow transition-all duration-200 pr-12">
                            <button type="button" 
                                    onclick="togglePassword('password')" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/60 hover:text-white transition-colors">
                                <i id="passwordIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="w-full bg-white/20 rounded-full h-1">
                                <div id="passwordStrength" class="password-strength bg-gray-400 rounded-full"></div>
                            </div>
                            <p id="passwordStrengthText" class="text-xs text-white/60 mt-1">Kekuatan password</p>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-white font-medium mb-2">
                            <i class="fas fa-lock mr-2"></i>
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation" 
                                   required
                                   placeholder="Ulangi password Anda"
                                   oninput="checkPasswordMatch()"
                                   class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent input-glow transition-all duration-200 pr-12">
                            <button type="button" 
                                    onclick="togglePassword('password_confirmation')" 
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/60 hover:text-white transition-colors">
                                <i id="passwordConfirmIcon" class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="passwordMatchIndicator" class="mt-2 text-xs hidden">
                            <span id="passwordMatchText"></span>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300" />
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start space-x-3">
                        <input id="terms" 
                               type="checkbox" 
                               name="terms" 
                               required
                               class="w-5 h-5 text-green-600 bg-white/10 border-white/20 rounded focus:ring-green-500 focus:ring-2 mt-1">
                        <label for="terms" class="text-white/80 text-sm leading-relaxed">
                            Saya setuju dengan 
                            <a href="#" class="text-white font-semibold hover:underline">Syarat & Ketentuan</a> 
                            dan 
                            <a href="#" class="text-white font-semibold hover:underline">Kebijakan Privasi</a> 
                            EDUFIKRI
                        </label>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" 
                            id="registerBtn"
                            class="w-full bg-gradient-to-r from-green-500 to-blue-600 text-white font-bold py-3 px-6 rounded-xl hover:shadow-lg transform transition-all duration-200 btn-hover">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </button>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/20"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-transparent text-white/60">atau daftar dengan</span>
                        </div>
                    </div>

                    <!-- Social Register Buttons -->
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" 
                                class="flex items-center justify-center px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white hover:bg-white/20 transition-all duration-200">
                            <i class="fab fa-google mr-2"></i>
                            Google
                        </button>
                        <button type="button" 
                                class="flex items-center justify-center px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-white hover:bg-white/20 transition-all duration-200">
                            <i class="fab fa-github mr-2"></i>
                            GitHub
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-white/80">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" 
                               class="text-white font-semibold hover:underline">
                                Masuk di sini
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Benefits Preview -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="glass-effect rounded-xl p-4 text-center">
                    <i class="fas fa-graduation-cap text-white text-2xl mb-2"></i>
                    <p class="text-white/80 text-sm">500+ Kursus Premium</p>
                </div>
                <div class="glass-effect rounded-xl p-4 text-center">
                    <i class="fas fa-certificate text-white text-2xl mb-2"></i>
                    <p class="text-white/80 text-sm">Sertifikat Resmi</p>
                </div>
                <div class="glass-effect rounded-xl p-4 text-center">
                    <i class="fas fa-users text-white text-2xl mb-2"></i>
                    <p class="text-white/80 text-sm">Komunitas 10K+</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loader" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="glass-effect rounded-2xl p-8 text-center">
            <div class="w-16 h-16 border-4 border-white/20 border-t-white rounded-full animate-spin mx-auto mb-4"></div>
            <p class="text-white font-semibold">Membuat akun Anda...</p>
            <p class="text-white/60 text-sm mt-2">Mohon tunggu sebentar</p>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const passwordIcon = document.getElementById(fieldId + 'Icon');
            
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
        
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthBar = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('passwordStrengthText');
            
            let strength = 0;
            let text = '';
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            strengthBar.className = 'password-strength rounded-full';
            
            switch (strength) {
                case 0:
                case 1:
                    strengthBar.classList.add('strength-weak');
                    text = 'Password lemah';
                    break;
                case 2:
                case 3:
                    strengthBar.classList.add('strength-fair');
                    text = 'Password cukup';
                    break;
                case 4:
                    strengthBar.classList.add('strength-good');
                    text = 'Password bagus';
                    break;
                case 5:
                    strengthBar.classList.add('strength-strong');
                    text = 'Password sangat kuat';
                    break;
            }
            
            strengthText.textContent = text;
        }
        
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const indicator = document.getElementById('passwordMatchIndicator');
            const text = document.getElementById('passwordMatchText');
            
            if (confirmPassword.length > 0) {
                indicator.classList.remove('hidden');
                if (password === confirmPassword) {
                    text.textContent = '✓ Password cocok';
                    text.className = 'text-green-400';
                } else {
                    text.textContent = '✗ Password tidak cocok';
                    text.className = 'text-red-400';
                }
            } else {
                indicator.classList.add('hidden');
            }
        }
        
        // Form submission with loading
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const button = document.getElementById('registerBtn');
            const loader = document.getElementById('loader');
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            button.disabled = true;
            loader.classList.remove('hidden');
        });
        
        // Hide loader on page load
        window.addEventListener('load', function() {
            document.getElementById('loader').classList.add('hidden');
        });
    </script>

    <!-- Add FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Success/Error Messages -->
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#10b981',
                timer: 3000
            });
        </script>
    @endif

    @if($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Registrasi Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                timer: 4000,
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif
</x-guest-layout>