@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">🏆 Nilai & Rapor</h2>
                    <p class="text-muted mb-0">Pantau perkembangan akademik Anda</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Student Info -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-success text-white border-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2">Informasi Siswa</h5>
                            <p class="mb-1">Nama: {{ $learner->name }}</p>
                            <p class="mb-1">NIS: {{ $learner->student_id }}</p>
                            <p class="mb-0">Kelas: {{ $learner->section }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <i class="fas fa-user-graduate display-4 opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grades Overview -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-chart-line text-primary display-6 mb-2"></i>
                    <h6 class="card-title">Rata-rata</h6>
                    <h4 class="text-primary">-</h4>
                    <small class="text-muted">Belum tersedia</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-star text-warning display-6 mb-2"></i>
                    <h6 class="card-title">Nilai Tertinggi</h6>
                    <h4 class="text-warning">-</h4>
                    <small class="text-muted">Belum tersedia</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-book text-info display-6 mb-2"></i>
                    <h6 class="card-title">Mata Pelajaran</h6>
                    <h4 class="text-info">-</h4>
                    <small class="text-muted">Belum tersedia</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-trophy text-success display-6 mb-2"></i>
                    <h6 class="card-title">Ranking</h6>
                    <h4 class="text-success">-</h4>
                    <small class="text-muted">Belum tersedia</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Grades Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-list-alt me-2"></i>Daftar Nilai
                    </h6>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active">Semester 1</button>
                        <button type="button" class="btn btn-outline-primary">Semester 2</button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Coming Soon Message -->
                    <div class="text-center py-5">
                        <i class="fas fa-construction display-4 text-muted mb-3"></i>
                        <h5 class="text-muted">Fitur Dalam Pengembangan</h5>
                        <p class="text-muted mb-4">Sistem penilaian sedang dalam tahap pengembangan.<br>Nilai dan rapor akan tersedia segera.</p>
                        
                        <!-- Sample Table Structure -->
                        <div class="text-start">
                            <h6 class="text-primary mb-3">Preview Struktur Nilai:</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Mata Pelajaran</th>
                                            <th>UH 1</th>
                                            <th>UH 2</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Rata-rata</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-muted">
                                            <td>Matematika</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr class="text-muted">
                                            <td>Bahasa Indonesia</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                        <tr class="text-muted">
                                            <td>Bahasa Inggris</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
                        <i class="fas fa-info-circle me-2"></i>Informasi Penilaian
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">📊 Sistem Penilaian:</h6>
                            <ul class="small mb-0">
                                <li>UH (Ulangan Harian): 30%</li>
                                <li>UTS (Ujian Tengah Semester): 30%</li>
                                <li>UAS (Ujian Akhir Semester): 40%</li>
                                <li>Nilai minimum kelulusan: 75</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success">🎯 Grade Penilaian:</h6>
                            <ul class="small mb-0">
                                <li>A: 90-100 (Sangat Baik)</li>
                                <li>B: 80-89 (Baik)</li>
                                <li>C: 75-79 (Cukup)</li>
                                <li>D: 60-74 (Kurang)</li>
                                <li>E: <60 (Sangat Kurang)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-success {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
}
</style>
@endsection