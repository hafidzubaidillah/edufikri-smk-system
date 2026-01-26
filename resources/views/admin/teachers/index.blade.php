@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">👨‍🏫 Manajemen Guru</h2>
                <p class="text-muted mb-0">Kelola data guru dan pengajar</p>
            </div>
            <a href="{{ route('admin.teachers.create') }}" class="admin-btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Guru
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body">
                <i class="fas fa-chalkboard-teacher text-success display-6 mb-2"></i>
                <h6 class="card-title">Total Guru</h6>
                <h4 class="text-success">{{ $teachers->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body">
                <i class="fas fa-user-check text-primary display-6 mb-2"></i>
                <h6 class="card-title">Guru Aktif</h6>
                <h4 class="text-primary">{{ $teachers->where('is_active', true)->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body">
                <i class="fas fa-graduation-cap text-warning display-6 mb-2"></i>
                <h6 class="card-title">Spesialisasi</h6>
                <h4 class="text-warning">{{ $teachers->whereNotNull('subject_specialization')->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body">
                <i class="fas fa-calendar text-info display-6 mb-2"></i>
                <h6 class="card-title">Baru Bulan Ini</h6>
                <h4 class="text-info">{{ $teachers->where('hire_date', '>=', now()->startOfMonth())->count() }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Teachers Table -->
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-list me-2"></i>Daftar Guru
                </h6>
                <div class="d-flex gap-2">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari guru..." id="searchTeacher">
                    </div>
                    <button class="btn btn-outline-success btn-sm" onclick="exportData()">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                @if($teachers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="teachersTable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Guru</th>
                                    <th>NIP</th>
                                    <th>Email</th>
                                    <th>Spesialisasi</th>
                                    <th>Pendidikan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $index => $teacher)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="teacher-avatar">
                                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 40px; height: 40px;">
                                                {{ substr($teacher->name, 0, 1) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong>{{ $teacher->name }}</strong>
                                            @if($teacher->phone)
                                                <br><small class="text-muted">
                                                    <i class="fas fa-phone me-1"></i>{{ $teacher->phone }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <code>{{ $teacher->nip }}</code>
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $teacher->email }}" class="text-decoration-none">
                                            {{ $teacher->email }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($teacher->subject_specialization)
                                            <span class="badge bg-primary">{{ $teacher->subject_specialization }}</span>
                                        @else
                                            <span class="text-muted">Belum diisi</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $teacher->education_level ?? 'Belum diisi' }}
                                    </td>
                                    <td>
                                        @if($teacher->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.teachers.show', $teacher) }}" 
                                               class="btn btn-outline-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.teachers.edit', $teacher) }}" 
                                               class="btn btn-outline-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    onclick="deleteTeacher({{ $teacher->id }}, '{{ $teacher->name }}')" 
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
                        <i class="fas fa-chalkboard-teacher display-4 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum Ada Data Guru</h5>
                        <p class="text-muted mb-4">Mulai dengan menambahkan guru pertama</p>
                        <a href="{{ route('admin.teachers.create') }}" class="admin-btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Guru Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus guru <strong id="teacherName"></strong>?</p>
                <div class="alert alert-warning">
                    <i class="fas fa-warning me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini akan menghapus akun login guru dan tidak dapat dibatalkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Hapus Guru
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchTeacher').addEventListener('keyup', function() {
    const searchTerm = this.value.toLowerCase();
    const tableRows = document.querySelectorAll('#teachersTable tbody tr');
    
    tableRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Delete teacher function
function deleteTeacher(teacherId, teacherName) {
    document.getElementById('teacherName').textContent = teacherName;
    document.getElementById('deleteForm').action = `/admin/teachers/${teacherId}`;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}

// Export function (placeholder)
function exportData() {
    alert('Fitur export akan segera tersedia');
}

// Success message auto-hide
@if(session('success'))
    setTimeout(() => {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 5000);
@endif
</script>
@endsection