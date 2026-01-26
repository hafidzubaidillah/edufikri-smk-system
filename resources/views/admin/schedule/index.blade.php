@extends('layouts.admin')

@section('title', 'Jadwal Pelajaran - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .schedule-card {
        transition: all 0.3s ease;
        border-left: 4px solid #20c997;
    }
    .schedule-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stats-card {
        background: linear-gradient(135deg, #20c997, #1a5f1a);
        color: white;
    }
    .day-header {
        background: linear-gradient(135deg, #1a5f1a, #ffc107);
        color: white;
        border-radius: 0.5rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }
    .time-slot {
        background: #f8f9fa;
        border-left: 3px solid #dee2e6;
        padding: 0.5rem;
        margin-bottom: 0.5rem;
        border-radius: 0.375rem;
    }
    .subject-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
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
                            <i class="fas fa-calendar-alt me-2"></i>Jadwal Pelajaran
                        </h2>
                        <p class="mb-0">Manajemen jadwal pelajaran SMK IT Ihsanul Fikri</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-light btn-lg">
                            <i class="fas fa-plus me-2"></i>Buat Jadwal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="row mb-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Filter Jadwal</h6>
                <div class="row g-2">
                    <div class="col-md-3">
                        <select class="form-select" id="filterGrade">
                            <option value="">Semua Tingkat</option>
                            <option value="10">Kelas X</option>
                            <option value="11">Kelas XI</option>
                            <option value="12">Kelas XII</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterMajor">
                            <option value="">Semua Jurusan</option>
                            <option value="TJKT">TJKT</option>
                            <option value="PPLG">PPLG</option>
                            <option value="TKR">TKR</option>
                            <option value="TSM">TSM</option>
                            <option value="AKL">AKL</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterDay">
                            <option value="">Semua Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100" onclick="filterSchedule()">
                            <i class="fas fa-filter me-1"></i>Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Statistik Jadwal</h6>
                <div class="row g-2 text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h5 class="text-primary mb-0">{{ $classes->count() }}</h5>
                            <small class="text-muted">Total Kelas</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h5 class="text-success mb-0">{{ $classes->sum(function($class) { return $class->subjects->count(); }) }}</h5>
                        <small class="text-muted">Total Mapel</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Grid -->
<div class="row">
    @foreach($days as $day)
    <div class="col-12 mb-4">
        <div class="day-header">
            <h4 class="mb-0">
                <i class="fas fa-calendar-day me-2"></i>{{ $day }}
            </h4>
        </div>
        
        <div class="row g-3">
            @php
                $dayClasses = $classes->filter(function($class) use ($day) {
                    return $class->subjects->where('pivot.schedule_day', $day)->count() > 0;
                });
            @endphp
            
            @if($dayClasses->count() > 0)
                @foreach($dayClasses as $class)
                <div class="col-md-6 col-lg-4 schedule-item" 
                     data-grade="{{ $class->grade }}" 
                     data-major="{{ $class->major }}" 
                     data-day="{{ $day }}">
                    <div class="card schedule-card h-100">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">{{ $class->name }}</h6>
                                <span class="badge bg-primary">{{ $class->major }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $daySubjects = $class->subjects->where('pivot.schedule_day', $day)->sortBy('pivot.start_time');
                            @endphp
                            
                            @foreach($daySubjects as $subject)
                            <div class="time-slot">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <div>
                                        <div class="fw-semibold">{{ $subject->name }}</div>
                                        <small class="text-muted">{{ $subject->code }}</small>
                                    </div>
                                    <span class="subject-badge bg-{{ $subject->category == 'umum' ? 'success' : ($subject->category == 'kejuruan' ? 'primary' : ($subject->category == 'agama' ? 'info' : 'secondary')) }}">
                                        {{ $subject->category_label }}
                                    </span>
                                </div>
                                
                                <div class="row g-2 small text-muted">
                                    <div class="col-6">
                                        <i class="fas fa-clock me-1"></i>
                                        @if($subject->pivot->start_time && $subject->pivot->end_time)
                                            {{ date('H:i', strtotime($subject->pivot->start_time)) }} - {{ date('H:i', strtotime($subject->pivot->end_time)) }}
                                        @else
                                            Belum dijadwalkan
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <i class="fas fa-door-open me-1"></i>
                                        {{ $subject->pivot->room ?? 'Ruang belum ditentukan' }}
                                    </div>
                                </div>
                                
                                @if($subject->pivot->teacher_name)
                                <div class="mt-1 small">
                                    <i class="fas fa-user me-1"></i>
                                    {{ $subject->pivot->teacher_name }}
                                </div>
                                @endif
                            </div>
                            @endforeach
                            
                            @if($daySubjects->count() == 0)
                            <div class="text-center text-muted py-3">
                                <i class="fas fa-calendar-times display-6 mb-2"></i>
                                <p class="mb-0">Tidak ada jadwal</p>
                            </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                                <button class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-print"></i> Print
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-4">
                        <i class="fas fa-calendar-times text-muted display-6 mb-3"></i>
                        <h5 class="text-muted">Tidak ada jadwal untuk hari {{ $day }}</h5>
                        <p class="text-muted">Silakan tambahkan jadwal untuk hari ini.</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Jadwal {{ $day }}
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

<!-- Weekly Overview -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="fas fa-table me-2"></i>Ringkasan Jadwal Mingguan
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Kelas</th>
                                @foreach($days as $day)
                                <th class="text-center">{{ $day }}</th>
                                @endforeach
                                <th class="text-center">Total Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes->take(10) as $class)
                            <tr>
                                <td class="fw-semibold">{{ $class->name }}</td>
                                @foreach($days as $day)
                                <td class="text-center">
                                    @php
                                        $daySubjectsCount = $class->subjects->where('pivot.schedule_day', $day)->count();
                                        $totalHours = $class->subjects->where('pivot.schedule_day', $day)->sum('hours_per_week');
                                    @endphp
                                    @if($daySubjectsCount > 0)
                                        <span class="badge bg-success">{{ $daySubjectsCount }} mapel</span>
                                        <br><small class="text-muted">{{ $totalHours }} jam</small>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                @endforeach
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $class->subjects->sum('hours_per_week') }} jam</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function filterSchedule() {
    const grade = document.getElementById('filterGrade').value;
    const major = document.getElementById('filterMajor').value;
    const day = document.getElementById('filterDay').value;
    
    const scheduleItems = document.querySelectorAll('.schedule-item');
    
    scheduleItems.forEach(item => {
        const itemGrade = item.getAttribute('data-grade');
        const itemMajor = item.getAttribute('data-major');
        const itemDay = item.getAttribute('data-day');
        
        let show = true;
        
        if (grade && itemGrade !== grade) {
            show = false;
        }
        
        if (major && itemMajor !== major) {
            show = false;
        }
        
        if (day && itemDay !== day) {
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
    
    // Hide/show day sections
    const daySections = document.querySelectorAll('.day-header');
    daySections.forEach(section => {
        const dayName = section.querySelector('h4').textContent.trim().replace('📅 ', '');
        if (day && dayName !== day) {
            section.parentElement.style.display = 'none';
        } else {
            section.parentElement.style.display = 'block';
        }
    });
}

// Animation for cards
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.schedule-card');
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