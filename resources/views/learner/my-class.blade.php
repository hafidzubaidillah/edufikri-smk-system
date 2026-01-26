@extends('layouts.student')

@section('title', 'Kelas Saya - ' . $class->name)

@section('content')

@push('styles')
<style>
    .class-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .subject-card {
        transition: all 0.3s ease;
        border-left: 4px solid #007bff;
        height: 100%;
    }
    .subject-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .mandatory-subject {
        border-left-color: #ffc107;
    }
    .optional-subject {
        border-left-color: #28a745;
    }
    .classmate-card {
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    .classmate-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stats-card {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        height: 100%;
    }
</style>
@endpush

<!-- Class Header -->
<div class="class-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="mb-2">
                <i class="fas fa-chalkboard me-2"></i>{{ $class->name }}
            </h2>
            <p class="mb-1">{{ $class->major_full_name ?? $class->major }} - Tahun Ajaran {{ $class->academic_year }}</p>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-users me-1"></i>{{ $classStats['total_students'] }} Siswa
                </span>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-book me-1"></i>{{ $classStats['total_subjects'] }} Mata Pelajaran
                </span>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-user-tie me-1"></i>{{ $class->homeroom_teacher ?? 'Wali Kelas Belum Ditentukan' }}
                </span>
            </div>
        </div>
        <div class="col-md-4 text-end">
            <div class="display-4 opacity-50">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
    </div>
</div>

<!-- Class Statistics -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="stats-card">
            <i class="fas fa-users text-primary display-6 mb-2"></i>
            <h4 class="text-primary">{{ $classStats['total_students'] }}</h4>
            <small class="text-muted">Total Siswa</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <i class="fas fa-male text-info display-6 mb-2"></i>
            <h4 class="text-info">{{ $classStats['male_students'] }}</h4>
            <small class="text-muted">Laki-laki</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <i class="fas fa-female text-danger display-6 mb-2"></i>
            <h4 class="text-danger">{{ $classStats['female_students'] }}</h4>
            <small class="text-muted">Perempuan</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card">
            <i class="fas fa-book text-success display-6 mb-2"></i>
            <h4 class="text-success">{{ $classStats['total_subjects'] }}</h4>
            <small class="text-muted">Mata Pelajaran</small>
        </div>
    </div>
</div>

<div class="row">
    <!-- Mata Pelajaran -->
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-book me-2"></i>Mata Pelajaran Kelas {{ $class->name }}
                </h5>
            </div>
            <div class="card-body">
                <!-- Mata Pelajaran Wajib -->
                <div class="mb-4">
                    <h6 class="text-warning mb-3">
                        <i class="fas fa-star me-2"></i>Mata Pelajaran Wajib ({{ $classStats['mandatory_subjects'] }})
                    </h6>
                    @if($mandatorySubjects->count() > 0)
                        <div class="row g-3">
                            @foreach($mandatorySubjects as $subject)
                            <div class="col-md-6">
                                <div class="card subject-card mandatory-subject">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-1">{{ $subject->name }}</h6>
                                        <small class="text-muted d-block">{{ $subject->code }}</small>
                                        <div class="mt-2">
                                            <span class="badge bg-warning">Wajib</span>
                                            <span class="badge bg-info">{{ $subject->hours_per_week }} jam/minggu</span>
                                        </div>
                                        @if($subject->pivot && $subject->pivot->teacher_name)
                                            <div class="mt-2">
                                                <small class="text-muted">Guru: </small>
                                                <small class="fw-semibold">{{ $subject->pivot->teacher_name }}</small>
                                            </div>
                                        @endif
                                        @if($subject->pivot && $subject->pivot->schedule_day)
                                            <div class="mt-1">
                                                <small class="text-muted">Jadwal: </small>
                                                <small>{{ ucfirst($subject->pivot->schedule_day) }}
                                                @if($subject->pivot->start_time && $subject->pivot->end_time)
                                                    {{ $subject->pivot->start_time }} - {{ $subject->pivot->end_time }}
                                                @endif
                                                </small>
                                            </div>
                                        @endif
                                        <div class="mt-2">
                                            <a href="{{ route('learner.materials.by-subject', $subject) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-book-open me-1"></i>Lihat Materi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Belum ada mata pelajaran wajib yang ditugaskan.
                        </div>
                    @endif
                </div>

                <!-- Mata Pelajaran Tambahan -->
                @if($optionalSubjects->count() > 0)
                <div>
                    <h6 class="text-success mb-3">
                        <i class="fas fa-plus-circle me-2"></i>Mata Pelajaran Tambahan ({{ $classStats['optional_subjects'] }})
                    </h6>
                    <div class="row g-3">
                        @foreach($optionalSubjects as $subject)
                        <div class="col-md-6">
                            <div class="card subject-card optional-subject">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1">{{ $subject->name }}</h6>
                                    <small class="text-muted d-block">{{ $subject->code }}</small>
                                    <div class="mt-2">
                                        <span class="badge bg-success">Tambahan</span>
                                        <span class="badge bg-info">{{ $subject->hours_per_week }} jam/minggu</span>
                                    </div>
                                    @if($subject->pivot && $subject->pivot->teacher_name)
                                        <div class="mt-2">
                                            <small class="text-muted">Guru: </small>
                                            <small class="fw-semibold">{{ $subject->pivot->teacher_name }}</small>
                                        </div>
                                    @endif
                                    @if($subject->pivot && $subject->pivot->schedule_day)
                                        <div class="mt-1">
                                            <small class="text-muted">Jadwal: </small>
                                            <small>{{ ucfirst($subject->pivot->schedule_day) }}
                                            @if($subject->pivot->start_time && $subject->pivot->end_time)
                                                {{ $subject->pivot->start_time }} - {{ $subject->pivot->end_time }}
                                            @endif
                                            </small>
                                        </div>
                                    @endif
                                    <div class="mt-2">
                                        <a href="{{ route('learner.materials.by-subject', $subject) }}" class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-book-open me-1"></i>Lihat Materi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Teman Sekelas -->
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>Teman Sekelas
                </h5>
            </div>
            <div class="card-body">
                @if($classmates->count() > 0)
                    <div class="row g-2">
                        @foreach($classmates->take(12) as $classmate)
                        <div class="col-12">
                            <div class="classmate-card p-2 border rounded">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @if($classmate->profile_photo)
                                            <img src="{{ asset('storage/' . $classmate->profile_photo) }}" 
                                                 alt="{{ $classmate->name }}" 
                                                 class="rounded-circle" 
                                                 width="40" height="40">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">{{ $classmate->name }}</h6>
                                        <small class="text-muted">{{ $classmate->student_id }}</small>
                                    </div>
                                    <div>
                                        @if($classmate->gender == 'L')
                                            <i class="fas fa-male text-info"></i>
                                        @elseif($classmate->gender == 'P')
                                            <i class="fas fa-female text-danger"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        @if($classmates->count() > 12)
                        <div class="col-12">
                            <div class="text-center p-2">
                                <small class="text-muted">
                                    +{{ $classmates->count() - 12 }} teman lainnya
                                </small>
                            </div>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-3">
                        <i class="fas fa-users display-4 text-muted mb-3"></i>
                        <p class="text-muted">Belum ada teman sekelas</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('learner.materials') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-book-open me-2"></i>Semua Materi
                    </a>
                    <a href="{{ route('learner.schedule') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-calendar me-2"></i>Lihat Jadwal
                    </a>
                    <a href="{{ route('learner.grades') }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-chart-line me-2"></i>Lihat Nilai
                    </a>
                    <a href="{{ route('learner.announcements') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-bullhorn me-2"></i>Pengumuman
                    </a>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-qr-code me-2"></i>Absensi QR
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Animation for cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.subject-card, .classmate-card');
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