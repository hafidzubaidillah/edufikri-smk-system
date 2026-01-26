@extends('layouts.admin')

@section('title', 'Kelola Kelas - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .class-card {
        transition: all 0.3s ease;
        border-left: 4px solid #1a5f1a;
    }
    .class-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .major-badge {
        font-size: 0.875rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
    }
    .grade-badge {
        font-size: 1rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
    }
    .stats-card {
        background: linear-gradient(135deg, #1a5f1a, #ffc107);
        color: white;
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
                            <i class="fas fa-chalkboard me-2"></i>Kelola Kelas
                        </h2>
                        <p class="mb-0">Manajemen kelas dan distribusi siswa SMK IT Ihsanul Fikri</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.classes.create') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-plus me-2"></i>Tambah Kelas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-chalkboard-teacher text-primary display-6 mb-2"></i>
                <h5 class="card-title">Total Kelas</h5>
                <h3 class="text-primary">{{ $classStats['total_classes'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-users text-success display-6 mb-2"></i>
                <h5 class="card-title">Total Siswa</h5>
                <h3 class="text-success">{{ $classStats['total_students'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-layer-group text-warning display-6 mb-2"></i>
                <h5 class="card-title">Kelas X</h5>
                <h3 class="text-warning">{{ $classStats['grade_10'] }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-graduation-cap text-info display-6 mb-2"></i>
                <h5 class="card-title">Rata-rata/Kelas</h5>
                <h3 class="text-info">{{ $classStats['total_classes'] > 0 ? round($classStats['total_students'] / $classStats['total_classes']) : 0 }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Filter and Search -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Filter Kelas</h6>
                <div class="row g-2">
                    <div class="col-md-4">
                        <select class="form-select" id="filterGrade">
                            <option value="">Semua Tingkat</option>
                            <option value="10">Kelas X</option>
                            <option value="11">Kelas XI</option>
                            <option value="12">Kelas XII</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select class="form-select" id="filterMajor">
                            <option value="">Semua Jurusan</option>
                            <option value="TJKT">TJKT - Teknik Jaringan Komputer dan Telekomunikasi</option>
                            <option value="PPLG">PPLG - Pengembangan Perangkat Lunak dan Gim</option>
                            <option value="TKR">TKR - Teknik Kendaraan Ringan</option>
                            <option value="TSM">TSM - Teknik Sepeda Motor</option>
                            <option value="AKL">AKL - Akuntansi dan Keuangan Lembaga</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100" onclick="filterClasses()">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Distribusi Jurusan</h6>
                <div class="row g-2">
                    @foreach($classStats['majors'] as $major => $count)
                    <div class="col">
                        <span class="badge bg-primary w-100 p-2">
                            {{ $major }}: {{ $count }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Classes Grid -->
<div class="row" id="classesGrid">
    @foreach($classes->groupBy('grade') as $grade => $gradeClasses)
    <div class="col-12 mb-4">
        <h4 class="mb-3">
            <span class="grade-badge bg-primary">
                Kelas {{ $grade == 10 ? 'X' : ($grade == 11 ? 'XI' : 'XII') }}
            </span>
        </h4>
        
        <div class="row g-3">
            @foreach($gradeClasses->groupBy('major') as $major => $majorClasses)
                @foreach($majorClasses as $class)
                <div class="col-md-4 col-lg-3 class-item" data-grade="{{ $class->grade }}" data-major="{{ $class->major }}">
                    <div class="card class-card h-100">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">{{ $class->name }}</h6>
                                <span class="major-badge bg-{{ $major == 'TJKT' ? 'primary' : ($major == 'PPLG' ? 'success' : ($major == 'TKR' ? 'danger' : ($major == 'TSM' ? 'warning' : 'info'))) }}">
                                    {{ $major }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <div class="border-end">
                                        <h5 class="text-success mb-0">{{ $class->current_students }}</h5>
                                        <small class="text-muted">Siswa</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5 class="text-primary mb-0">{{ $class->subjects->count() }}</h5>
                                    <small class="text-muted">Mapel</small>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">Wali Kelas:</small>
                                <div class="fw-semibold">{{ $class->homeroom_teacher ?? 'Belum ditentukan' }}</div>
                            </div>
                            
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-success" 
                                     style="width: {{ ($class->current_students / $class->capacity) * 100 }}%">
                                </div>
                            </div>
                            <small class="text-muted">
                                {{ $class->current_students }}/{{ $class->capacity }} siswa 
                                ({{ round(($class->current_students / $class->capacity) * 100) }}%)
                            </small>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('admin.classes.show', $class) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-users"></i> Siswa
                                </a>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.classes.edit', $class) }}">
                                            <i class="fas fa-edit me-2"></i>Edit Kelas
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus kelas ini?')" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i>Hapus Kelas
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
    @endforeach
</div>

@if($classes->isEmpty())
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-chalkboard display-1 text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Kelas</h4>
                <p class="text-muted">Silakan tambahkan kelas baru untuk memulai.</p>
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Kelas Pertama
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
function filterClasses() {
    const grade = document.getElementById('filterGrade').value;
    const major = document.getElementById('filterMajor').value;
    const classItems = document.querySelectorAll('.class-item');
    
    classItems.forEach(item => {
        const itemGrade = item.getAttribute('data-grade');
        const itemMajor = item.getAttribute('data-major');
        
        let show = true;
        
        if (grade && itemGrade !== grade) {
            show = false;
        }
        
        if (major && itemMajor !== major) {
            show = false;
        }
        
        if (show) {
            item.style.display = 'block';
            item.classList.add('fade-in');
        } else {
            item.style.display = 'none';
            item.classList.remove('fade-in');
        }
    });
}

// Animation for cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.class-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        }, index * 50);
    });
});
</script>
@endpush