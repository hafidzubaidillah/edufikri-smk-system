@extends('layouts.teacher')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="teacher-profile-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-2">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        Selamat Datang, {{ Auth::user()->name }}
                    </h3>
                    <p class="mb-0">Portal Guru SMK IT Ihsanul Fikri - Kelola pembelajaran dengan mudah dan efisien</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="teacher-badge">
                        <i class="fas fa-graduation-cap me-1"></i>
                        Status: Guru Aktif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="teacher-card text-center">
            <div class="card-body">
                <i class="fas fa-users text-success display-6 mb-2"></i>
                <h6 class="card-title">Siswa Aktif</h6>
                <h4 class="text-success">-</h4>
                <small class="text-muted">Total siswa</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="teacher-card text-center">
            <div class="card-body">
                <i class="fas fa-chalkboard text-primary display-6 mb-2"></i>
                <h6 class="card-title">Kelas Diampu</h6>
                <h4 class="text-primary">-</h4>
                <small class="text-muted">Kelas aktif</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="teacher-card text-center">
            <div class="card-body">
                <i class="fas fa-clipboard-check text-warning display-6 mb-2"></i>
                <h6 class="card-title">Absensi Hari Ini</h6>
                <h4 class="text-warning">-</h4>
                <small class="text-muted">Siswa hadir</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="teacher-card text-center">
            <div class="card-body">
                <i class="fas fa-tasks text-info display-6 mb-2"></i>
                <h6 class="card-title">Tugas Pending</h6>
                <h4 class="text-info">-</h4>
                <small class="text-muted">Belum dinilai</small>
            </div>
        </div>
    </div>
</div>

<!-- Main Features -->
<div class="row g-4">
    <!-- Attendance Management -->
    <div class="col-md-4">
        <div class="teacher-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-calendar-check text-primary display-4 mb-3"></i>
                <h5 class="card-title">Kelola Absensi</h5>
                <p class="card-text">Catat kehadiran siswa dan lihat rekap absensi kelas Anda</p>
                <a href="{{ route('admin.attendance.index') }}" class="teacher-btn-primary w-100">
                    <i class="fas fa-clipboard-check me-2"></i>Buka Absensi
                </a>
            </div>
        </div>
    </div>

    <!-- Profile Management -->
    <div class="col-md-4">
        <div class="teacher-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-user-edit text-success display-4 mb-3"></i>
                <h5 class="card-title">Profil Saya</h5>
                <p class="card-text">Perbarui informasi pribadi dan pengaturan akun Anda</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-success w-100">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
            </div>
        </div>
    </div>

    <!-- Announcements -->
    <div class="col-md-4">
        <div class="teacher-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-bullhorn text-warning display-4 mb-3"></i>
                <h5 class="card-title">Pengumuman</h5>
                <p class="card-text">Buat pengumuman untuk siswa dan lihat info terbaru dari sekolah</p>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-warning w-100">
                    <i class="fas fa-megaphone me-2"></i>Kelola Pengumuman
                </a>
            </div>
        </div>
    </div>

    <!-- Class Management -->
    <div class="col-md-4">
        <div class="teacher-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-chalkboard text-info display-4 mb-3"></i>
                <h5 class="card-title">Kelas Saya</h5>
                <p class="card-text">Kelola kelas yang Anda ampu dan lihat data siswa</p>
                <a href="#" class="btn btn-outline-info w-100" onclick="alert('Fitur dalam pengembangan')">
                    <i class="fas fa-users me-2"></i>Lihat Kelas
                </a>
            </div>
        </div>
    </div>

    <!-- Grade Management -->
    <div class="col-md-4">
        <div class="teacher-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-clipboard-list text-purple display-4 mb-3"></i>
                <h5 class="card-title">Input Nilai</h5>
                <p class="card-text">Input dan kelola nilai siswa untuk mata pelajaran yang Anda ampu</p>
                <a href="#" class="btn btn-outline-secondary w-100" onclick="alert('Fitur dalam pengembangan')">
                    <i class="fas fa-trophy me-2"></i>Kelola Nilai
                </a>
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div class="col-md-4">
        <div class="teacher-card h-100">
            <div class="card-body text-center">
                <i class="fas fa-envelope text-danger display-4 mb-3"></i>
                <h5 class="card-title">Pesan</h5>
                <p class="card-text">Komunikasi dengan siswa, orang tua, dan sesama guru</p>
                <a href="#" class="btn btn-outline-danger w-100" onclick="alert('Fitur dalam pengembangan')">
                    <i class="fas fa-comments me-2"></i>Buka Pesan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="row mt-4">
    <div class="col-12">
        <div class="teacher-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-history me-2"></i>Aktivitas Terbaru
                </h6>
            </div>
            <div class="card-body">
                <div class="text-center py-4">
                    <i class="fas fa-clock display-4 text-muted mb-3"></i>
                    <h6 class="text-muted">Belum Ada Aktivitas</h6>
                    <p class="text-muted">Aktivitas terbaru akan muncul di sini</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
