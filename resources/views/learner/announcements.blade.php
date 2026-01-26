@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">📢 Pengumuman</h2>
                    <p class="text-muted mb-0">Informasi terbaru dari sekolah</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Announcements List -->
    <div class="row">
        <div class="col-12">
            @if($announcements->count() > 0)
                @foreach($announcements as $announcement)
                <div class="card mb-3 border-0 shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-primary">
                            <i class="fas fa-bullhorn me-2"></i>{{ $announcement->title }}
                        </h6>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>{{ $announcement->created_at->format('d M Y, H:i') }}
                        </small>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">{{ $announcement->content }}</p>
                        <small class="text-muted">
                            <i class="fas fa-user me-1"></i>Oleh: {{ $announcement->sent_by }}
                        </small>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $announcements->links() }}
                </div>
            @else
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-inbox display-4 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Pengumuman</h5>
                        <p class="text-muted">Pengumuman terbaru akan muncul di sini</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection