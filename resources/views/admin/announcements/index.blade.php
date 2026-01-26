@extends('layouts.admin')

@section('title', 'Kelola Pengumuman')

@section('content')

<style>
.action-buttons .btn-group {
    display: flex;
    gap: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 0.375rem;
}

.action-buttons .btn {
    min-width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 0;
    border-right: 1px solid rgba(255,255,255,0.2);
    transition: all 0.2s ease;
}

.action-buttons .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.action-buttons .btn:last-child {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
    border-right: none;
}

.action-buttons .btn i {
    font-size: 14px;
}

.action-buttons .btn:hover {
    transform: translateY(-1px);
    z-index: 1;
}

.table td {
    vertical-align: middle;
}

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
    border-color: #117a8b;
    color: white;
}

.announcement-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.announcement-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}
</style>

<div class="container-fluid px-2">
    <!-- Header -->
    <div class="sticky-top bg-white shadow-sm py-2 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">
                    <i class="fas fa-bullhorn me-2"></i>Kelola Pengumuman
                </h5>
                <small class="text-muted">Buat dan kelola pengumuman sekolah</small>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                    <i class="fas fa-plus me-1"></i>Buat Pengumuman
                </button>
                <a href="{{ route('admin.announcements.logs') }}" class="btn btn-outline-info btn-sm">
                    <i class="fas fa-history me-1"></i>Log Pengiriman
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-bullhorn text-primary display-6 mb-2"></i>
                    <h6>Total Pengumuman</h6>
                    <h4 class="text-primary mb-0">{{ $announcements->total() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-day text-success display-6 mb-2"></i>
                    <h6>Hari Ini</h6>
                    <h4 class="text-success mb-0">{{ $announcements->where('created_at', '>=', today())->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-clock text-warning display-6 mb-2"></i>
                    <h6>Minggu Ini</h6>
                    <h4 class="text-warning mb-0">{{ $announcements->where('created_at', '>=', now()->startOfWeek())->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="admin-card text-center">
                <div class="card-body">
                    <i class="fas fa-users text-info display-6 mb-2"></i>
                    <h6>Penerima</h6>
                    <h4 class="text-info mb-0">{{ \App\Models\User::count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Table -->
    <div class="admin-card">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-list me-2"></i>Daftar Pengumuman
                </h6>
                <div class="d-flex gap-2">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari pengumuman..." id="searchAnnouncement">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($announcements->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="announcementsTable">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 1%;">No</th>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Dibuat Oleh</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $index => $announcement)
                            <tr>
                                <td>{{ $announcements->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold">{{ $announcement->title }}</div>
                                    @if($announcement->created_at->diffInDays() <= 3)
                                        <span class="badge bg-success badge-sm">Baru</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;" title="{{ $announcement->content }}">
                                        {{ $announcement->content }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                                             style="width: 30px; height: 30px; font-size: 0.8rem;">
                                            {{ substr($announcement->sent_by ?? 'A', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold small">{{ $announcement->sent_by ?? 'Admin' }}</div>
                                            <small class="text-muted">Administrator</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $announcement->created_at->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $announcement->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @if($announcement->created_at->diffInHours() <= 24)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Lama</span>
                                    @endif
                                </td>
                                <td class="text-center action-buttons">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <!-- View Button -->
                                        <button type="button" 
                                                class="btn btn-info" 
                                                onclick="viewAnnouncement({{ $announcement->id }}, '{{ addslashes($announcement->title) }}', '{{ addslashes($announcement->content) }}', '{{ $announcement->sent_by }}', '{{ $announcement->created_at->format('d M Y H:i') }}')"
                                                title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Edit Button -->
                                        <button type="button" 
                                                class="btn btn-warning" 
                                                onclick="editAnnouncement({{ $announcement->id }}, '{{ addslashes($announcement->title) }}', '{{ addslashes($announcement->content) }}')"
                                                title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Button -->
                                        <button type="button" 
                                                class="btn btn-danger" 
                                                onclick="deleteAnnouncement({{ $announcement->id }}, '{{ addslashes($announcement->title) }}')"
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-bullhorn display-4 text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Pengumuman</h5>
                    <p class="text-muted mb-4">Mulai dengan membuat pengumuman pertama</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                        <i class="fas fa-plus me-2"></i>Buat Pengumuman Pertama
                    </button>
                </div>
            @endif
        </div>
        @if($announcements->hasPages())
            <div class="card-footer">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Create Announcement Modal -->
<div class="modal fade" id="createAnnouncementModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.announcements.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus me-2"></i>Buat Pengumuman Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-heading me-2"></i>Judul Pengumuman
                        </label>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan judul pengumuman" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-align-left me-2"></i>Isi Pengumuman
                        </label>
                        <textarea name="content" class="form-control" rows="5" placeholder="Tulis isi pengumuman di sini..." required></textarea>
                    </div>
                    <input type="hidden" name="sent_by" value="{{ Auth::user()->name }}">
                    
                    <div class="alert alert-info border-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Info:</strong> Pengumuman akan dikirim ke semua pengguna sistem (admin, guru, dan siswa).
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i>Kirim Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Announcement Modal -->
<div class="modal fade" id="viewAnnouncementModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Detail Pengumuman
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label text-muted">Judul</label>
                    <h6 id="viewTitle"></h6>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">Isi Pengumuman</label>
                    <p id="viewContent"></p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Dibuat Oleh</label>
                        <p id="viewSentBy"></p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Tanggal</label>
                        <p id="viewDate"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Announcement Modal -->
<div class="modal fade" id="editAnnouncementModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editAnnouncementForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit Pengumuman
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-heading me-2"></i>Judul Pengumuman
                        </label>
                        <input type="text" name="title" id="editTitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-align-left me-2"></i>Isi Pengumuman
                        </label>
                        <textarea name="content" id="editContent" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-1"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function viewAnnouncement(id, title, content, sentBy, date) {
    document.getElementById('viewTitle').textContent = title;
    document.getElementById('viewContent').textContent = content;
    document.getElementById('viewSentBy').textContent = sentBy;
    document.getElementById('viewDate').textContent = date;
    
    new bootstrap.Modal(document.getElementById('viewAnnouncementModal')).show();
}

function editAnnouncement(id, title, content) {
    document.getElementById('editTitle').value = title;
    document.getElementById('editContent').value = content;
    document.getElementById('editAnnouncementForm').action = `/admin/announcements/${id}`;
    
    new bootstrap.Modal(document.getElementById('editAnnouncementModal')).show();
}

function deleteAnnouncement(id, title) {
    if (confirm(`Apakah Anda yakin ingin menghapus pengumuman "${title}"? Tindakan ini tidak dapat dibatalkan.`)) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/announcements/${id}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}

// Search functionality
document.getElementById('searchAnnouncement').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#announcementsTable tbody tr');
    
    rows.forEach(row => {
        const title = row.cells[1].textContent.toLowerCase();
        const content = row.cells[2].textContent.toLowerCase();
        const author = row.cells[3].textContent.toLowerCase();
        
        if (title.includes(searchTerm) || content.includes(searchTerm) || author.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endsection

{{-- SweetAlert Toast --}}
@if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: @json(session('success')),
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'rounded'
                }
            });
        });
    </script>
@endif