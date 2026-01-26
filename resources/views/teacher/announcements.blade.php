@extends('layouts.teacher')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">📢 Pengumuman Sekolah</h2>
                    <p class="text-muted mb-0">Informasi dan pengumuman terbaru dari sekolah</p>
                </div>
                <a href="{{ route('employee.dashboard') }}" class="btn btn-outline-success">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Cari pengumuman..." id="searchAnnouncement">
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="filter" id="all" checked>
                                <label class="btn btn-outline-primary" for="all">Semua</label>

                                <input type="radio" class="btn-check" name="filter" id="recent">
                                <label class="btn btn-outline-success" for="recent">Terbaru</label>

                                <input type="radio" class="btn-check" name="filter" id="older">
                                <label class="btn btn-outline-info" for="older">Lama</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements List -->
    <div class="row">
        <div class="col-12">
            @if($announcements->count() > 0)
                @foreach($announcements as $announcement)
                <div class="card border-0 shadow-sm mb-4 announcement-card">
                    <div class="card-header bg-light border-0">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="d-flex align-items-center">
                                <div class="announcement-icon me-3">
                                    <i class="fas fa-bullhorn text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">{{ $announcement->title }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $announcement->created_at->format('d F Y, H:i') }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-user me-1"></i>
                                        Admin Sekolah
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                @if($announcement->created_at->diffInDays() <= 7)
                                    <span class="badge bg-success me-2">
                                        <i class="fas fa-star me-1"></i>Baru
                                    </span>
                                @endif
                                
                                <span class="badge bg-info">
                                    <i class="fas fa-bell me-1"></i>Pengumuman
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="announcement-content">
                            <p class="mb-3">{{ $announcement->content }}</p>
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    <strong>Dikirim oleh:</strong> {{ $announcement->sent_by ?? 'Admin Sekolah' }}
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="announcement-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="markAsRead({{ $announcement->id }})">
                                    <i class="fas fa-check me-1"></i>Tandai Dibaca
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="shareAnnouncement({{ $announcement->id }})">
                                    <i class="fas fa-share me-1"></i>Bagikan
                                </button>
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $announcement->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $announcements->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-bullhorn text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-muted mb-2">Belum Ada Pengumuman</h5>
                        <p class="text-muted mb-4">Pengumuman dari admin akan muncul di sini</p>
                        <button class="btn btn-outline-primary" onclick="location.reload()">
                            <i class="fas fa-refresh me-2"></i>Refresh Halaman
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.announcement-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.announcement-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.announcement-icon {
    width: 40px;
    height: 40px;
    background: rgba(40, 167, 69, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.announcement-content {
    line-height: 1.6;
}

.btn-check:checked + .btn-outline-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: white;
}

.btn-check:checked + .btn-outline-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: black;
}

.btn-check:checked + .btn-outline-info {
    background-color: #0dcaf0;
    border-color: #0dcaf0;
    color: black;
}
</style>

<script>
function markAsRead(announcementId) {
    // Simulate marking as read
    Swal.fire({
        icon: 'success',
        title: 'Ditandai Sebagai Dibaca',
        text: 'Pengumuman telah ditandai sebagai sudah dibaca',
        timer: 2000,
        showConfirmButton: false
    });
}

function shareAnnouncement(announcementId) {
    // Simulate sharing
    if (navigator.share) {
        navigator.share({
            title: 'Pengumuman Sekolah',
            text: 'Lihat pengumuman penting dari sekolah',
            url: window.location.href
        });
    } else {
        // Fallback - copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Link Disalin',
                text: 'Link pengumuman telah disalin ke clipboard',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }
}

// Search functionality
document.getElementById('searchAnnouncement').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const announcements = document.querySelectorAll('.announcement-card');
    
    announcements.forEach(card => {
        const title = card.querySelector('h6').textContent.toLowerCase();
        const content = card.querySelector('.announcement-content p').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || content.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

// Filter functionality
document.querySelectorAll('input[name="filter"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const filter = this.id;
        const announcements = document.querySelectorAll('.announcement-card');
        
        announcements.forEach(card => {
            const dateElement = card.querySelector('small i.fa-calendar').parentElement;
            const dateText = dateElement.textContent;
            let show = true;
            
            if (filter === 'recent') {
                // Show announcements from last 7 days
                const badges = card.querySelectorAll('.badge');
                show = Array.from(badges).some(badge => badge.classList.contains('bg-success'));
            } else if (filter === 'older') {
                // Show announcements older than 7 days
                const badges = card.querySelectorAll('.badge');
                show = !Array.from(badges).some(badge => badge.classList.contains('bg-success'));
            }
            // 'all' shows everything
            
            card.style.display = show ? 'block' : 'none';
        });
    });
});
</script>
@endsection