<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-indigo-100">
        <div class="w-full sm:max-w-lg mt-6 px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Verifikasi Email</h2>
                <p class="text-sm text-gray-600">Langkah terakhir untuk mengaktifkan akun Anda</p>
            </div>

            <!-- Main Content -->
            <div class="space-y-6">
                <!-- User Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-lg">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-blue-900">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-blue-700">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Instructions -->
                <div class="text-center space-y-4">
                    <p class="text-gray-700 leading-relaxed">
                        Terima kasih telah mendaftar di <strong class="text-indigo-600">{{ config('app.name') }}</strong>! 
                        Kami telah mengirimkan link verifikasi ke alamat email Anda.
                    </p>
                    
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-amber-400 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-amber-800">
                                    <strong>Periksa folder spam/junk</strong> jika email tidak ditemukan di inbox Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">Email verifikasi berhasil dikirim!</p>
                                <p class="text-sm text-green-700 mt-1">Periksa inbox Anda dan klik link verifikasi.</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                @foreach ($errors->all() as $error)
                                    <p class="text-sm text-red-800">{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="w-full justify-center py-3 text-base font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Kirim Ulang Email Verifikasi
                        </x-primary-button>
                    </form>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">atau</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gray-600 border border-transparent rounded-lg font-semibold text-base text-white uppercase tracking-wide hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Keluar dari Akun
                        </button>
                    </form>
                </div>

                <!-- Help Section -->
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Butuh bantuan?</h3>
                    <div class="space-y-2 text-xs text-gray-600">
                        <p>• Link verifikasi berlaku selama {{ config('services.email_verification.expire_minutes', 60) }} menit</p>
                        <p>• Maksimal {{ config('services.email_verification.throttle_attempts', 5) }} percobaan per jam</p>
                        <p>• Hubungi support jika masalah berlanjut</p>
                    </div>
                    <div class="mt-3">
                        <a href="mailto:support@{{ parse_url(config('app.url'), PHP_URL_HOST) }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium">
                            📧 Hubungi Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Auto-refresh script -->
    <script>
        // Auto refresh page every 30 seconds to check verification status
        let refreshInterval;
        
        function startAutoRefresh() {
            refreshInterval = setInterval(() => {
                fetch('{{ route("verification.check") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.verified) {
                        clearInterval(refreshInterval);
                        window.location.href = '{{ route("dashboard") }}?verified=1';
                    }
                })
                .catch(error => console.log('Check failed:', error));
            }, 30000);
        }
        
        // Start auto-refresh when page loads
        document.addEventListener('DOMContentLoaded', startAutoRefresh);
        
        // Clear interval when page is hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                clearInterval(refreshInterval);
            } else {
                startAutoRefresh();
            }
        });
    </script>
</x-guest-layout>
