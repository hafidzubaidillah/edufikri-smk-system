@extends('layouts.admin')

@section('title', 'Tambah Siswa - ' . $class->name . ' - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .form-card {
        border-left: 4px solid #1a5f1a;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stats-card {
        background: linear-gradient(135deg, #1a5f1a, #ffc107);
        color: white;
    }
    .simple-form {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 2rem;
    }
</style>
@endpush

<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2">
                            <i class="fas fa-user-plus me-2"></i>Tambah Siswa Baru
                        </h2>
                        <p class="mb-0">Tambahkan siswa ke <strong>{{ $class->name }}</strong> - Cukup isi nama, username, dan password</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-light btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form -->
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card form-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>Data Siswa Baru
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Class Info -->
                <div class="alert alert-success mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>Informasi Kelas:</h6>
                            <strong>Kelas:</strong> {{ $class->name }}<br>
                            <strong>Tingkat:</strong> {{ $class->grade == 10 ? 'X' : ($class->grade == 11 ? 'XI' : 'XII') }}<br>
                            <strong>Jurusan:</strong> {{ $class->major }}
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-2"><i class="fas fa-users me-2"></i>Kapasitas:</h6>
                            <strong>Terisi:</strong> {{ $class->current_students }}/{{ $class->capacity }} siswa<br>
                            <strong>Sisa Slot:</strong> {{ $class->capacity - $class->current_students }} siswa<br>
                            <strong>Wali Kelas:</strong> {{ $class->homeroom_teacher }}
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.classes.students.store', $class) }}" method="POST">
                    @csrf
                    
                    <div class="simple-form">
                        <h6 class="mb-4 text-center text-primary">
                            <i class="fas fa-graduation-cap me-2"></i>Form Siswa Sederhana
                        </h6>
                        
                        <!-- Nama Lengkap -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">
                                <i class="fas fa-user me-2"></i>Nama Lengkap Siswa
                            </label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Contoh: Ahmad Rizki Pratama" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Nama lengkap siswa sesuai dokumen resmi</small>
                        </div>

                        <!-- Username -->
                        <div class="mb-4">
                            <label for="username" class="form-label fw-bold">
                                <i class="fas fa-at me-2"></i>Username untuk Login
                            </label>
                            <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" 
                                   id="username" name="username" value="{{ old('username') }}" 
                                   placeholder="Contoh: ahmad.rizki atau 2024001" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Username unik untuk login siswa (bisa NIS atau nama panggilan)</small>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                       id="password" name="password" 
                                       placeholder="Minimal 6 karakter" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="passwordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Password untuk login siswa (minimal 6 karakter)</small>
                        </div>

                        <!-- Auto Generate Options -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-info btn-sm w-100" onclick="generateUsername()">
                                    <i class="fas fa-magic me-1"></i>Auto Username
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-warning btn-sm w-100" onclick="generatePassword()">
                                    <i class="fas fa-key me-1"></i>Auto Password
                                </button>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-info">
                            <h6 class="mb-2"><i class="fas fa-magic me-2"></i>Yang Akan Dibuat Otomatis:</h6>
                            <ul class="mb-0 small">
                                <li>✅ Akun login siswa dengan role "learner"</li>
                                <li>✅ Email otomatis: username@student.edufikri.com</li>
                                <li>✅ NIS otomatis berdasarkan tahun dan urutan</li>
                                <li>✅ Kelas: <strong>{{ $class->name }}</strong> (Tingkat {{ $class->grade == 10 ? 'X' : ($class->grade == 11 ? 'XI' : 'XII') }})</li>
                                <li>✅ Data profil dasar (bisa dilengkapi nanti)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-save me-2"></i>Tambah Siswa & Buat Akun
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Toggle password visibility
function togglePassword() {
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}

// Generate username from name
function generateUsername() {
    const name = document.getElementById('name').value;
    const usernameField = document.getElementById('username');
    
    if (name) {
        // Convert name to username format
        const cleanName = name.toLowerCase()
            .replace(/[^a-z\s]/g, '') // Remove non-alphabetic characters
            .trim()
            .split(' ')
            .slice(0, 2) // Take first 2 words
            .join('.');
        
        usernameField.value = cleanName;
    } else {
        alert('Isi nama terlebih dahulu');
        document.getElementById('name').focus();
    }
}

// Generate random password
function generatePassword() {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let password = '';
    
    for (let i = 0; i < 8; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    
    document.getElementById('password').value = password;
    
    // Show password temporarily
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    passwordField.type = 'text';
    passwordIcon.classList.remove('fa-eye');
    passwordIcon.classList.add('fa-eye-slash');
    
    // Copy to clipboard
    navigator.clipboard.writeText(password).then(() => {
        // Show success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Tersalin!';
        btn.classList.remove('btn-outline-warning');
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-warning');
        }, 2000);
    });
}

// Auto-generate username when name changes
document.getElementById('name').addEventListener('blur', function() {
    const usernameField = document.getElementById('username');
    if (this.value && !usernameField.value) {
        generateUsername();
    }
});

// Validate username format
document.getElementById('username').addEventListener('input', function() {
    this.value = this.value.toLowerCase().replace(/[^a-z0-9.]/g, '');
});
</script>
@endpush