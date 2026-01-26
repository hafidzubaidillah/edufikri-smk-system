@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">👨‍🎓 Detail Siswa</h2>
                <p class="text-muted mb-0">Informasi lengkap siswa {{ $learner->name }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.learners.edit', $learner) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit
                </a>
                <a href="{{ route('admin.learners.index') }}" class="btn btn-outline-secondary">
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
                <div class="student-profile-photo mb-3">
                    @if($learner->profile_photo)
                        <img src="{{ asset('storage/' . $learner->profile_photo) }}" 
                             alt="Profile Photo" 
                             class="rounded-circle mx-auto d-block"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                             style="width: 100px; height: 100px; font-size: 2.5rem;">
                            {{ substr($learner->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <h5 class="mb-1">{{ $learner->name }}</h5>
                <p class="text-muted mb-2">{{ $learner->student_id ?? 'Siswa' }}</p>
                <div class="mb-3">
                    @if($learner->is_active)
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
                    <a href="mailto:{{ $learner->email }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-envelope me-1"></i>Kirim Email
                    </a>
                    @if($learner->phone)
                        <a href="tel:{{ $learner->phone }}" class="btn btn-outline-success btn-sm">
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
                @if($learner->schoolClass)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Kelas</span>
                        <span class="badge bg-primary">{{ $learner->schoolClass->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Teman Sekelas</span>
                        <span class="badge bg-success">{{ $classStats['total_students'] - 1 ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Mata Pelajaran</span>
                        <span class="badge bg-info">{{ $classStats['total_subjects'] ?? 0 }}</span>
                    </div>
                @endif
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>Masa Belajar</span>
                    <span class="badge bg-warning">
                        {{ $learner->enrollment_date ? $learner->enrollment_date->diffForHumans() : 'Belum diisi' }}
                    </span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Login Terakhir</span>
                    <span class="badge bg-secondary">
                        {{ $learner->user && $learner->user->last_login_at ? $learner->user->last_login_at->diffForHumans() : 'Belum pernah' }}
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
                        <p class="mb-0 fw-bold">{{ $learner->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">NIS</label>
                        <p class="mb-0"><code>{{ $learner->student_id ?? 'Belum diisi' }}</code></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Email</label>
                        <p class="mb-0">
                            <a href="mailto:{{ $learner->email }}" class="text-decoration-none">
                                {{ $learner->email }}
                            </a>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">No. Telepon</label>
                        <p class="mb-0">
                            @if($learner->phone)
                                <a href="tel:{{ $learner->phone }}" class="text-decoration-none">
                                    {{ $learner->phone }}
                                </a>
                            @else
                                <span class="text-muted">Belum diisi</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Jenis Kelamin</label>
                        <p class="mb-0">
                            @if($learner->gender)
                                <span class="badge bg-{{ $learner->gender === 'L' ? 'primary' : 'pink' }} px-3 py-2">
                                    {{ $learner->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            @else
                                <span class="text-muted">Belum diisi</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Tanggal Lahir</label>
                        <p class="mb-0">{{ $learner->birth_date ? $learner->birth_date->format('d F Y') : 'Belum diisi' }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label text-muted">Alamat</label>
                        <p class="mb-0">{{ $learner->address ?? 'Belum diisi' }}</p>
                    </div>
                    @if($learner->bio)
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted">Bio</label>
                            <p class="mb-0">{{ $learner->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Academic Information -->
        <div class="admin-card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-graduation-cap me-2"></i>Informasi Akademik
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($learner->schoolClass)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Kelas</label>
                            <p class="mb-0">
                                <span class="badge bg-primary px-3 py-2">{{ $learner->schoolClass->name }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Tingkat</label>
                            <p class="mb-0">
                                <span class="badge bg-success px-3 py-2">Kelas {{ $learner->schoolClass->grade }}</span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Jurusan</label>
                            <p class="mb-0">
                                <span class="badge bg-info px-3 py-2">{{ $learner->schoolClass->major ?? 'Umum' }}</span>
                            </p>
                        </div>
                    @endif
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Tanggal Masuk</label>
                        <p class="mb-0">{{ $learner->enrollment_date ? $learner->enrollment_date->format('d F Y') : 'Belum diisi' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Status</label>
                        <p class="mb-0">
                            @if($learner->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Parent Information -->
        <div class="admin-card mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-users me-2"></i>Informasi Orang Tua
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Nama Orang Tua</label>
                        <p class="mb-0">{{ $learner->parent_name ?? 'Belum diisi' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">No. Telepon Orang Tua</label>
                        <p class="mb-0">
                            @if($learner->parent_phone)
                                <a href="tel:{{ $learner->parent_phone }}" class="text-decoration-none">
                                    {{ $learner->parent_phone }}
                                </a>
                            @else
                                <span class="text-muted">Belum diisi</span>
                            @endif
                        </p>
                    </div>
                    @if($learner->emergency_contact_name)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Kontak Darurat</label>
                            <p class="mb-0">{{ $learner->emergency_contact_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">No. Kontak Darurat</label>
                            <p class="mb-0">
                                @if($learner->emergency_contact_phone)
                                    <a href="tel:{{ $learner->emergency_contact_phone }}" class="text-decoration-none">
                                        {{ $learner->emergency_contact_phone }}
                                    </a>
                                @else
                                    <span class="text-muted">Belum diisi</span>
                                @endif
                            </p>
                        </div>
                    @endif
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
                            @if($learner->user && $learner->user->email_verified_at)
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i>Terverifikasi
                                </span>
                                <br><small class="text-muted">{{ $learner->user->email_verified_at->format('d M Y H:i') }}</small>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-clock me-1"></i>Belum Terverifikasi
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Akun Dibuat</label>
                        @if($learner->user)
                            <p class="mb-0">{{ $learner->user->created_at->format('d F Y H:i') }}</p>
                            <small class="text-muted">{{ $learner->user->created_at->diffForHumans() }}</small>
                        @else
                            <p class="mb-0"><span class="text-muted">Belum memiliki akun</span></p>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Login Terakhir</label>
                        <p class="mb-0">
                            @if($learner->user && $learner->user->last_login_at)
                                {{ $learner->user->last_login_at->format('d M Y H:i') }}
                                <br><small class="text-muted">{{ $learner->user->last_login_at->diffForHumans() }}</small>
                            @else
                                <span class="text-muted">Belum pernah login</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Role</label>
                        <p class="mb-0">
                            <span class="badge bg-info px-3 py-2">
                                <i class="fas fa-graduation-cap me-1"></i>Siswa/Learner
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">Password Login</label>
                        @if($learner->user && $learner->user->plain_password)
                            <div class="d-flex align-items-center">
                                <code class="password-field me-2" data-password="{{ $learner->user->plain_password }}">
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
                        <small class="text-muted">Tindakan yang dapat dilakukan untuk siswa ini</small>
                    </div>
                    <div class="d-flex gap-2">
                        @if($learner->user)
                            <button class="btn btn-outline-info btn-sm" onclick="resetPassword()">
                                <i class="fas fa-key me-1"></i>Reset Password
                            </button>
                        @endif
                        <button class="btn btn-outline-warning btn-sm" onclick="toggleStatus()">
                            <i class="fas fa-toggle-on me-1"></i>
                            {{ $learner->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                        <button class="btn btn-outline-danger btn-sm" onclick="deleteStudent()">
                            <i class="fas fa-trash me-1"></i>Hapus Siswa
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
    @if($learner->user)
        window.location.href = '{{ route("admin.users.passwords") }}';
    @else
        alert('Siswa belum memiliki akun login');
    @endif
}

function toggleStatus() {
    const action = {{ $learner->is_active ? 'false' : 'true' }};
    const text = action ? 'mengaktifkan' : 'menonaktifkan';
    
    if (confirm(`Apakah Anda yakin ingin ${text} siswa {{ $learner->name }}?`)) {
        alert('Fitur toggle status akan segera tersedia');
    }
}

function deleteStudent() {
    if (confirm('Apakah Anda yakin ingin menghapus siswa {{ $learner->name }}? Tindakan ini tidak dapat dibatalkan.')) {
        // Redirect to delete
        window.location.href = '{{ route("admin.learners.index") }}';
    }
}
</script>
@endsection