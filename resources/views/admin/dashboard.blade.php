@extends('layouts.admin')

@section('title', 'Dashboard SMK IT Ihsanul Fikri')

@section('content')

    @push('styles')
        <style>
            .card-border-left {
                border-left: 8px solid !important;
                border-radius: 0.75rem;
            }
            .card-users { border-color: #0d6efd !important; }
            .card-learners { border-color: #198754 !important; }
            .card-employees { border-color: #6f42c1 !important; }
            .card-mails { border-color: #fd7e14 !important; }
            .card-announcements { border-color: #dc3545 !important; }
            .card-attendance { border-color: #20c997 !important; }
            .card-classes { border-color: #1a5f1a !important; }
            .card-subjects { border-color: #ffc107 !important; }

            .text-purple { color: #6f42c1 !important; }
            .text-teal { color: #20c997 !important; }
            .text-school-green { color: #1a5f1a !important; }
            .text-school-yellow { color: #ffc107 !important; }
            
            .bg-purple { background-color: #6f42c1 !important; }
            
            .bg-gradient-info {
                background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
            }
            
            .bg-gradient-success {
                background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
            }
            
            .bg-gradient-warning {
                background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
            }
            
            .grade-badge {
                display: inline-block;
                padding: 0.25rem 0.5rem;
                border-radius: 0.375rem;
                font-size: 0.875rem;
                font-weight: 600;
                margin: 0.125rem;
            }
            .grade-10 { background-color: #dbeafe; color: #1e40af; }
            .grade-11 { background-color: #dcfce7; color: #166534; }
            .grade-12 { background-color: #fef3c7; color: #92400e; }
            
            .timeline-item {
                position: relative;
            }
            .timeline-item:not(:last-child)::after {
                content: '';
                position: absolute;
                left: 12px;
                top: 30px;
                width: 2px;
                height: calc(100% - 10px);
                background-color: #e9ecef;
            }
        </style>
    @endpush

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">Selamat Datang di Dashboard SMK IT Ihsanul Fikri</h2>
                            <p class="mb-0">Kelola data sekolah, siswa, kelas, dan mata pelajaran dengan mudah</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <i class="fas fa-school display-4 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty State Message -->
    @if(($totalStudents ?? 0) == 0 && ($classCount ?? 0) == 0 && ($subjectCount ?? 0) == 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle fa-2x text-info"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="alert-heading mb-2">🎯 Sistem Siap untuk Input Data Manual!</h5>
                        <p class="mb-2">
                            Sistem EDUFIKRI telah dibersihkan dan siap untuk Anda isi dengan data sekolah yang sesungguhnya. 
                            Mulai dengan menambahkan kelas, mata pelajaran, guru, dan siswa sesuai kebutuhan SMK IT Ihsanul Fikri.
                        </p>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Kelas Pertama
                            </a>
                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-book me-1"></i>Tambah Mata Pelajaran
                            </a>
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#guideModal">
                                <i class="fas fa-question-circle me-1"></i>Panduan Lengkap
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Stats Cards Row 1 -->
    <div class="row g-3 mb-4">
        <!-- Total Students -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-learners text-center shadow-sm">
                <div class="card-body text-success">
                    <i class="fas fa-user-graduate display-6 mb-2"></i>
                    <h5 class="card-title">Total Siswa</h5>
                    <p class="display-6 mb-0">{{ $totalStudents ?? 0 }}</p>
                    <small class="text-muted">Siswa Aktif</small>
                </div>
            </div>
        </div>

        <!-- Total Classes -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-classes text-center shadow-sm">
                <div class="card-body text-school-green">
                    <i class="fas fa-chalkboard display-6 mb-2"></i>
                    <h5 class="card-title">Total Kelas</h5>
                    <p class="display-6 mb-0">{{ $classCount ?? 0 }}</p>
                    <small class="text-muted">Kelas Aktif</small>
                </div>
            </div>
        </div>

        <!-- Total Subjects -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-subjects text-center shadow-sm">
                <div class="card-body text-school-yellow">
                    <i class="fas fa-book display-6 mb-2"></i>
                    <h5 class="card-title">Mata Pelajaran</h5>
                    <p class="display-6 mb-0">{{ $subjectCount ?? 0 }}</p>
                    <small class="text-muted">Mapel Aktif</small>
                </div>
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-employees text-center shadow-sm">
                <div class="card-body text-purple">
                    <i class="fas fa-chalkboard-teacher display-6 mb-2"></i>
                    <h5 class="card-title">Total Guru</h5>
                    <p class="display-6 mb-0">{{ $teacherCount ?? 0 }}</p>
                    <small class="text-muted">Guru Aktif</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row 2 -->
    <div class="row g-3 mb-4">
        <!-- Total Learners -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-learners text-center shadow-sm">
                <div class="card-body text-success">
                    <i class="fas fa-id-card display-6 mb-2"></i>
                    <h5 class="card-title">Data Learners</h5>
                    <p class="display-6 mb-0">{{ $learnerCount }}</p>
                    <small class="text-muted">Profil Siswa</small>
                </div>
            </div>
        </div>

        <!-- Total Mail Logs -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-mails text-center shadow-sm">
                <div class="card-body text-warning">
                    <i class="fas fa-envelope display-6 mb-2"></i>
                    <h5 class="card-title">Email Logs</h5>
                    <p class="display-6 mb-0">{{ $mailLogCount }}</p>
                    <small class="text-muted">Email Terkirim</small>
                </div>
            </div>
        </div>

        <!-- Total Announcements -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-announcements text-center shadow-sm">
                <div class="card-body text-danger">
                    <i class="fas fa-bullhorn display-6 mb-2"></i>
                    <h5 class="card-title">Pengumuman</h5>
                    <p class="display-6 mb-0">{{ $announcementCount }}</p>
                    <small class="text-muted">Total Pengumuman</small>
                </div>
            </div>
        </div>

        <!-- Total Attendance -->
        <div class="col-md-4 col-xl-3">
            <div class="card card-border-left card-attendance text-center shadow-sm">
                <div class="card-body text-teal">
                    <i class="fas fa-clipboard-check display-6 mb-2"></i>
                    <h5 class="card-title">Absensi</h5>
                    <p class="display-6 mb-0">{{ $attendanceCount }}</p>
                    <small class="text-muted">Record Absensi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Tools Row -->
    <div class="row g-3 mb-4">
        <!-- Password Management -->
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm bg-gradient-info text-white">
                <div class="card-body text-center">
                    <i class="fas fa-key display-6 mb-3"></i>
                    <h5 class="card-title">Kelola Password</h5>
                    <p class="mb-3">Lihat dan reset password semua pengguna sistem</p>
                    <a href="{{ route('admin.users.passwords') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-cog me-1"></i>Kelola Password
                    </a>
                </div>
            </div>
        </div>

        <!-- Student Details -->
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-user-graduate display-6 mb-3"></i>
                    <h5 class="card-title">Detail Siswa</h5>
                    <p class="mb-3">Lihat informasi lengkap setiap siswa</p>
                    <a href="{{ route('admin.learners.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-eye me-1"></i>Lihat Detail Siswa
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-12 col-xl-4">
            <div class="card border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body text-center">
                    <i class="fas fa-bolt display-6 mb-3"></i>
                    <h5 class="card-title">Aksi Cepat</h5>
                    <p class="mb-3">Fitur-fitur baru untuk admin</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('admin.users.passwords') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-key me-1"></i>Password
                        </a>
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-book me-1"></i>Mapel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Details -->
    <div class="row">
        <!-- Class Distribution by Grade -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Distribusi Kelas per Tingkat
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="gradeChart" height="200"></canvas>
                    <div class="mt-3">
                        @if(isset($classByGrade))
                            @foreach($classByGrade as $grade => $count)
                                <span class="grade-badge grade-{{ $grade }}">
                                    Kelas {{ $grade == 10 ? 'X' : ($grade == 11 ? 'XI' : 'XII') }}: {{ $count }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Class Distribution by Major -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Distribusi Kelas per Jurusan
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="majorChart" height="200"></canvas>
                    <div class="mt-3">
                        @if(isset($classByMajor))
                            @foreach($classByMajor as $major => $count)
                                <span class="badge bg-primary me-2 mb-1">{{ $major }}: {{ $count }} kelas</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Subject Distribution -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-books me-2"></i>Distribusi Mata Pelajaran
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="subjectChart" height="200"></canvas>
                    <div class="mt-3">
                        @if(isset($subjectByCategory))
                            @foreach($subjectByCategory as $category => $count)
                                <span class="badge bg-secondary me-2 mb-1">
                                    {{ ucfirst(str_replace('_', ' ', $category)) }}: {{ $count }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.learners.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-users me-2"></i>Kelola Data Siswa
                        </a>
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-success">
                            <i class="fas fa-chalkboard me-2"></i>Kelola Kelas
                        </a>
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-warning">
                            <i class="fas fa-book me-2"></i>Kelola Mata Pelajaran
                        </a>
                        <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline-danger">
                            <i class="fas fa-bullhorn me-2"></i>Buat Pengumuman
                        </a>
                        <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-clipboard-check me-2"></i>Kelola Absensi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guide Modal -->
    <div class="modal fade" id="guideModal" tabindex="-1" aria-labelledby="guideModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="guideModalLabel">
                        <i class="fas fa-book-open me-2"></i>Panduan Input Data Manual
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">📋 Urutan Input Data yang Disarankan:</h6>
                            
                            <div class="timeline">
                                <div class="timeline-item mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-success rounded-pill">1</span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">🏫 Tambah Kelas</h6>
                                            <p class="text-muted mb-1">Buat kelas untuk setiap tingkat dan jurusan (X PPLG 1, XI TJKT 2, dll)</p>
                                            <a href="{{ route('admin.classes.create') }}" class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-plus me-1"></i>Tambah Kelas
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-warning rounded-pill">2</span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">📚 Tambah Mata Pelajaran</h6>
                                            <p class="text-muted mb-1">Buat mata pelajaran umum dan kejuruan sesuai kurikulum SMK</p>
                                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-book me-1"></i>Kelola Mata Pelajaran
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-info rounded-pill">3</span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">👨‍🎓 Tambah Siswa</h6>
                                            <p class="text-muted mb-1">Masukkan data siswa ke kelas yang sudah dibuat</p>
                                            <a href="{{ route('admin.classes.index') }}" class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-users me-1"></i>Kelola Siswa per Kelas
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item mb-3">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-shrink-0">
                                            <span class="badge bg-purple rounded-pill">4</span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">📅 Atur Jadwal</h6>
                                            <p class="text-muted mb-1">Buat jadwal pelajaran dan assign guru pengampu</p>
                                            <a href="{{ route('admin.schedule.index') }}" class="btn btn-outline-secondary btn-sm">
                                                <i class="fas fa-calendar me-1"></i>Kelola Jadwal
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-light mt-4">
                                <h6 class="text-success mb-2">💡 Tips Penting:</h6>
                                <ul class="mb-0 small">
                                    <li>Gunakan format penamaan yang konsisten untuk kelas</li>
                                    <li>Pastikan NIS siswa unik dan tidak duplikat</li>
                                    <li>Backup data secara berkala</li>
                                    <li>Cek panduan lengkap di file <code>MANUAL_DATA_ENTRY_GUIDE.md</code></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                        <i class="fas fa-rocket me-1"></i>Mulai Input Data
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if(session('emailSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Email Sender',
                text: '{{ session('emailSuccess') }}',
                confirmButtonColor: '#3085d6',
                timer: 4000,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        // Grade Distribution Chart
        const gradeChart = new Chart(document.getElementById('gradeChart'), {
            type: 'doughnut',
            data: {
                labels: [
                    @if(isset($classByGrade))
                        @foreach($classByGrade as $grade => $count)
                            'Kelas {{ $grade == 10 ? "X" : ($grade == 11 ? "XI" : "XII") }}',
                        @endforeach
                    @endif
                ],
                datasets: [{
                    data: [
                        @if(isset($classByGrade))
                            @foreach($classByGrade as $grade => $count)
                                {{ $count }},
                            @endforeach
                        @endif
                    ],
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b']
                }]
            },
            options: {
                responsive: true,
                plugins: { 
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' kelas';
                            }
                        }
                    }
                }
            }
        });

        // Major Distribution Chart
        const majorChart = new Chart(document.getElementById('majorChart'), {
            type: 'bar',
            data: {
                labels: [
                    @if(isset($classByMajor))
                        @foreach($classByMajor as $major => $count)
                            '{{ $major }}',
                        @endforeach
                    @endif
                ],
                datasets: [{
                    label: 'Jumlah Kelas',
                    data: [
                        @if(isset($classByMajor))
                            @foreach($classByMajor as $major => $count)
                                {{ $count }},
                            @endforeach
                        @endif
                    ],
                    backgroundColor: ['#1a5f1a', '#ffc107', '#dc3545', '#6f42c1', '#20c997']
                }]
            },
            options: {
                responsive: true,
                scales: { 
                    y: { 
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    } 
                },
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' kelas';
                            }
                        }
                    }
                }
            }
        });

        // Subject Distribution Chart
        const subjectChart = new Chart(document.getElementById('subjectChart'), {
            type: 'pie',
            data: {
                labels: [
                    @if(isset($subjectByCategory))
                        @foreach($subjectByCategory as $category => $count)
                            '{{ ucfirst(str_replace("_", " ", $category)) }}',
                        @endforeach
                    @endif
                ],
                datasets: [{
                    data: [
                        @if(isset($subjectByCategory))
                            @foreach($subjectByCategory as $category => $count)
                                {{ $count }},
                            @endforeach
                        @endif
                    ],
                    backgroundColor: ['#8b5cf6', '#06b6d4', '#f59e0b', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                plugins: { 
                    legend: { position: 'bottom' },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' mata pelajaran';
                            }
                        }
                    }
                }
            }
        });
    </script>

@endpush
