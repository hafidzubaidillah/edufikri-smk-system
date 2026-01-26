@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">🏆 Sertifikat</h2>
                    <p class="text-muted mb-0">Koleksi sertifikat dan penghargaan Anda</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-certificate text-primary display-6 mb-2"></i>
                    <h6 class="card-title">Total Sertifikat</h6>
                    <h4 class="text-primary">{{ $certificates->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-medal text-warning display-6 mb-2"></i>
                    <h6 class="card-title">Prestasi Terbaik</h6>
                    <h4 class="text-warning">A+</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-calendar text-success display-6 mb-2"></i>
                    <h6 class="card-title">Bulan Ini</h6>
                    <h4 class="text-success">1</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-download text-info display-6 mb-2"></i>
                    <h6 class="card-title">Diunduh</h6>
                    <h4 class="text-info">{{ $certificates->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Certificates Grid -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Sertifikat
                    </h6>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary active">
                            <i class="fas fa-th-large me-1"></i>Grid
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-list me-1"></i>List
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @if($certificates->count() > 0)
                        <div class="row g-4">
                            @foreach($certificates as $certificate)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm certificate-card">
                                    <div class="card-body">
                                        <!-- Certificate Preview -->
                                        <div class="certificate-preview mb-3">
                                            <div class="certificate-content">
                                                <div class="text-center p-4 bg-gradient-gold text-white">
                                                    <i class="fas fa-certificate display-4 mb-2"></i>
                                                    <h6 class="mb-1">SERTIFIKAT</h6>
                                                    <small>SMK IT Ihsanul Fikri</small>
                                                </div>
                                                <div class="p-3 bg-light">
                                                    <h6 class="text-center mb-2">{{ $certificate['title'] }}</h6>
                                                    <p class="text-center small text-muted mb-2">
                                                        Diberikan kepada<br>
                                                        <strong>{{ $learner->name }}</strong>
                                                    </p>
                                                    <p class="text-center small text-muted">
                                                        Mata Pelajaran: {{ $certificate['course'] }}<br>
                                                        Grade: <span class="badge bg-success">{{ $certificate['grade'] }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Certificate Info -->
                                        <div class="certificate-info">
                                            <h6 class="mb-2">{{ $certificate['title'] }}</h6>
                                            <p class="text-muted small mb-2">{{ $certificate['course'] }}</p>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i>
                                                    {{ \Carbon\Carbon::parse($certificate['issued_date'])->format('d M Y') }}
                                                </small>
                                                <span class="badge bg-{{ $certificate['grade'] == 'A+' ? 'warning' : 'success' }}">
                                                    {{ $certificate['grade'] }}
                                                </span>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download me-1"></i>Unduh PDF
                                                </button>
                                                <button class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-share me-1"></i>Bagikan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-certificate display-4 text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Sertifikat</h5>
                            <p class="text-muted mb-4">Selesaikan kursus untuk mendapatkan sertifikat</p>
                            <a href="{{ route('learner.courses') }}" class="btn btn-primary">
                                <i class="fas fa-book me-2"></i>Lihat Kursus
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Achievement Badges -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Lencana Prestasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <div class="text-center p-3 badge-item earned">
                                <i class="fas fa-star text-warning display-5 mb-2"></i>
                                <h6 class="small">Siswa Teladan</h6>
                                <small class="text-muted">Nilai rata-rata A</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 badge-item earned">
                                <i class="fas fa-clock text-success display-5 mb-2"></i>
                                <h6 class="small">Rajin Hadir</h6>
                                <small class="text-muted">Absensi 95%</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 badge-item">
                                <i class="fas fa-graduation-cap text-muted display-5 mb-2"></i>
                                <h6 class="small text-muted">Lulusan Terbaik</h6>
                                <small class="text-muted">Belum tercapai</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 badge-item">
                                <i class="fas fa-users text-muted display-5 mb-2"></i>
                                <h6 class="small text-muted">Kolaborator</h6>
                                <small class="text-muted">Belum tercapai</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 badge-item">
                                <i class="fas fa-lightbulb text-muted display-5 mb-2"></i>
                                <h6 class="small text-muted">Inovator</h6>
                                <small class="text-muted">Belum tercapai</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 badge-item">
                                <i class="fas fa-heart text-muted display-5 mb-2"></i>
                                <h6 class="small text-muted">Penolong</h6>
                                <small class="text-muted">Belum tercapai</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100">
                                <i class="fas fa-download me-2"></i>Unduh Semua
                            </button>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success w-100">
                                <i class="fas fa-share me-2"></i>Bagikan Portfolio
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.progress') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-chart-line me-2"></i>Lihat Progress
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-warning w-100">
                                <i class="fas fa-print me-2"></i>Cetak Sertifikat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-gold {
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%) !important;
}
.certificate-card {
    transition: all 0.3s ease;
}
.certificate-card:hover {
    transform: translateY(-5px);
}
.certificate-preview {
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #dee2e6;
}
.badge-item {
    border-radius: 8px;
    transition: all 0.3s ease;
}
.badge-item.earned {
    background: rgba(40, 167, 69, 0.1);
    border: 2px solid rgba(40, 167, 69, 0.2);
}
.badge-item:not(.earned) {
    background: rgba(108, 117, 125, 0.1);
    border: 2px solid rgba(108, 117, 125, 0.2);
}
</style>
@endsection