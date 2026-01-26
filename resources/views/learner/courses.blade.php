@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">📚 Kursus Saya</h2>
                    <p class="text-muted mb-0">Mata pelajaran yang sedang Anda ikuti</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-book text-primary display-6 mb-2"></i>
                    <h6 class="card-title">Total Kursus</h6>
                    <h4 class="text-primary">{{ $courses->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-check-circle text-success display-6 mb-2"></i>
                    <h6 class="card-title">Selesai</h6>
                    <h4 class="text-success">2</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-clock text-warning display-6 mb-2"></i>
                    <h6 class="card-title">Berlangsung</h6>
                    <h4 class="text-warning">{{ $courses->count() - 2 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-percentage text-info display-6 mb-2"></i>
                    <h6 class="card-title">Progress</h6>
                    <h4 class="text-info">75%</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Course List -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Kursus
                    </h6>
                    <a href="{{ route('learner.browse-courses') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Jelajahi Kursus
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($courses->count() > 0)
                        @foreach($courses as $course)
                        <div class="border-bottom p-3 hover-bg">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center">
                                        <div class="course-icon me-3">
                                            <i class="fas fa-book-open text-primary display-6"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">{{ $course->title }}</h6>
                                            <p class="text-muted small mb-1">{{ $course->description }}</p>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-tie text-muted me-1"></i>
                                                <small class="text-muted">{{ $course->instructor }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="mb-2">
                                        <span class="badge bg-{{ $course->status == 'active' ? 'success' : 'warning' }}">
                                            {{ $course->status == 'active' ? 'Aktif' : 'Berlangsung' }}
                                        </span>
                                    </div>
                                    <div class="progress mb-2" style="height: 8px;">
                                        <div class="progress-bar" style="width: {{ $course->progress }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $course->progress }}% selesai</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book-open display-4 text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Kursus</h5>
                            <p class="text-muted">Anda belum terdaftar dalam kursus apapun</p>
                            <a href="{{ route('learner.browse-courses') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Jelajahi Kursus
                            </a>
                        </div>
                    @endif
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
                            <a href="{{ route('learner.progress') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-chart-line me-2"></i>Lihat Progress
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.certificates') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-certificate me-2"></i>Sertifikat
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.schedule') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-calendar me-2"></i>Jadwal
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.grades') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-trophy me-2"></i>Nilai
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-bg:hover {
    background-color: #f8f9fa;
}
.course-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(13, 110, 253, 0.1);
    border-radius: 12px;
}
</style>
@endsection