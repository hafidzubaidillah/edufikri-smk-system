@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">🔍 Jelajahi Kursus</h2>
                    <p class="text-muted mb-0">Temukan mata pelajaran dan kursus yang tersedia</p>
                </div>
                <a href="{{ route('learner.courses') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Kursus Saya
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Cari mata pelajaran...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Semua Kategori</option>
                                <option>Matematika & Sains</option>
                                <option>Bahasa</option>
                                <option>Teknologi</option>
                                <option>Sosial</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Semua Tingkat</option>
                                <option>Kelas X</option>
                                <option>Kelas XI</option>
                                <option>Kelas XII</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Categories -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm category-card">
                <div class="card-body">
                    <i class="fas fa-calculator text-primary display-5 mb-2"></i>
                    <h6 class="card-title">Matematika & Sains</h6>
                    <small class="text-muted">8 mata pelajaran</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm category-card">
                <div class="card-body">
                    <i class="fas fa-language text-success display-5 mb-2"></i>
                    <h6 class="card-title">Bahasa</h6>
                    <small class="text-muted">4 mata pelajaran</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm category-card">
                <div class="card-body">
                    <i class="fas fa-laptop-code text-info display-5 mb-2"></i>
                    <h6 class="card-title">Teknologi</h6>
                    <small class="text-muted">6 mata pelajaran</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm category-card">
                <div class="card-body">
                    <i class="fas fa-users text-warning display-5 mb-2"></i>
                    <h6 class="card-title">Sosial</h6>
                    <small class="text-muted">5 mata pelajaran</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Courses -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>Mata Pelajaran Tersedia
                    </h6>
                </div>
                <div class="card-body p-0">
                    @if($availableCourses->count() > 0)
                        <div class="row g-0">
                            @foreach($availableCourses as $course)
                            <div class="col-md-6">
                                <div class="border-end border-bottom p-4 h-100 course-item">
                                    <div class="d-flex align-items-start">
                                        <div class="course-icon me-3">
                                            <i class="fas fa-{{ ['book', 'calculator', 'globe', 'laptop', 'flask', 'paint-brush'][array_rand(['book', 'calculator', 'globe', 'laptop', 'flask', 'paint-brush'])] }} text-primary display-6"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-2">{{ $course->title }}</h6>
                                            <p class="text-muted small mb-2">{{ $course->description }}</p>
                                            <div class="mb-2">
                                                <span class="badge bg-light text-dark me-1">
                                                    <i class="fas fa-clock me-1"></i>{{ $course->duration }}
                                                </span>
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-signal me-1"></i>{{ $course->level }}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-user me-1"></i>{{ $course->instructor }}
                                                </small>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-plus me-1"></i>Daftar
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
                            <i class="fas fa-search display-4 text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak Ada Kursus</h5>
                            <p class="text-muted">Belum ada mata pelajaran yang tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Popular Courses -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-fire me-2"></i>Kursus Populer
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-laptop-code text-primary display-5 mb-2"></i>
                                    <h6>Pemrograman Web</h6>
                                    <small class="text-muted">HTML, CSS, JavaScript</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-network-wired text-success display-5 mb-2"></i>
                                    <h6>Jaringan Komputer</h6>
                                    <small class="text-muted">Cisco, Routing, Switching</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-database text-info display-5 mb-2"></i>
                                    <h6>Basis Data</h6>
                                    <small class="text-muted">MySQL, PostgreSQL</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.category-card:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}
.course-item:hover {
    background-color: #f8f9fa;
}
.course-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(13, 110, 253, 0.1);
    border-radius: 10px;
}
</style>
@endsection