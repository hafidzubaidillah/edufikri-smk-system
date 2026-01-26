@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">📊 Progress Belajar</h2>
                    <p class="text-muted mb-0">Pantau perkembangan akademik Anda</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Overall Progress -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-3">Progress Keseluruhan</h5>
                            <div class="progress mb-3" style="height: 15px;">
                                <div class="progress-bar bg-warning" style="width: {{ $progressData->overall_progress }}%"></div>
                            </div>
                            <p class="mb-0">{{ $progressData->overall_progress }}% dari total pembelajaran selesai</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <i class="fas fa-chart-line display-4 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-book-open text-primary display-6 mb-2"></i>
                    <h6 class="card-title">Kursus Selesai</h6>
                    <h4 class="text-primary">{{ $progressData->completed_courses }}</h4>
                    <small class="text-muted">dari {{ $progressData->active_courses + $progressData->completed_courses }} total</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-certificate text-success display-6 mb-2"></i>
                    <h6 class="card-title">Sertifikat</h6>
                    <h4 class="text-success">{{ $progressData->certificates_earned }}</h4>
                    <small class="text-muted">diperoleh</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-clock text-warning display-6 mb-2"></i>
                    <h6 class="card-title">Jam Belajar</h6>
                    <h4 class="text-warning">{{ $progressData->study_hours }}</h4>
                    <small class="text-muted">total jam</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-trophy text-info display-6 mb-2"></i>
                    <h6 class="card-title">Ranking Kelas</h6>
                    <h4 class="text-info">5</h4>
                    <small class="text-muted">dari 30 siswa</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress by Subject -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Progress per Mata Pelajaran
                    </h6>
                </div>
                <div class="card-body">
                    @php
                    $subjects = [
                        ['name' => 'Matematika', 'progress' => 85, 'color' => 'primary'],
                        ['name' => 'Bahasa Indonesia', 'progress' => 92, 'color' => 'success'],
                        ['name' => 'Bahasa Inggris', 'progress' => 78, 'color' => 'info'],
                        ['name' => 'Pemrograman Web', 'progress' => 95, 'color' => 'warning'],
                        ['name' => 'Jaringan Komputer', 'progress' => 70, 'color' => 'danger'],
                        ['name' => 'Basis Data', 'progress' => 88, 'color' => 'secondary'],
                    ];
                    @endphp

                    @foreach($subjects as $subject)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="mb-0">{{ $subject['name'] }}</h6>
                            <span class="badge bg-{{ $subject['color'] }}">{{ $subject['progress'] }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-{{ $subject['color'] }}" style="width: {{ $subject['progress'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-history me-2"></i>Aktivitas Terbaru
                    </h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Tugas Matematika Selesai</h6>
                                <small class="text-muted">2 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Mengikuti Kuis Bahasa Inggris</h6>
                                <small class="text-muted">1 hari yang lalu</small>
                            </div>
                        </div>
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Sertifikat Pemrograman Diperoleh</h6>
                                <small class="text-muted">3 hari yang lalu</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Bergabung dengan Kelas Jaringan</h6>
                                <small class="text-muted">1 minggu yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-target me-2"></i>Target Pembelajaran
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="mb-2">Target Mingguan</h6>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: 80%"></div>
                        </div>
                        <small class="text-muted">4 dari 5 tugas selesai</small>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="mb-2">Target Bulanan</h6>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-primary" style="width: 65%"></div>
                        </div>
                        <small class="text-muted">13 dari 20 materi dipelajari</small>
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="mb-2">Target Semester</h6>
                        <div class="progress mb-2" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                        <small class="text-muted">9 dari 20 kompetensi tercapai</small>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Atur Target Baru
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
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
                            <a href="{{ route('learner.courses') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-book me-2"></i>Lihat Kursus
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.certificates') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-certificate me-2"></i>Sertifikat
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.grades') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-trophy me-2"></i>Nilai
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('learner.schedule') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-calendar me-2"></i>Jadwal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}
.timeline {
    position: relative;
    padding-left: 30px;
}
.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}
.timeline-item {
    position: relative;
}
.timeline-marker {
    position: absolute;
    left: -23px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #dee2e6;
}
</style>
@endsection