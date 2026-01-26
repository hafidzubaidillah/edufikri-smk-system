@extends('layouts.admin')

@section('title', 'Detail Jurusan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail Jurusan: {{ $major->name }}</h1>
            <p class="mb-0 text-muted">Informasi lengkap jurusan {{ $major->code }}</p>
        </div>
        <div>
            <a href="{{ route('admin.majors.edit', $major) }}" class="btn btn-warning me-2">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Major Info -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Jurusan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Kode Jurusan</strong></td>
                                    <td>: {{ $major->code }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Jurusan</strong></td>
                                    <td>: {{ $major->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kepala Jurusan</strong></td>
                                    <td>: {{ $major->headOfMajor->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status</strong></td>
                                    <td>: 
                                        @if($major->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Kapasitas Total</strong></td>
                                    <td>: {{ $major->capacity }} siswa</td>
                                </tr>
                                <tr>
                                    <td><strong>Siswa Saat Ini</strong></td>
                                    <td>: {{ $major->current_students }} siswa</td>
                                </tr>
                                <tr>
                                    <td><strong>Sisa Kapasitas</strong></td>
                                    <td>: {{ $major->remaining_capacity }} siswa</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah Kelas</strong></td>
                                    <td>: {{ $major->classes->count() }} kelas</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($major->description)
                        <div class="mt-3">
                            <h6><strong>Deskripsi:</strong></h6>
                            <p class="text-muted">{{ $major->description }}</p>
                        </div>
                    @endif

                    <!-- Capacity Progress -->
                    <div class="mt-3">
                        <h6><strong>Persentase Kapasitas Terisi:</strong></h6>
                        <div class="progress mb-2">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: {{ $major->capacity_percentage }}%" 
                                 aria-valuenow="{{ $major->capacity_percentage }}" 
                                 aria-valuemin="0" aria-valuemax="100">
                                {{ $major->capacity_percentage }}%
                            </div>
                        </div>
                        <small class="text-muted">{{ $major->current_students }} dari {{ $major->capacity }} siswa</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik</h6>
                </div>
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="h5 mb-0 font-weight-bold text-primary">{{ $major->classes->count() }}</div>
                            <div class="text-xs text-gray-500">Kelas</div>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-success">{{ $subjects->count() }}</div>
                            <div class="text-xs text-gray-500">Mata Pelajaran</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes -->
    @if($major->classes->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kelas di Jurusan Ini</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($major->classes as $class)
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-primary">
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-primary">{{ $class->name }}</h6>
                                    <p class="text-sm text-muted mb-1">Kelas {{ $class->grade }}</p>
                                    <p class="text-sm text-muted mb-1">{{ $class->current_students }}/{{ $class->capacity }} siswa</p>
                                    <p class="text-sm text-muted mb-0">Tahun: {{ $class->academic_year }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Subjects -->
    @if($subjects->count() > 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mata Pelajaran untuk Jurusan Ini</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($subjects as $subject)
                        <div class="col-md-4 mb-3">
                            <div class="card border-left-info">
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-info">{{ $subject->name }}</h6>
                                    <p class="text-sm text-muted mb-1">Kode: {{ $subject->code }}</p>
                                    <p class="text-sm text-muted mb-1">{{ $subject->hours_per_week }} jam/minggu</p>
                                    <p class="text-sm text-muted mb-2">Kategori: {{ $subject->category_label }}</p>
                                    @if($subject->is_mandatory)
                                        <span class="badge bg-danger">Wajib</span>
                                    @else
                                        <span class="badge bg-info">Pilihan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection