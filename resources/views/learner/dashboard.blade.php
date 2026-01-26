@extends('layouts.student')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="student-profile-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="mb-2">👋 Halo, {{ Auth::user()->name }}!</h3>
                    <p class="mb-1">Selamat datang di portal siswa EDUFIKRI</p>
                    @if(Auth::user()->learner)
                        <small class="opacity-75">
                            Kelas: {{ Auth::user()->learner->section }} | 
                            NIS: {{ Auth::user()->learner->student_id }}
                        </small>
                    @endif
                </div>
                <div class="col-md-4 text-end">
                    <i class="fas fa-graduation-cap display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Stats -->
@if(Auth::user()->learner)
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-id-card text-primary display-6 mb-2"></i>
                <h6 class="card-title">NIS</h6>
                <h5 class="text-primary">{{ Auth::user()->learner->student_id }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-chalkboard text-success display-6 mb-2"></i>
                <h6 class="card-title">Kelas</h6>
                <h5 class="text-success">{{ Auth::user()->learner->section }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-calendar text-warning display-6 mb-2"></i>
                <h6 class="card-title">Tingkat</h6>
                <h5 class="text-warning">Kelas {{ Auth::user()->learner->grade_level == 10 ? 'X' : (Auth::user()->learner->grade_level == 11 ? 'XI' : 'XII') }}</h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-check-circle text-info display-6 mb-2"></i>
                <h6 class="card-title">Status</h6>
                <h5 class="text-info">{{ Auth::user()->learner->is_active ? 'Aktif' : 'Tidak Aktif' }}</h5>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Main Features -->
<div class="row g-4">
    <!-- Kelas Saya -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-warning bg-opacity-10">
                <i class="fas fa-chalkboard text-warning"></i>
            </div>
            <h5 class="card-title">Kelas Saya</h5>
            <p class="card-text">Lihat informasi kelas dan teman sekelas</p>
            <a href="{{ route('learner.my-class') }}" class="student-btn-primary w-100">
                <i class="fas fa-users me-2"></i>Buka Kelas
            </a>
            @if(Auth::user()->learner)
            <div class="mt-2">
                <span class="badge bg-warning">{{ Auth::user()->learner->section }}</span>
            </div>
            @endif
        </div>
    </div>

    <!-- Kursus Saya -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-primary bg-opacity-10">
                <i class="fas fa-book text-primary"></i>
            </div>
            <h5 class="card-title">Kursus Saya</h5>
            <p class="card-text">Lihat mata pelajaran yang sedang Anda ikuti</p>
            <a href="{{ route('learner.courses') }}" class="btn btn-outline-primary w-100">
                <i class="fas fa-arrow-right me-2"></i>Buka Kursus
            </a>
            <div class="mt-2">
                <span class="badge bg-primary">3</span>
            </div>
        </div>
    </div>

    <!-- Jelajahi Kursus -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-success bg-opacity-10">
                <i class="fas fa-search text-success"></i>
            </div>
            <h5 class="card-title">Jelajahi Kursus</h5>
            <p class="card-text">Temukan mata pelajaran dan kursus baru</p>
            <a href="{{ route('learner.browse-courses') }}" class="btn btn-outline-success w-100">
                <i class="fas fa-compass me-2"></i>Jelajahi
            </a>
        </div>
    </div>

    <!-- Materi Pembelajaran -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-info bg-opacity-10">
                <i class="fas fa-book-open text-info"></i>
            </div>
            <h5 class="card-title">Materi Pembelajaran</h5>
            <p class="card-text">Akses materi, tugas, dan kuis dari guru</p>
            <a href="{{ route('learner.materials') }}" class="btn btn-outline-info w-100">
                <i class="fas fa-book-open me-2"></i>Lihat Materi
            </a>
        </div>
    </div>

    <!-- Progress -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-info bg-opacity-10">
                <i class="fas fa-chart-line text-info"></i>
            </div>
            <h5 class="card-title">Progress</h5>
            <p class="card-text">Pantau perkembangan belajar Anda</p>
            <a href="{{ route('learner.progress') }}" class="btn btn-outline-info w-100">
                <i class="fas fa-analytics me-2"></i>Lihat Progress
            </a>
        </div>
    </div>

    <!-- Sertifikat -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-warning bg-opacity-10">
                <i class="fas fa-certificate text-warning"></i>
            </div>
            <h5 class="card-title">Sertifikat</h5>
            <p class="card-text">Lihat sertifikat yang telah Anda peroleh</p>
            <a href="{{ route('learner.certificates') }}" class="btn btn-outline-warning w-100">
                <i class="fas fa-award me-2"></i>Lihat Sertifikat
            </a>
            <div class="mt-2">
                <span class="badge bg-warning">2</span>
            </div>
        </div>
    </div>

    <!-- Komunitas -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-purple bg-opacity-10">
                <i class="fas fa-users text-purple"></i>
            </div>
            <h5 class="card-title">Komunitas</h5>
            <p class="card-text">Bergabung dengan diskusi dan forum</p>
            <a href="{{ route('learner.community') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-comments me-2"></i>Bergabung
            </a>
            <div class="mt-2">
                <span class="badge bg-danger rounded-pill">•</span>
            </div>
        </div>
    </div>

    <!-- Pesan -->
    <div class="col-md-4">
        <div class="student-menu-card">
            <div class="student-icon bg-danger bg-opacity-10">
                <i class="fas fa-envelope text-danger"></i>
            </div>
            <h5 class="card-title">Pesan</h5>
            <p class="card-text">Baca pesan dari guru dan admin</p>
            <a href="{{ route('learner.messages') }}" class="btn btn-outline-danger w-100">
                <i class="fas fa-inbox me-2"></i>Buka Pesan
            </a>
            <div class="mt-2">
                <span class="badge bg-danger">5</span>
            </div>
        </div>
    </div>
</div>

<!-- Additional Features -->
<div class="row g-4 mt-2">
    <!-- Absensi QR Code -->
    <div class="col-md-6">
        <div class="student-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h6 class="card-title mb-1">Absensi QR Code</h6>
                        <p class="card-text small text-muted">Scan QR untuk mencatat kehadiran</p>
                        <a href="{{ route('admin.attendance.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-qr-code me-1"></i>Scan Sekarang
                        </a>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-qr-code display-5 text-primary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaturan -->
    <div class="col-md-6">
        <div class="student-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h6 class="card-title mb-1">Pengaturan</h6>
                        <p class="card-text small text-muted">Kelola profil dan preferensi</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-cog me-1"></i>Buka Pengaturan
                        </a>
                    </div>
                    <div class="col-4 text-end">
                        <i class="fas fa-cog display-5 text-secondary opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-purple {
    color: #6f42c1 !important;
}
.bg-purple {
    background-color: #6f42c1 !important;
}
</style>
@endsection
