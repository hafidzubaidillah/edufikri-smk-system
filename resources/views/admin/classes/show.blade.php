@extends('layouts.admin')

@section('title', 'Detail Kelas - ' . $class->name . ' - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .detail-card {
        border-left: 4px solid #1a5f1a;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stats-card {
        background: linear-gradient(135deg, #1a5f1a, #ffc107);
        color: white;
    }
    .subject-card {
        transition: all 0.3s ease;
        border-left: 4px solid #ffc107;
    }
    .subject-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
                            <i class="fas fa-chalkboard me-2"></i>Detail Kelas: {{ $class->name }}
                        </h2>
                        <p class="mb-0">Informasi lengkap kelas dan mata pelajaran</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="btn-group">
                            <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-light">
                                <i class="fas fa-users me-2"></i>Kelola Siswa
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

<!-- Class Information -->
<div class="row mb-4">
    <div class="col-lg-4">
        <div class="card detail-card h-100">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Kelas
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-muted">Nama Kelas</label>
                        <div class="fw-bold fs-5 text-primary">{{ $class->name }}</div>
                    </div>
                    
                    <div class="col-6">
                        <label class="form-label text-muted">Tingkat</label>
                        <div class="fw-semibold">Kelas {{ $class->grade_roman }}</div>
                    </div>
                    
                    <div class="col-6">
                        <label class="form-label text-muted">Jurusan</label>
                        <div class="fw-semibold">{{ $class->major }}</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Nama Lengkap Jurusan</label>
                        <div class="fw-semibold">
                            @switch($class->major)
                                @case('TJKT')
                                    Teknik Jaringan Komputer dan Telekomunikasi
                                    @break
                                @case('PPLG')
                                    Pengembangan Perangkat Lunak dan Gim
                                    @break
                                @case('TKR')
                                    Teknik Kendaraan Ringan
                                    @break
                                @case('TSM')
                                    Teknik Sepeda Motor
                                    @break
                                @case('AKL')
                                    Akuntansi dan Keuangan Lembaga
                                    @break
                            @endswitch
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <label class="form-label text-muted">Kapasitas</label>
                        <div class="fw-semibold">{{ $class->capacity }} siswa</div>
                    </div>
                    
                    <div class="col-6">
                        <label class="form-label text-muted">Siswa Saat Ini</label>
                        <div class="fw-semibold text-success">{{ $class->current_students }} siswa</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Progress Kapasitas</label>
                        <div class="progress mb-2" style="height: 20px;">
                            <div class="progress-bar bg-success" 
                                 style="width: {{ ($class->current_students / $class->capacity) * 100 }}%">
                                {{ round(($class->current_students / $class->capacity) * 100) }}%
                            </div>
                        </div>
                        <small class="text-muted">
                            Sisa {{ $class->capacity - $class->current_students }} slot
                        </small>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Wali Kelas</label>
                        <div class="fw-semibold">{{ $class->homeroom_teacher ?? 'Belum ditentukan' }}</div>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label text-muted">Tahun Ajaran</label>
                        <div class="fw-semibold">{{ $class->academic_year }}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-2"></i>Edit Kelas
                    </a>
                    <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-success">
                        <i class="fas fa-users me-2"></i>Kelola Siswa ({{ $class->current_students }})
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <!-- Statistics Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-users text-primary display-6 mb-2"></i>
                        <h5 class="card-title">Siswa</h5>
                        <h3 class="text-primary">{{ $class->learners->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-book text-success display-6 mb-2"></i>
                        <h5 class="card-title">Mata Pelajaran</h5>
                        <h3 class="text-success">{{ $class->subjects->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-male text-info display-6 mb-2"></i>
                        <h5 class="card-title">Laki-laki</h5>
                        <h3 class="text-info">{{ $class->learners->where('gender', 'L')->count() }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-female text-danger display-6 mb-2"></i>
                        <h5 class="card-title">Perempuan</h5>
                        <h3 class="text-danger">{{ $class->learners->where('gender', 'P')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Assigned Subjects -->
        <div class="card detail-card">
            <div class="card-header bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-book me-2"></i>Mata Pelajaran yang Diajarkan
                    </h5>
                    <span class="badge bg-primary">{{ $mandatorySubjects->count() + $optionalSubjects->count() }} mata pelajaran</span>
                </div>
            </div>
            <div class="card-body">
                <!-- Mandatory Subjects -->
                <div class="mb-4">
                    <h6 class="text-warning mb-3">
                        <i class="fas fa-star me-2"></i>Mata Pelajaran Wajib ({{ $mandatorySubjects->count() }})
                    </h6>
                    @if($mandatorySubjects->count() > 0)
                        <div class="row g-2">
                            @foreach($mandatorySubjects as $subject)
                            <div class="col-md-6">
                                <div class="card border-warning">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-1">{{ $subject->name }}</h6>
                                                <small class="text-muted">{{ $subject->code }}</small>
                                                <div class="mt-2">
                                                    <span class="badge bg-info">{{ $subject->hours_per_week }} jam/minggu</span>
                                                    <span class="badge bg-warning">Wajib</span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($subject->pivot->teacher_name)
                                            <div class="mt-2">
                                                <small class="text-muted">Guru: </small>
                                                <small class="fw-semibold">{{ $subject->pivot->teacher_name }}</small>
                                            </div>
                                        @endif
                                        @if($subject->pivot->schedule_day)
                                            <div class="mt-1">
                                                <small class="text-muted">Jadwal: </small>
                                                <small>{{ ucfirst($subject->pivot->schedule_day) }}
                                                @if($subject->pivot->start_time && $subject->pivot->end_time)
                                                    {{ $subject->pivot->start_time }} - {{ $subject->pivot->end_time }}
                                                @endif
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Belum ada mata pelajaran wajib yang ditugaskan ke kelas ini.
                        </div>
                    @endif
                </div>

                <!-- Optional Subjects -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-success mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Mata Pelajaran Tambahan ({{ $optionalSubjects->count() }})
                        </h6>
                        @if($availableSubjects->count() > 0)
                            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                                <i class="fas fa-plus me-1"></i>Tambah Mata Pelajaran
                            </button>
                        @endif
                    </div>
                    @if($optionalSubjects->count() > 0)
                        <div class="row g-2">
                            @foreach($optionalSubjects as $subject)
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-body p-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="card-title mb-1">{{ $subject->name }}</h6>
                                                <small class="text-muted">{{ $subject->code }}</small>
                                                <div class="mt-2">
                                                    <span class="badge bg-info">{{ $subject->hours_per_week }} jam/minggu</span>
                                                    <span class="badge bg-light text-dark">Tambahan</span>
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#" onclick="editSubjectAssignment({{ $subject->pivot->id ?? $subject->id }})">
                                                        <i class="fas fa-edit me-2"></i>Edit Jadwal
                                                    </a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#" onclick="removeSubjectAssignment({{ $subject->pivot->id ?? $subject->id }})">
                                                        <i class="fas fa-trash me-2"></i>Hapus
                                                    </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if($subject->pivot->teacher_name)
                                            <div class="mt-2">
                                                <small class="text-muted">Guru: </small>
                                                <small class="fw-semibold">{{ $subject->pivot->teacher_name }}</small>
                                            </div>
                                        @endif
                                        @if($subject->pivot->schedule_day)
                                            <div class="mt-1">
                                                <small class="text-muted">Jadwal: </small>
                                                <small>{{ ucfirst($subject->pivot->schedule_day) }}
                                                @if($subject->pivot->start_time && $subject->pivot->end_time)
                                                    {{ $subject->pivot->start_time }} - {{ $subject->pivot->end_time }}
                                                @endif
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Belum ada mata pelajaran tambahan. 
                            @if($availableSubjects->count() > 0)
                                <button class="btn btn-sm btn-success ms-2" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                                    Tambah Sekarang
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Available Subjects to Add -->
                @if($availableSubjects->count() > 0)
                <div>
                    <h6 class="text-muted mb-3">
                        <i class="fas fa-list me-2"></i>Mata Pelajaran yang Tersedia ({{ $availableSubjects->count() }})
                    </h6>
                    <div class="row g-2">
                        @foreach($availableSubjects->take(6) as $subject)
                        <div class="col-md-4">
                            <div class="card border-light">
                                <div class="card-body p-2">
                                    <small class="fw-semibold">{{ $subject->name }}</small>
                                    <br><small class="text-muted">{{ $subject->code }} - {{ $subject->hours_per_week }} jam/minggu</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($availableSubjects->count() > 6)
                        <div class="col-md-4">
                            <div class="card border-light">
                                <div class="card-body p-2 text-center">
                                    <small class="text-muted">+{{ $availableSubjects->count() - 6 }} mata pelajaran lainnya</small>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                </div>
            </div>
            <div class="card-body">
                @if($class->subjects->count() > 0)
                    <div class="row g-3">
                        @foreach($class->subjects as $subject)
                        <div class="col-md-6">
                            <div class="card subject-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="fw-bold mb-0">{{ $subject->name }}</h6>
                                        <span class="badge bg-secondary">{{ $subject->code }}</span>
                                    </div>
                                    
                                    <div class="row g-2 text-sm">
                                        <div class="col-6">
                                            <small class="text-muted">Kategori:</small>
                                            <div class="fw-semibold">{{ $subject->category_label }}</div>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Jam/Minggu:</small>
                                            <div class="fw-semibold">{{ $subject->hours_per_week }} jam</div>
                                        </div>
                                        
                                        @if($subject->pivot->teacher_name)
                                        <div class="col-12">
                                            <small class="text-muted">Guru:</small>
                                            <div class="fw-semibold">{{ $subject->pivot->teacher_name }}</div>
                                        </div>
                                        @endif
                                        
                                        @if($subject->pivot->schedule_day)
                                        <div class="col-6">
                                            <small class="text-muted">Hari:</small>
                                            <div class="fw-semibold">{{ $subject->pivot->schedule_day }}</div>
                                        </div>
                                        @endif
                                        
                                        @if($subject->pivot->room)
                                        <div class="col-6">
                                            <small class="text-muted">Ruang:</small>
                                            <div class="fw-semibold">{{ $subject->pivot->room }}</div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-book display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Mata Pelajaran</h5>
                        <p class="text-muted">Mata pelajaran belum diassign ke kelas ini.</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignSubjectsModal">
                            <i class="fas fa-plus me-2"></i>Assign Mata Pelajaran
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Available Subjects for Assignment -->
@if($subjects->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="card detail-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>Mata Pelajaran yang Tersedia untuk Kelas Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach($subjects as $subject)
                    <div class="col-md-4">
                        <div class="card border">
                            <div class="card-body">
                                <h6 class="fw-bold">{{ $subject->name }}</h6>
                                <div class="text-muted small">
                                    <div>Kode: {{ $subject->code }}</div>
                                    <div>Kategori: {{ $subject->category_label }}</div>
                                    <div>Jam/Minggu: {{ $subject->hours_per_week }}</div>
                                    @if($subject->majors)
                                        <div>Jurusan: {{ implode(', ', $subject->majors) }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#assignSubjectsModal">
                        <i class="fas fa-plus me-2"></i>Assign Mata Pelajaran ke Kelas
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Assign Subjects Modal -->
<div class="modal fade" id="assignSubjectsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Mata Pelajaran ke {{ $class->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.classes.assign-subjects', $class) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Pilih mata pelajaran yang akan diajarkan di kelas {{ $class->name }}
                    </div>
                    
                    @if($subjects->count() > 0)
                        @foreach($subjects as $subject)
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="subjects[]" 
                                   value="{{ $subject->id }}" id="subject{{ $subject->id }}">
                            <label class="form-check-label fw-bold" for="subject{{ $subject->id }}">
                                {{ $subject->name }} ({{ $subject->code }})
                            </label>
                            <div class="text-muted small">
                                {{ $subject->category_label }} • {{ $subject->hours_per_week }} jam/minggu
                                @if($subject->description)
                                    <br>{{ $subject->description }}
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted">Tidak ada mata pelajaran yang tersedia untuk kelas ini.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Assign Mata Pelajaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Animation for cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.subject-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        }, index * 100);
    });
});
</script>
@endpush

<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mata Pelajaran ke {{ $class->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addSubjectForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="class_id" value="{{ $class->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Mata Pelajaran</label>
                        <select name="subject_id" class="form-select" required>
                            <option value="">Pilih mata pelajaran...</option>
                            @foreach($availableSubjects as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ $subject->name }} ({{ $subject->code }}) - {{ $subject->hours_per_week }} jam/minggu
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Guru</label>
                        <input type="text" name="teacher_name" class="form-control" placeholder="Nama guru pengampu">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Guru</label>
                        <input type="email" name="teacher_email" class="form-control" placeholder="email@guru.com">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Hari</label>
                                <select name="schedule_day" class="form-select">
                                    <option value="">Pilih hari...</option>
                                    <option value="monday">Senin</option>
                                    <option value="tuesday">Selasa</option>
                                    <option value="wednesday">Rabu</option>
                                    <option value="thursday">Kamis</option>
                                    <option value="friday">Jumat</option>
                                    <option value="saturday">Sabtu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Jam Mulai</label>
                                <input type="time" name="start_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Jam Selesai</label>
                                <input type="time" name="end_time" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ruang</label>
                        <input type="text" name="room" class="form-control" placeholder="Contoh: Lab Komputer 1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah Mata Pelajaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Handle add subject form submission
    $('#addSubjectForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = $(this).serialize();
        
        $.ajax({
            url: '{{ route("admin.subjects.assign-to-class") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Mata pelajaran berhasil ditambahkan ke kelas!');
                location.reload();
            },
            error: function(xhr) {
                let error = xhr.responseJSON?.error || 'Terjadi kesalahan';
                alert('Error: ' + error);
            }
        });
    });
});

function editSubjectAssignment(assignmentId) {
    // Implementation for editing subject assignment
    alert('Fitur edit jadwal akan segera tersedia');
}

function removeSubjectAssignment(assignmentId) {
    if (confirm('Yakin ingin menghapus mata pelajaran ini dari kelas?')) {
        // Implementation for removing subject assignment
        alert('Fitur hapus mata pelajaran akan segera tersedia');
    }
}
</script>