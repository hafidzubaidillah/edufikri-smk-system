@extends('layouts.admin')

@section('title', 'Detail Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Mata Pelajaran</h1>
            <p class="text-muted">Informasi lengkap mata pelajaran: <strong>{{ $subject->name }}</strong></p>
        </div>
        <div>
            <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Subject Info -->
        <div class="col-lg-8">
            <!-- Basic Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Dasar</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Nama:</strong></td>
                                    <td>{{ $subject->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kode:</strong></td>
                                    <td><code class="bg-light p-1">{{ $subject->code }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori:</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $subject->category === 'umum' ? 'primary' : ($subject->category === 'kejuruan' ? 'success' : ($subject->category === 'agama' ? 'warning' : 'info')) }}">
                                            {{ $subject->category_label }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jam/Minggu:</strong></td>
                                    <td>
                                        <span class="badge badge-info">{{ $subject->hours_per_week }} jam</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Tingkat:</strong></td>
                                    <td>
                                        @if($subject->grade_level === 'all')
                                            <span class="badge badge-secondary">Semua Tingkat</span>
                                        @else
                                            <span class="badge badge-outline-secondary">Kelas {{ $subject->grade_level }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan:</strong></td>
                                    <td>
                                        @if($subject->majors)
                                            @foreach($subject->majors as $major)
                                                <span class="badge badge-light">{{ $major }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Semua Jurusan</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($subject->is_active)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis:</strong></td>
                                    <td>
                                        @if($subject->is_mandatory)
                                            <span class="badge badge-warning">
                                                <i class="fas fa-star"></i> Wajib
                                            </span>
                                        @else
                                            <span class="badge badge-light">Tambahan</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($subject->description)
                    <hr>
                    <div>
                        <strong>Deskripsi:</strong>
                        <p class="mt-2">{{ $subject->description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Classes Using This Subject -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Kelas yang Menggunakan ({{ $subject->classes->count() }})</h6>
                    @if(!$subject->is_mandatory)
                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#assignClassModal">
                        <i class="fas fa-plus"></i> Tugaskan ke Kelas
                    </button>
                    @endif
                </div>
                <div class="card-body">
                    @if($subject->classes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kelas</th>
                                        <th>Guru</th>
                                        <th>Jadwal</th>
                                        <th>Ruang</th>
                                        <th>Siswa</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subject->classes as $class)
                                    <tr>
                                        <td>
                                            <strong>{{ $class->full_name }}</strong>
                                            <br><small class="text-muted">{{ $class->major }}</small>
                                        </td>
                                        <td>
                                            @if($class->pivot->teacher_name)
                                                {{ $class->pivot->teacher_name }}
                                                @if($class->pivot->teacher_email)
                                                    <br><small class="text-muted">{{ $class->pivot->teacher_email }}</small>
                                                @endif
                                            @else
                                                <span class="text-muted">Belum ditentukan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($class->pivot->schedule_day)
                                                {{ ucfirst($class->pivot->schedule_day) }}
                                                @if($class->pivot->start_time && $class->pivot->end_time)
                                                    <br><small>{{ $class->pivot->start_time }} - {{ $class->pivot->end_time }}</small>
                                                @endif
                                            @else
                                                <span class="text-muted">Belum dijadwalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $class->pivot->room ?? '-' }}
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $class->current_students }}/{{ $class->capacity }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($class->pivot->is_active)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chalkboard fa-3x text-gray-300 mb-3"></i>
                            <p class="text-muted">Mata pelajaran ini belum ditugaskan ke kelas manapun.</p>
                            @if(!$subject->is_mandatory)
                                <button class="btn btn-primary" data-toggle="modal" data-target="#assignClassModal">
                                    <i class="fas fa-plus"></i> Tugaskan ke Kelas
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Stats -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-right">
                                <h4 class="text-primary">{{ $subject->classes->count() }}</h4>
                                <small class="text-muted">Kelas</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success">{{ $subject->classes->sum('current_students') }}</h4>
                            <small class="text-muted">Total Siswa</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-warning btn-block">
                            <i class="fas fa-edit"></i> Edit Mata Pelajaran
                        </a>
                        @if(!$subject->is_mandatory)
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#assignClassModal">
                            <i class="fas fa-plus"></i> Tugaskan ke Kelas
                        </button>
                        @endif
                        @if($subject->classes->count() == 0)
                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-trash"></i> Hapus Mata Pelajaran
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="card border-left-info shadow">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Informasi
                    </div>
                    <div class="text-gray-800">
                        <small>
                            @if($subject->is_mandatory)
                                Mata pelajaran wajib akan otomatis ditugaskan ke semua kelas yang sesuai dengan tingkat dan jurusan.
                            @else
                                Mata pelajaran tambahan harus ditugaskan manual ke kelas tertentu.
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Assign Class Modal -->
@if(!$subject->is_mandatory)
<div class="modal fade" id="assignClassModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tugaskan ke Kelas</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="assignClassForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    
                    <div class="form-group">
                        <label>Pilih Kelas</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            <!-- Will be populated via AJAX -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="teacher_name" class="form-control" placeholder="Nama guru pengampu">
                    </div>

                    <div class="form-group">
                        <label>Email Guru</label>
                        <input type="email" name="teacher_email" class="form-control" placeholder="email@guru.com">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hari</label>
                                <select name="schedule_day" class="form-control">
                                    <option value="">Pilih Hari</option>
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
                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="time" name="start_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="time" name="end_time" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Ruang</label>
                        <input type="text" name="room" class="form-control" placeholder="Contoh: Lab Komputer 1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tugaskan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script>
$(document).ready(function() {
    // Load available classes when modal opens
    $('#assignClassModal').on('show.bs.modal', function() {
        // Load classes via AJAX (you'll need to implement this endpoint)
        // For now, we'll add some dummy options
        let classSelect = $('select[name="class_id"]');
        classSelect.html('<option value="">Loading...</option>');
        
        // This would be replaced with actual AJAX call
        setTimeout(function() {
            classSelect.html(`
                <option value="">Pilih Kelas</option>
                <option value="1">Kelas X TKJ 1</option>
                <option value="2">Kelas X TKJ 2</option>
                <option value="3">Kelas XI RPL 1</option>
            `);
        }, 500);
    });

    // Handle form submission
    $('#assignClassForm').on('submit', function(e) {
        e.preventDefault();
        
        let formData = $(this).serialize();
        
        $.ajax({
            url: '{{ route("admin.subjects.assign-to-class") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Mata pelajaran berhasil ditugaskan ke kelas!');
                location.reload();
            },
            error: function(xhr) {
                let error = xhr.responseJSON?.error || 'Terjadi kesalahan';
                alert(error);
            }
        });
    });
});
</script>
@endpush
@endsection