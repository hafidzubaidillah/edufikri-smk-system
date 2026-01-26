@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">👨‍🏫 Detail Guru</h2>
                <p class="text-muted mb-0">Informasi lengkap guru {{ $teacher->name }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Profile Card -->
    <div class="col-md-4">
        <div class="admin-card mb-4">
            <div class="card-body text-center">
                <div class="teacher-profile-photo mb-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 100px; height: 100px; font-size: 2.5rem;">
                        {{ substr($teacher->name, 0, 1) }}
                    </div>
                </div>
                <h5 class="mb-1">{{ $teacher->name }}</h5>
                <p class="text-muted mb-2">{{ $teacher->subject_specialization ?? 'Guru' }}</p>
                <div class="mb-3">
                    @if($teacher->is_active)
                        <span class="badge bg-success px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i>Aktif
                        </span>
                    @else
                        <span class="badge bg-secondary px-3 py-2">
                            <i class="fas fa-times-circle me-1"></i>Tidak Aktif
                        </span>
                    @endif
                </div>
                <div class="d-grid gap-2">
                    <a href="mailto:{{ $teacher->email }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-envelope me-1"></i>Kirim Email
                    </a>
                    @if($teacher->phone)
                        <a href="tel:{{ $teacher->phone }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-phone me-1"></i>Telepon
                        </a>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="admin-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-chart-bar me-2"></i>Statistik Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Kelas Diampu</span>
                    <span class="badge bg-primary">0</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Total Siswa</span>
                    <span class="badge bg-success">0</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Masa Kerja</span>
                    <span class="badge bg-info">
                        {{ $teacher->hire_date ? $teacher->hire_date->diffForHumans() : 'Belum diisi' }}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Login Terakhir</span>
                    <span class="badge bg-warning">
                        {{ $teacher->user && $teacher->user->last_login_at ? $teacher->user->last_login_at->diffForHumans() : 'Belum pernah' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Details -->
    <div class="col-md-8">
        <!-- Personal Information -->
        <div class="admin-card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-user me-2"></i>Informasi Pribadi
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Nama Lengkap</label>
                        <p class="mb-0 fw-bold">{{ $teacher->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">NIP</label>
                        <p class="mb-0"><code>{{ $teacher->nip }}</code></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Email</label>
                        <p class="mb-0">
                            <a href="mailto:{{ $teacher->email }}" class="text-decoration-none">
                                {{ $teacher->email }}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">No. Telepon</label>
                        <p class="mb-0">
                            @if($teacher->phone)
                                <a href="tel:{{ $teacher->phone }}" class="text-decoration-none">
                                    {{ $teacher->phone }}
                                </a>
                            @else
                                <span class="text-muted">Belum diisi</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted">Alamat</label>
                        <p class="mb-0">{{ $teacher->address ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Professional Information -->
        <div class="admin-card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>Informasi Profesional
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Spesialisasi</label>
                        <p class="mb-0">
                            @if($teacher->subject_specialization)
                                <span class="badge bg-primary px-3 py-2">{{ $teacher->subject_specialization }}</span>
                            @else
                                <span class="text-muted">Belum diisi</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Tingkat Pendidikan</label>
                        <p class="mb-0">
                            @if($teacher->education_level)
                                <span class="badge bg-success px-3 py-2">{{ $teacher->education_level }}</span>
                            @else
                                <span class="text-muted">Belum diisi</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Tanggal Bergabung</label>
                        <p class="mb-0">{{ $teacher->hire_date ? $teacher->hire_date->format('d F Y') : 'Belum diisi' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Status</label>
                        <p class="mb-0">
                            @if($teacher->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Account Information -->
        <div class="admin-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-key me-2"></i>Informasi Akun
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Email Terverifikasi</label>
                        <p class="mb-0">
                            @if($teacher->user && $teacher->user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i>Terverifikasi
                                </span>
                                <br><small class="text-muted">{{ $teacher->user->email_verified_at->format('d M Y H:i') }}</small>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-clock me-1"></i>Belum Terverifikasi
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Akun Dibuat</label>
                        @if($teacher->user)
                            <p class="mb-0">{{ $teacher->user->created_at->format('d F Y H:i') }}</p>
                            <small class="text-muted">{{ $teacher->user->created_at->diffForHumans() }}</small>
                        @else
                            <p class="mb-0"><span class="text-muted">Belum memiliki akun</span></p>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Login Terakhir</label>
                        <p class="mb-0">
                            @if($teacher->user && $teacher->user->last_login_at)
                                {{ $teacher->user->last_login_at->format('d M Y H:i') }}
                                <br><small class="text-muted">{{ $teacher->user->last_login_at->diffForHumans() }}</small>
                            @else
                                <span class="text-muted">Belum pernah login</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Role</label>
                        <p class="mb-0">
                            <span class="badge bg-info px-3 py-2">
                                <i class="fas fa-chalkboard-teacher me-1"></i>Guru/Employee
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Password Login</label>
                        @if($teacher->user && $teacher->user->plain_password)
                            <div class="d-flex align-items-center">
                                <code class="password-field me-2" data-password="{{ $teacher->user->plain_password }}">
                                    ••••••••
                                </code>
                                <button class="btn btn-sm btn-outline-secondary toggle-password" 
                                        onclick="togglePassword(this)" title="Tampilkan/Sembunyikan Password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Klik mata untuk melihat password</small>
                        @else
                            <p class="mb-0"><span class="text-muted">Password tidak tersedia</span></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mt-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-0">Aksi Lanjutan</h6>
                        <small class="text-muted">Tindakan yang dapat dilakukan untuk guru ini</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-info btn-sm" onclick="resetPassword()">
                            <i class="fas fa-key me-1"></i>Reset Password
                        </button>
                        <button class="btn btn-outline-warning btn-sm" onclick="toggleStatus()">
                            <i class="fas fa-toggle-on me-1"></i>
                            {{ $teacher->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteTeacher()">
                            <i class="fas fa-trash me-1"></i>Hapus Guru
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(button) {
    const passwordField = button.parentElement.querySelector('.password-field');
    const icon = button.querySelector('i');
    const actualPassword = passwordField.getAttribute('data-password');
    
    if (passwordField.textContent === '••••••••') {
        passwordField.textContent = actualPassword;
        icon.className = 'fas fa-eye-slash';
        button.title = 'Sembunyikan Password';
    } else {
        passwordField.textContent = '••••••••';
        icon.className = 'fas fa-eye';
        button.title = 'Tampilkan Password';
    }
}

function resetPassword() {
    if (confirm('Reset password untuk {{ $teacher->name }}?')) {
        alert('Fitur reset password akan segera tersedia');
    }
}

function toggleStatus() {
    const action = {{ $teacher->is_active ? 'false' : 'true' }};
    const text = action ? 'mengaktifkan' : 'menonaktifkan';
    
    if (confirm(`Apakah Anda yakin ingin ${text} guru {{ $teacher->name }}?`)) {
        alert('Fitur toggle status akan segera tersedia');
    }
}

function deleteTeacher() {
    if (confirm('Apakah Anda yakin ingin menghapus guru {{ $teacher->name }}? Tindakan ini tidak dapat dibatalkan.')) {
        // Redirect to delete
        window.location.href = '{{ route("admin.teachers.index") }}';
    }
}
</script>
@endsection