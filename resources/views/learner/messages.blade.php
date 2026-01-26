@extends('layouts.student')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">💬 Pesan</h2>
                <p class="text-muted mb-0">Kotak masuk dan komunikasi</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Pesan Baru
                </button>
                <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Message Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-inbox text-primary display-6 mb-2"></i>
                <h6 class="card-title">Total Pesan</h6>
                <h4 class="text-primary">{{ $messages->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-envelope text-danger display-6 mb-2"></i>
                <h6 class="card-title">Belum Dibaca</h6>
                <h4 class="text-danger">{{ $messages->where('is_read', false)->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-paper-plane text-success display-6 mb-2"></i>
                <h6 class="card-title">Terkirim</h6>
                <h4 class="text-success">8</h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="student-card text-center">
            <div class="card-body">
                <i class="fas fa-star text-warning display-6 mb-2"></i>
                <h6 class="card-title">Penting</h6>
                <h4 class="text-warning">2</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Message List -->
    <div class="col-md-4">
        <div class="student-card">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-list me-2"></i>Kotak Masuk
                </h6>
                <button class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-sync"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <!-- Search -->
                <div class="p-3 border-bottom">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Cari pesan...">
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="p-3 border-bottom">
                    <div class="btn-group w-100" role="group">
                        <input type="radio" class="btn-check" name="messageFilter" id="all" checked>
                        <label class="btn btn-outline-primary btn-sm" for="all">Semua</label>
                        
                        <input type="radio" class="btn-check" name="messageFilter" id="unread">
                        <label class="btn btn-outline-danger btn-sm" for="unread">Belum Dibaca</label>
                        
                        <input type="radio" class="btn-check" name="messageFilter" id="important">
                        <label class="btn btn-outline-warning btn-sm" for="important">Penting</label>
                    </div>
                </div>

                <!-- Message List -->
                <div class="message-list" style="max-height: 500px; overflow-y: auto;">
                    @foreach($messages as $message)
                    <div class="message-item p-3 border-bottom {{ !$message->is_read ? 'bg-light' : '' }}" 
                         data-message-id="{{ $message->id }}" 
                         style="cursor: pointer;">
                        <div class="d-flex align-items-start">
                            <div class="message-avatar me-3">
                                <div class="bg-{{ $message->from == 'Sistem EDUFIKRI' ? 'info' : 'secondary' }} text-white rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px;">
                                    <i class="fas fa-{{ $message->from == 'Sistem EDUFIKRI' ? 'robot' : 'user' }}"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="mb-0 small {{ !$message->is_read ? 'fw-bold' : '' }}">
                                        {{ $message->from }}
                                    </h6>
                                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1 small {{ !$message->is_read ? 'fw-bold' : '' }}">
                                    {{ $message->subject }}
                                </p>
                                <p class="mb-0 text-muted small">
                                    {{ Str::limit($message->preview, 50) }}
                                </p>
                                @if(!$message->is_read)
                                    <span class="badge bg-danger badge-sm mt-1">Baru</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Message Content -->
    <div class="col-md-8">
        <div class="student-card" id="messageContent">
            <div class="card-body text-center py-5">
                <i class="fas fa-envelope-open display-4 text-muted mb-3"></i>
                <h5 class="text-muted">Pilih Pesan</h5>
                <p class="text-muted">Klik pada pesan di sebelah kiri untuk membacanya</p>
            </div>
        </div>
    </div>
</div>

<!-- Compose Message Modal -->
<div class="modal fade" id="composeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Tulis Pesan Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Kepada</label>
                        <select class="form-select">
                            <option>Pilih penerima...</option>
                            <option>Wali Kelas</option>
                            <option>Guru Matematika</option>
                            <option>Guru Bahasa Indonesia</option>
                            <option>Admin Sekolah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subjek</label>
                        <input type="text" class="form-control" placeholder="Masukkan subjek pesan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea class="form-control" rows="6" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lampiran</label>
                        <input type="file" class="form-control" multiple>
                        <small class="text-muted">Maksimal 5MB per file</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-1"></i>Kirim Pesan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sample message content for demo
    const messageContents = {
        1: {
            from: 'Pak Ahmad (Guru Matematika)',
            subject: 'Tugas Matematika Minggu Ini',
            time: '1 jam yang lalu',
            content: `
                <p>Selamat siang,</p>
                <p>Berikut adalah tugas matematika untuk minggu ini:</p>
                <ul>
                    <li>Kerjakan soal halaman 45-50</li>
                    <li>Fokus pada materi integral</li>
                    <li>Deadline: Jumat, 26 Januari 2026</li>
                </ul>
                <p>Jika ada pertanyaan, silakan hubungi saya.</p>
                <p>Terima kasih,<br>Pak Ahmad</p>
            `
        },
        2: {
            from: 'Admin Sekolah',
            subject: 'Pengumuman Ujian Tengah Semester',
            time: '3 jam yang lalu',
            content: `
                <p>Kepada seluruh siswa,</p>
                <p>Dengan ini kami informasikan jadwal Ujian Tengah Semester:</p>
                <ul>
                    <li>Tanggal: 3-7 Februari 2026</li>
                    <li>Waktu: 07:30 - 10:30 WIB</li>
                    <li>Tempat: Ruang kelas masing-masing</li>
                </ul>
                <p>Harap mempersiapkan diri dengan baik.</p>
                <p>Salam,<br>Admin Sekolah</p>
            `
        },
        3: {
            from: 'Bu Sari (Wali Kelas)',
            subject: 'Rapat Orang Tua',
            time: '1 hari yang lalu',
            content: `
                <p>Kepada orang tua/wali siswa,</p>
                <p>Kami mengundang Bapak/Ibu untuk menghadiri rapat orang tua:</p>
                <ul>
                    <li>Hari: Sabtu, 1 Februari 2026</li>
                    <li>Waktu: 09:00 - 11:00 WIB</li>
                    <li>Tempat: Aula sekolah</li>
                </ul>
                <p>Agenda: Pembahasan perkembangan akademik siswa</p>
                <p>Hormat kami,<br>Bu Sari</p>
            `
        }
    };

    // Handle message click
    document.querySelectorAll('.message-item').forEach(item => {
        item.addEventListener('click', function() {
            const messageId = this.dataset.messageId;
            const content = messageContents[messageId];
            
            if (content) {
                document.getElementById('messageContent').innerHTML = `
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">${content.subject}</h6>
                                <small class="text-muted">Dari: ${content.from}</small>
                            </div>
                            <small class="text-muted">${content.time}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        ${content.content}
                        <hr>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-reply me-1"></i>Balas
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-forward me-1"></i>Teruskan
                            </button>
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </div>
                    </div>
                `;
                
                // Mark as read
                this.classList.remove('bg-light');
                this.querySelector('.fw-bold')?.classList.remove('fw-bold');
                this.querySelector('.badge')?.remove();
            }
        });
    });

    // Handle compose button
    document.querySelector('.btn-primary').addEventListener('click', function() {
        if (this.textContent.includes('Pesan Baru')) {
            const modal = new bootstrap.Modal(document.getElementById('composeModal'));
            modal.show();
        }
    });
});
</script>

<style>
.message-item:hover {
    background-color: #f8f9fa !important;
}
.message-list {
    scrollbar-width: thin;
}
.message-list::-webkit-scrollbar {
    width: 6px;
}
.message-list::-webkit-scrollbar-track {
    background: #f1f1f1;
}
.message-list::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}
</style>
@endsection