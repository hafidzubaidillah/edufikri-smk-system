@extends('layouts.student')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">👥 Komunitas</h2>
                    <p class="text-muted mb-0">Berinteraksi dengan sesama siswa dan guru</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Buat Post
                    </button>
                    <a href="{{ route('learner.dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Community Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-users text-primary display-6 mb-2"></i>
                    <h6 class="card-title">Total Anggota</h6>
                    <h4 class="text-primary">245</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-comments text-success display-6 mb-2"></i>
                    <h6 class="card-title">Post Hari Ini</h6>
                    <h4 class="text-success">12</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-heart text-danger display-6 mb-2"></i>
                    <h6 class="card-title">Total Likes</h6>
                    <h4 class="text-danger">1.2k</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body">
                    <i class="fas fa-fire text-warning display-6 mb-2"></i>
                    <h6 class="card-title">Trending</h6>
                    <h4 class="text-warning">8</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Post -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="avatar me-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                {{ substr($learner->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <textarea class="form-control border-0 bg-light" rows="3" placeholder="Apa yang ingin Anda bagikan hari ini?"></textarea>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-image me-1"></i>Foto
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-file me-1"></i>File
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-poll me-1"></i>Poll
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-paper-plane me-1"></i>Posting
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home me-1"></i>Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-fire me-1"></i>Trending
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-question me-1"></i>Tanya Jawab
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-share me-1"></i>Sharing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-graduation-cap me-1"></i>Belajar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Posts Feed -->
    <div class="row">
        <div class="col-md-8">
            <!-- Posts -->
            @foreach($posts as $post)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <!-- Post Header -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                {{ substr($post['author'], 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $post['author'] }}</h6>
                            <small class="text-muted">{{ $post['class'] }} • {{ $post['time'] }}</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-bookmark me-2"></i>Simpan</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-flag me-2"></i>Laporkan</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="mb-3">
                        <p class="mb-0">{{ $post['content'] }}</p>
                    </div>

                    <!-- Post Actions -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-heart me-1"></i>{{ $post['likes'] }}
                            </button>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-comment me-1"></i>{{ $post['replies'] }}
                            </button>
                            <button class="btn btn-sm btn-outline-info">
                                <i class="fas fa-share me-1"></i>Bagikan
                            </button>
                        </div>
                        <button class="btn btn-sm btn-outline-success">
                            <i class="fas fa-reply me-1"></i>Balas
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Load More -->
            <div class="text-center">
                <button class="btn btn-outline-primary">
                    <i class="fas fa-plus me-2"></i>Muat Lebih Banyak
                </button>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Popular Topics -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-hashtag me-2"></i>Topik Populer
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-primary">#matematika</span>
                        <small class="text-muted">45 post</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-primary">#ujian</span>
                        <small class="text-muted">32 post</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-primary">#programming</span>
                        <small class="text-muted">28 post</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-primary">#tugas</span>
                        <small class="text-muted">25 post</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary">#tips</span>
                        <small class="text-muted">20 post</small>
                    </div>
                </div>
            </div>

            <!-- Active Members -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-users me-2"></i>Anggota Aktif
                    </h6>
                </div>
                <div class="card-body">
                    @php
                    $activeMembers = [
                        ['name' => 'Ahmad Rizki', 'class' => 'XII TJKT 1', 'posts' => 15],
                        ['name' => 'Siti Nurhaliza', 'class' => 'XI TJKT 2', 'posts' => 12],
                        ['name' => 'Budi Santoso', 'class' => 'X TJKT 1', 'posts' => 10],
                        ['name' => 'Dewi Sartika', 'class' => 'XII TJKT 2', 'posts' => 8],
                    ];
                    @endphp

                    @foreach($activeMembers as $member)
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-3">
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                {{ substr($member['name'], 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 small">{{ $member['name'] }}</h6>
                            <small class="text-muted">{{ $member['class'] }}</small>
                        </div>
                        <small class="text-primary">{{ $member['posts'] }} post</small>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Community Rules -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-gavel me-2"></i>Aturan Komunitas
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li class="mb-2">Gunakan bahasa yang sopan dan santun</li>
                        <li class="mb-2">Tidak diperbolehkan spam atau konten tidak pantas</li>
                        <li class="mb-2">Bantu sesama dengan memberikan jawaban yang konstruktif</li>
                        <li class="mb-2">Hormati perbedaan pendapat</li>
                        <li>Laporkan konten yang melanggar aturan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar {
    position: relative;
}
.nav-pills .nav-link {
    border-radius: 20px;
    margin: 0 5px;
}
.nav-pills .nav-link.active {
    background-color: #0d6efd;
}
</style>
@endsection