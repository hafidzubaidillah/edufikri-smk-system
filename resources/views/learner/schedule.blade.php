@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">📅 Jadwal Pelajaran</h2>
                    <p class="text-muted mb-0">Kelas: {{ $learner->section }} | Tingkat: {{ $learner->grade_level }}</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Class Info -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-info text-white border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2">Informasi Kelas</h5>
                            <p class="mb-1">Kelas: {{ $learner->section }}</p>
                            <p class="mb-0">Tingkat: Kelas {{ $learner->grade_level == 10 ? 'X' : ($learner->grade_level == 11 ? 'XI' : 'XII') }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <i class="fas fa-chalkboard-teacher display-4 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-list me-2"></i>Mata Pelajaran
                    </h6>
                </div>
                <div class="card-body">
                    @if($classSubjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Guru Pengajar</th>
                                        <th>Kode</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($classSubjects as $index => $classSubject)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $classSubject->subject->name }}</strong>
                                            @if($classSubject->subject->description)
                                                <br><small class="text-muted">{{ $classSubject->subject->description }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($classSubject->teacher)
                                                <i class="fas fa-user-tie me-1"></i>{{ $classSubject->teacher->name }}
                                            @else
                                                <span class="text-muted">Belum ditentukan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <code>{{ $classSubject->subject->code }}</code>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Aktif</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times display-4 text-muted mb-3"></i>
                            <h5 class="text-muted">Belum Ada Jadwal</h5>
                            <p class="text-muted">Jadwal pelajaran untuk kelas Anda belum tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi Tambahan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">📚 Catatan Penting:</h6>
                            <ul class="small mb-0">
                                <li>Jadwal dapat berubah sewaktu-waktu</li>
                                <li>Perhatikan pengumuman untuk perubahan jadwal</li>
                                <li>Hubungi wali kelas untuk informasi lebih lanjut</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success">🕐 Jam Pelajaran:</h6>
                            <ul class="small mb-0">
                                <li>Jam ke-1: 07:00 - 07:45</li>
                                <li>Jam ke-2: 07:45 - 08:30</li>
                                <li>Istirahat: 08:30 - 08:45</li>
                                <li>Jam ke-3: 08:45 - 09:30</li>
                                <li>Dan seterusnya...</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8, #20c997) !important;
}
</style>
@endsection