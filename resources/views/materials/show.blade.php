@extends(auth()->user()->hasRole('learner') ? 'layouts.student' : (auth()->user()->hasRole('employee') ? 'layouts.teacher' : 'layouts.admin'))

@section('title', $material->title . ' - EDUFIKRI')

@section('content')

@push('styles')
<style>
    .material-header {
        background: linear-gradient(135deg, #6f42c1, #e83e8c);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .material-content {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        padding: 2rem;
    }
    .material-meta {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
    }
    .file-preview {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        margin: 1rem 0;
    }
    .assignment-alert {
        border-left: 4px solid #dc3545;
        background: #fff5f5;
    }
</style>
@endpush

<!-- Header -->
<div class="material-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="mb-2">
                <span class="badge bg-light text-dark me-2">{{ $material->subject->name }}</span>
                <span class="badge bg-warning">{{ $material->type_name }}</span>
            </div>
            <h2 class="mb-2">{{ $material->title }}</h2>
            <p class="mb-1">{{ $material->class->name }} - {{ $material->subject->name }}</p>
            @if($material->teacher)
            <small class="opacity-75">
                <i class="fas fa-user-tie me-1"></i>{{ $material->teacher->name }}
            </small>
            @endif
        </div>
        <div class="col-md-4 text-end">
            <div class="display-4 opacity-50">
                @switch($material->type)
                    @case('assignment')
                        <i class="fas fa-tasks"></i>
                        @break
                    @case('document')
                        <i class="fas fa-file-alt"></i>
                        @break
                    @case('video')
                        <i class="fas fa-play-circle"></i>
                        @break
                    @case('link')
                        <i class="fas fa-link"></i>
                        @break
                    @case('quiz')
                        <i class="fas fa-question-circle"></i>
                        @break
                @endswitch
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Content -->
    <div class="col-lg-8">
        <div class="material-content">
            @if($material->type === 'assignment' && $material->due_date)
            <div class="alert assignment-alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 display-6"></i>
                    <div>
                        <h5 class="alert-heading mb-1">Tugas - Deadline</h5>
                        <p class="mb-1">
                            <strong>Batas Waktu:</strong> 
                            {{ $material->due_date->format('l, d F Y') }}
                            @if($material->is_overdue)
                                <span class="badge bg-danger ms-2">Terlambat</span>
                            @else
                                <span class="badge bg-warning ms-2">{{ $material->due_date->diffForHumans() }}</span>
                            @endif
                        </p>
                        @if($material->max_score)
                        <p class="mb-0">
                            <strong>Nilai Maksimal:</strong> {{ $material->max_score }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <h4 class="mb-3">Deskripsi</h4>
            @if($material->description)
                <div class="mb-4">
                    {!! nl2br(e($material->description)) !!}
                </div>
            @else
                <p class="text-muted mb-4">Tidak ada deskripsi tersedia.</p>
            @endif

            <!-- File/Link Content -->
            @if($material->type === 'link' && $material->external_link)
                <div class="file-preview">
                    <i class="fas fa-external-link-alt display-4 text-primary mb-3"></i>
                    <h5>Link Eksternal</h5>
                    <p class="text-muted mb-3">Klik tombol di bawah untuk membuka link</p>
                    <a href="{{ $material->external_link }}" target="_blank" class="btn btn-primary">
                        <i class="fas fa-external-link-alt me-2"></i>Buka Link
                    </a>
                </div>
            @elseif($material->file_path)
                <div class="file-preview">
                    <i class="fas fa-file display-4 text-success mb-3"></i>
                    <h5>{{ $material->file_name }}</h5>
                    @if($material->file_size_formatted)
                    <p class="text-muted mb-3">Ukuran: {{ $material->file_size_formatted }}</p>
                    @endif
                    <a href="{{ route('materials.download', $material) }}" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Download File
                    </a>
                </div>
            @else
                <div class="file-preview">
                    <i class="fas fa-info-circle display-4 text-info mb-3"></i>
                    <h5>Tidak Ada File</h5>
                    <p class="text-muted">Materi ini tidak memiliki file yang dapat didownload.</p>
                </div>
            @endif

            <!-- Navigation -->
            <div class="mt-4 pt-4 border-top">
                <div class="d-flex justify-content-between">
                    @if(auth()->user()->hasRole('learner'))
                        <a href="{{ route('learner.materials') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Materi
                        </a>
                        <a href="{{ route('learner.materials.by-subject', $material->subject) }}" class="btn btn-primary">
                            <i class="fas fa-book me-2"></i>Materi {{ $material->subject->name }}
                        </a>
                    @else
                        <a href="{{ route('materials.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="material-meta">
            <h5 class="mb-3">
                <i class="fas fa-info-circle me-2"></i>Informasi Materi
            </h5>
            
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label text-muted small">Mata Pelajaran</label>
                    <div class="fw-semibold">{{ $material->subject->name }}</div>
                </div>
                
                <div class="col-12">
                    <label class="form-label text-muted small">Kelas</label>
                    <div class="fw-semibold">{{ $material->class->name }}</div>
                </div>
                
                @if($material->teacher)
                <div class="col-12">
                    <label class="form-label text-muted small">Guru</label>
                    <div class="fw-semibold">{{ $material->teacher->name }}</div>
                </div>
                @endif
                
                <div class="col-6">
                    <label class="form-label text-muted small">Jenis</label>
                    <div class="fw-semibold">{{ $material->type_name }}</div>
                </div>
                
                <div class="col-6">
                    <label class="form-label text-muted small">Dibuat</label>
                    <div class="fw-semibold">{{ $material->created_at->format('d M Y') }}</div>
                </div>
                
                @if($material->due_date)
                <div class="col-12">
                    <label class="form-label text-muted small">Deadline</label>
                    <div class="fw-semibold text-{{ $material->is_overdue ? 'danger' : 'warning' }}">
                        {{ $material->due_date->format('d F Y') }}
                        @if($material->is_overdue)
                            <small class="text-danger">(Terlambat)</small>
                        @endif
                    </div>
                </div>
                @endif
                
                @if($material->max_score)
                <div class="col-12">
                    <label class="form-label text-muted small">Nilai Maksimal</label>
                    <div class="fw-semibold">{{ $material->max_score }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        @if(auth()->user()->hasRole('learner'))
        <div class="card mt-3">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-bolt me-2"></i>Aksi Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('learner.my-class') }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-chalkboard me-2"></i>Lihat Kelas
                    </a>
                    <a href="{{ route('learner.schedule') }}" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-calendar me-2"></i>Jadwal Pelajaran
                    </a>
                    <a href="{{ route('learner.materials.by-subject', $material->subject) }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-book me-2"></i>Materi Lainnya
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection