@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">🆘 Bantuan & Panduan</h2>
                    <p class="text-muted mb-0">Pusat bantuan untuk siswa EDUFIKRI</p>
                </div>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Help Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-question-circle text-primary display-4 mb-3"></i>
                    <h5 class="card-title">FAQ</h5>
                    <p class="card-text">Pertanyaan yang sering diajukan dan jawabannya</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-book text-success display-4 mb-3"></i>
                    <h5 class="card-title">Panduan Penggunaan</h5>
                    <p class="card-text">Cara menggunakan fitur-fitur sistem EDUFIKRI</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-headset text-warning display-4 mb-3"></i>
                    <h5 class="card-title">Kontak Support</h5>
                    <p class="card-text">Hubungi tim teknis untuk bantuan langsung</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>Pertanyaan yang Sering Diajukan (FAQ)
                    </h6>
                </div>
                <div class="card-body">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    Bagaimana cara melakukan absensi dengan QR Code?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Klik menu "Absensi QR Code" di dashboard</li>
                                        <li>Izinkan akses kamera pada browser</li>
                                        <li>Arahkan kamera ke QR Code yang ditampilkan guru</li>
                                        <li>Tunggu konfirmasi absensi berhasil</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    Bagaimana cara mengubah password akun?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Klik menu "Profil Saya" di dashboard</li>
                                        <li>Scroll ke bagian "Update Password"</li>
                                        <li>Masukkan password lama dan password baru</li>
                                        <li>Klik "Update Password"</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    Mengapa saya tidak bisa melihat nilai?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Fitur nilai sedang dalam tahap pengembangan. Nilai akan tersedia setelah:
                                    <ul>
                                        <li>Guru memasukkan nilai ke sistem</li>
                                        <li>Admin mengaktifkan fitur penilaian</li>
                                        <li>Sistem penilaian selesai dikembangkan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                    Bagaimana cara melihat pengumuman terbaru?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Klik menu "Pengumuman" di dashboard</li>
                                        <li>Pengumuman terbaru akan muncul di bagian atas</li>
                                        <li>Perhatikan badge prioritas untuk pengumuman penting</li>
                                        <li>Periksa secara berkala untuk update terbaru</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 5 - Lupa Password -->
                        <div class="accordion-item border-warning">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5">
                                    <i class="fas fa-key me-2"></i>Lupa Password? Bagaimana cara reset?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body bg-warning bg-opacity-10">
                                    <div class="alert alert-warning border-0">
                                        <h6 class="alert-heading">
                                            <i class="fas fa-exclamation-triangle me-2"></i>Penting!
                                        </h6>
                                        <p class="mb-0">Sistem tidak menyediakan fitur reset password otomatis. Untuk keamanan, hanya administrator yang dapat mereset password.</p>
                                    </div>
                                    
                                    <h6 class="text-warning mb-3">
                                        <i class="fas fa-user-shield me-2"></i>Hubungi Administrator:
                                    </h6>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-white rounded border">
                                                <i class="fas fa-phone text-success me-3"></i>
                                                <div>
                                                    <strong>WhatsApp Admin</strong>
                                                    <br><a href="https://wa.me/6281234567890" target="_blank" class="text-success">+62 812-3456-7890</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-white rounded border">
                                                <i class="fas fa-envelope text-primary me-3"></i>
                                                <div>
                                                    <strong>Email Admin</strong>
                                                    <br><a href="mailto:admin@smk-ihsanulfikri.edu" class="text-primary">admin@smk-ihsanulfikri.edu</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-white rounded border">
                                                <i class="fas fa-clock text-warning me-3"></i>
                                                <div>
                                                    <strong>Jam Kerja</strong>
                                                    <br><small class="text-muted">Senin - Jumat: 07:00 - 16:00</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center p-3 bg-white rounded border">
                                                <i class="fas fa-map-marker-alt text-danger me-3"></i>
                                                <div>
                                                    <strong>Ruang Admin</strong>
                                                    <br><small class="text-muted">Lantai 1, Ruang TU</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 p-3 bg-info bg-opacity-10 rounded border border-info">
                                        <h6 class="text-info mb-2">
                                            <i class="fas fa-info-circle me-2"></i>Informasi yang Diperlukan:
                                        </h6>
                                        <ul class="small mb-0">
                                            <li>Nama lengkap siswa</li>
                                            <li>Kelas dan jurusan</li>
                                            <li>NIS (Nomor Induk Siswa)</li>
                                            <li>Email yang terdaftar di sistem</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Guide -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-book me-2"></i>Panduan Penggunaan Sistem
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">🎯 Fitur Utama:</h6>
                            <ul class="small">
                                <li><strong>Dashboard:</strong> Ringkasan informasi siswa</li>
                                <li><strong>Absensi QR:</strong> Scan QR Code untuk absensi</li>
                                <li><strong>Profil:</strong> Kelola data pribadi</li>
                                <li><strong>Pengumuman:</strong> Baca info terbaru</li>
                                <li><strong>Jadwal:</strong> Lihat mata pelajaran</li>
                                <li><strong>Nilai:</strong> Pantau perkembangan akademik</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-success">💡 Tips Penggunaan:</h6>
                            <ul class="small">
                                <li>Selalu logout setelah selesai menggunakan</li>
                                <li>Jangan bagikan password ke orang lain</li>
                                <li>Periksa pengumuman secara rutin</li>
                                <li>Update profil jika ada perubahan data</li>
                                <li>Laporkan masalah teknis ke admin</li>
                                <li>Gunakan browser terbaru untuk performa optimal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-headset me-2"></i>Kontak Support
                    </h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info border-0 mb-4">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>Butuh Bantuan Teknis?
                        </h6>
                        <p class="mb-0">Untuk masalah teknis, lupa password, atau pertanyaan lainnya, hubungi administrator sekolah melalui kontak di bawah ini.</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-user-shield text-primary display-6 mb-2"></i>
                                <h6>Administrator</h6>
                                <p class="small text-muted">SMK IT Ihsanul Fikri</p>
                                <span class="badge bg-primary">Admin Sistem</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fab fa-whatsapp text-success display-6 mb-2"></i>
                                <h6>WhatsApp</h6>
                                <p class="small text-muted">+62 812-3456-7890</p>
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="fab fa-whatsapp me-1"></i>Chat Admin
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center p-3 border rounded">
                                <i class="fas fa-envelope text-warning display-6 mb-2"></i>
                                <h6>Email</h6>
                                <p class="small text-muted">admin@smk-ihsanulfikri.edu</p>
                                <a href="mailto:admin@smk-ihsanulfikri.edu" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-paper-plane me-1"></i>Kirim Email
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="fas fa-clock text-info me-3"></i>
                                <div>
                                    <strong>Jam Kerja Admin</strong>
                                    <br><small class="text-muted">Senin - Jumat: 07:00 - 16:00 WIB</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <i class="fas fa-map-marker-alt text-danger me-3"></i>
                                <div>
                                    <strong>Lokasi</strong>
                                    <br><small class="text-muted">Ruang Tata Usaha (TU), Lantai 1</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection