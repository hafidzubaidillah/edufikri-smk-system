@extends('layouts.admin')

@section('title', 'Manajemen Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Manajemen Mata Pelajaran</h1>
            <p class="text-muted">Kelola mata pelajaran wajib dan tambahan untuk sekolah</p>
        </div>
        <div>
            <button id="assignMandatoryBtn" class="btn btn-success me-2">
                <i class="fas fa-magic"></i> Tugaskan Mata Pelajaran Wajib ke Semua Kelas
            </button>
            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mata Pelajaran
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Mata Pelajaran
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Mata Pelajaran Wajib
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['mandatory'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Mata Pelajaran Tambahan
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['optional'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Mata Pelajaran Aktif
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $stats['active'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subjects Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kategori</th>
                            <th>Tingkat</th>
                            <th>Jurusan</th>
                            <th>Jam/Minggu</th>
                            <th>Status</th>
                            <th>Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $subject)
                        <tr>
                            <td><code>{{ $subject->code }}</code></td>
                            <td>
                                <strong>{{ $subject->name }}</strong>
                                @if($subject->description)
                                    <br><small class="text-muted">{{ Str::limit($subject->description, 50) }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $subject->category === 'umum' ? 'primary' : ($subject->category === 'kejuruan' ? 'success' : ($subject->category === 'agama' ? 'warning' : 'info')) }}">
                                    {{ $subject->category_label }}
                                </span>
                            </td>
                            <td>
                                @if($subject->grade_level === 'all')
                                    <span class="badge badge-secondary">Semua Tingkat</span>
                                @else
                                    <span class="badge badge-outline-secondary">Kelas {{ $subject->grade_level }}</span>
                                @endif
                            </td>
                            <td>
                                @if($subject->majors)
                                    @php
                                        $majors = is_array($subject->majors) ? $subject->majors : json_decode($subject->majors, true);
                                    @endphp
                                    @if($majors && is_array($majors))
                                        @foreach($majors as $major)
                                            <span class="badge badge-light">{{ $major }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Semua Jurusan</span>
                                    @endif
                                @else
                                    <span class="text-muted">Semua Jurusan</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-info">{{ $subject->hours_per_week }} jam</span>
                            </td>
                            <td>
                                @if($subject->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                @if($subject->is_mandatory)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-star"></i> Wajib
                                    </span>
                                @else
                                    <span class="badge badge-light">Tambahan</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.subjects.show', $subject) }}" 
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.subjects.edit', $subject) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(!$subject->is_mandatory)
                                    <form action="{{ route('admin.subjects.destroy', $subject) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-book fa-3x text-gray-300 mb-3"></i>
                                <p class="text-muted">Belum ada mata pelajaran yang ditambahkan.</p>
                                <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Mata Pelajaran Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($subjects->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $subjects->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "language": {
            "search": "Cari:",
            "zeroRecords": "Tidak ada data yang ditemukan",
            "emptyTable": "Tidak ada data dalam tabel"
        }
    });

    // Handle assign mandatory subjects to all classes
    $('#assignMandatoryBtn').on('click', function() {
        if (confirm('Yakin ingin menugaskan semua mata pelajaran wajib ke semua kelas? Ini akan memproses semua kelas aktif.')) {
            let btn = $(this);
            let originalText = btn.html();
            
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
            
            $.ajax({
                url: '{{ route("admin.subjects.assign-mandatory-to-all") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.success);
                    location.reload();
                },
                error: function(xhr) {
                    let error = xhr.responseJSON?.error || 'Terjadi kesalahan';
                    alert('Error: ' + error);
                },
                complete: function() {
                    btn.prop('disabled', false).html(originalText);
                }
            });
        }
    });
});
</script>
@endpush
@endsection