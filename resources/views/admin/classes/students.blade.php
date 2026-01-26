@extends('layouts.admin')

@section('title', 'Kelola Siswa - ' . $class->name . ' - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .student-card {
        transition: all 0.3s ease;
        border-left: 4px solid #1a5f1a;
    }
    .student-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
                            <i class="fas fa-users me-2"></i>Kelola Siswa: {{ $class->name }}
                        </h2>
                        <p class="mb-0">{{ $students->count() }} dari {{ $class->capacity }} siswa</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.classes.students.create', $class) }}" class="btn btn-light">
                                <i class="fas fa-user-plus me-2"></i>Tambah Siswa
                            </a>
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-light">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
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
                <i class="fas fa-users text-primary display-6 mb-2"></i>
                <h5 class="card-title">Total Siswa</h5>
                <h3 class="text-primary">{{ $students->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-male text-info display-6 mb-2"></i>
                <h5 class="card-title">Laki-laki</h5>
                <h3 class="text-info">{{ $students->where('gender', 'L')->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-female text-danger display-6 mb-2"></i>
                <h5 class="card-title">Perempuan</h5>
                <h3 class="text-danger">{{ $students->where('gender', 'P')->count() }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center border-0 shadow-sm">
            <div class="card-body">
                <i class="fas fa-chair text-warning display-6 mb-2"></i>
                <h5 class="card-title">Sisa Kapasitas</h5>
                <h3 class="text-warning">{{ $class->capacity - $students->count() }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="searchStudent" placeholder="Cari nama atau NIS siswa...">
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterGender">
                            <option value="">Semua Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" onclick="filterStudents()">
                            <i class="fas fa-search me-1"></i>Cari
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title">Kapasitas Kelas</h6>
                <div class="progress mb-2" style="height: 20px;">
                    <div class="progress-bar bg-success" style="width: {{ ($students->count() / $class->capacity) * 100 }}%">
                        {{ round(($students->count() / $class->capacity) * 100) }}%
                    </div>
                </div>
                <small class="text-muted">{{ $students->count() }}/{{ $class->capacity }} siswa</small>
            </div>
        </div>
    </div>
</div>

<!-- Students List -->
@if($students->count() > 0)
<div class="row" id="studentsGrid">
    @foreach($students as $student)
    <div class="col-md-6 col-lg-4 mb-3 student-item" 
         data-name="{{ strtolower($student->name) }}" 
         data-nis="{{ strtolower($student->student_id) }}"
         data-gender="{{ $student->gender }}">
        <div class="card student-card h-100">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold">{{ $student->name }}</h6>
                    <span class="badge bg-{{ $student->gender == 'L' ? 'info' : 'danger' }}">
                        {{ $student->gender == 'L' ? 'L' : 'P' }}
                    </span>
                </div>
                <small class="text-muted">NIS: {{ $student->student_id }}</small>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <small class="text-muted">Email:</small>
                    <div class="fw-semibold">{{ $student->email }}</div>
                </div>
                
                @if($student->user_id)
                <div class="mb-2">
                    <small class="text-muted">Status Login:</small>
                    <div>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>Akun Aktif
                        </span>
                    </div>
                    <small class="text-muted">Username: {{ explode('@', $student->email)[0] }}</small>
                </div>
                @else
                <div class="mb-2">
                    <small class="text-muted">Status Login:</small>
                    <div>
                        <span class="badge bg-warning">
                            <i class="fas fa-exclamation-triangle me-1"></i>Belum Ada Akun
                        </span>
                    </div>
                </div>
                @endif
                
                @if($student->birth_date)
                <div class="mb-2">
                    <small class="text-muted">Tanggal Lahir:</small>
                    <div>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</div>
                </div>
                @endif
                
                <div class="mb-2">
                    <small class="text-muted">Alamat:</small>
                    <div class="text-truncate" title="{{ $student->address }}">{{ $student->address }}</div>
                </div>
                
                <div class="mb-2">
                    <small class="text-muted">Orang Tua:</small>
                    <div>{{ $student->parent_name }}</div>
                    @if($student->parent_phone)
                    <small class="text-muted">{{ $student->parent_phone }}</small>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="btn-group w-100" role="group">
                    <a href="{{ route('admin.classes.students.edit', [$class, $student]) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.classes.students.destroy', [$class, $student]) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus siswa ini dari kelas?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-user-graduate display-1 text-muted mb-3"></i>
                <h4 class="text-muted">Belum Ada Siswa</h4>
                <p class="text-muted">Kelas ini belum memiliki siswa. Silakan tambahkan siswa baru.</p>
                <a href="{{ route('admin.classes.students.create', $class) }}" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Tambah Siswa Pertama
                </a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>
function filterStudents() {
    const search = document.getElementById('searchStudent').value.toLowerCase();
    const gender = document.getElementById('filterGender').value;
    const studentItems = document.querySelectorAll('.student-item');
    
    studentItems.forEach(item => {
        const name = item.getAttribute('data-name');
        const nis = item.getAttribute('data-nis');
        const studentGender = item.getAttribute('data-gender');
        
        let show = true;
        
        if (search && !name.includes(search) && !nis.includes(search)) {
            show = false;
        }
        
        if (gender && studentGender !== gender) {
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

// Real-time search
document.getElementById('searchStudent').addEventListener('input', filterStudents);

// Animation for cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.student-card');
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