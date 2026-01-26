@extends('layouts.student')

@section('title', 'Materi Pembelajaran - EDUFIKRI')

@section('content')

@push('styles')
<style>
    .materials-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .material-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        height: 100%;
    }
    .material-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .material-type-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1;
    }
    .assignment-card {
        border-left: 4px solid #dc3545;
    }
    .document-card {
        border-left: 4px solid #007bff;
    }
    .video-card {
        border-left: 4px solid #fd7e14;
    }
    .link-card {
        border-left: 4px solid #6f42c1;
    }
    .quiz-card {
        border-left: 4px solid #ffc107;
    }
    .subject-filter {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 2rem;
    }
    .filter-btn {
        border-radius: 20px;
        margin: 0.2rem;
        transition: all 0.3s ease;
    }
    .filter-btn.active {
        background: #007bff;
        color: white;
    }
</style>
@endpush

<!-- Header -->
<div class="materials-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="mb-2">
                <i class="fas fa-book-open me-2"></i>Materi Pembelajaran
            </h2>
            <p class="mb-1">Kelas {{ $learner->section }} - Akses semua materi pembelajaran Anda</p>
            <div class="d-flex flex-wrap gap-2 mt-3">
                <span class="badge bg-light text-dark">
                    <i class="fas fa-file me-1"></i>{{ $materials->total() }} Materi
                </span>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-tasks me-1"></i>{{ $recentAssignments->count() }} Tugas Aktif
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

<!-- Recent Assignments Alert -->
@if($recentAssignments->count() > 0)
<div class="alert alert-warning border-0 shadow-sm mb-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-exclamation-triangle me-3 display-6"></i>
        <div>
            <h5 class="alert-heading mb-1">Tugas yang Perlu Dikerjakan</h5>
            <p class="mb-2">Anda memiliki {{ $recentAssignments->count() }} tugas yang perlu diselesaikan:</p>
            <div class="row g-2">
                @foreach($recentAssignments->take(3) as $assignment)
                <div class="col-md-4">
                    <div class="card border-warning">
                        <div class="card-body p-2">
                            <h6 class="card-title mb-1 small">{{ $assignment->title }}</h6>
                            <small class="text-muted">{{ $assignment->subject->name }}</small>
                            <div class="mt-1">
                                <small class="text-danger">
                                    <i class="fas fa-clock me-1"></i>
                                    Deadline: {{ $assignment->due_date->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!-- Subject Filter -->
<div class="subject-filter">
    <h6 class="mb-3">
        <i class="fas fa-filter me-2"></i>Filter berdasarkan Mata Pelajaran
    </h6>
    <div class="d-flex flex-wrap">
        <button class="btn btn-outline-primary filter-btn active" data-filter="all">
            Semua Materi
        </button>
        @foreach($materialsBySubject as $subjectName => $subjectMaterials)
        <button class="btn btn-outline-primary filter-btn" data-filter="{{ Str::slug($subjectName) }}">
            {{ $subjectName }} ({{ $subjectMaterials->count() }})
        </button>
        @endforeach
    </div>
</div>

<!-- Materials Grid -->
<div class="row g-4" id="materials-grid">
    @forelse($materials as $material)
    <div class="col-lg-4 col-md-6 material-item" data-subject="{{ Str::slug($material->subject->name) }}" data-type="{{ $material->type }}">
        <div class="card material-card {{ $material->type }}-card position-relative">
            <div class="material-type-badge">
                @switch($material->type)
                    @case('assignment')
                        <span class="badge bg-danger">{{ $material->type_name }}</span>
                        @break
                    @case('document')
                        <span class="badge bg-primary">{{ $material->type_name }}</span>
                        @break
                    @case('video')
                        <span class="badge bg-warning">{{ $material->type_name }}</span>
                        @break
                    @case('link')
                        <span class="badge bg-info">{{ $material->type_name }}</span>
                        @break
                    @case('quiz')
                        <span class="badge bg-success">{{ $material->type_name }}</span>
                        @break
                @endswitch
            </div>
            
            <div class="card-body">
                <div class="mb-2">
                    <span class="badge bg-light text-dark">{{ $material->subject->name }}</span>
                </div>
                
                <h5 class="card-title">{{ $material->title }}</h5>
                
                @if($material->description)
                <p class="card-text text-muted small">
                    {{ Str::limit($material->description, 100) }}
                </p>
                @endif
                
                <div class="row g-2 text-sm mb-3">
                    @if($material->teacher)
                    <div class="col-12">
                        <small class="text-muted">
                            <i class="fas fa-user-tie me-1"></i>{{ $material->teacher->name }}
                        </small>
                    </div>
                    @endif
                    
                    <div class="col-6">
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>{{ $material->created_at->format('d M Y') }}
                        </small>
                    </div>
                    
                    @if($material->due_date && $material->type === 'assignment')
                    <div class="col-6">
                        <small class="text-{{ $material->is_overdue ? 'danger' : 'warning' }}">
                            <i class="fas fa-clock me-1"></i>{{ $material->due_date->format('d M Y') }}
                        </small>
                    </div>
                    @endif
                    
                    @if($material->file_size_formatted)
                    <div class="col-6">
                        <small class="text-muted">
                            <i class="fas fa-file me-1"></i>{{ $material->file_size_formatted }}
                        </small>
                    </div>
                    @endif
                </div>
                
                <div class="d-grid gap-2">
                    @if($material->type === 'link' && $material->external_link)
                        <a href="{{ $material->external_link }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fas fa-external-link-alt me-2"></i>Buka Link
                        </a>
                    @elseif($material->file_path)
                        <a href="{{ route('materials.download', $material) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download me-2"></i>Download
                        </a>
                    @endif
                    
                    <a href="{{ route('materials.show', $material) }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-eye me-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="text-center py-5">
            <i class="fas fa-book-open display-1 text-muted mb-3"></i>
            <h4 class="text-muted">Belum Ada Materi</h4>
            <p class="text-muted">Materi pembelajaran belum tersedia untuk kelas Anda.</p>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($materials->hasPages())
<div class="d-flex justify-content-center mt-4">
    {{ $materials->links() }}
</div>
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const materialItems = document.querySelectorAll('.material-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            materialItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-subject') === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.3s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Animation for cards
    const cards = document.querySelectorAll('.material-card');
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

// CSS Animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>
@endpush