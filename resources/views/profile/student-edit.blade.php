@extends('layouts.student')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">👨‍🎓 Edit Profil Siswa</h2>
                <p class="text-muted mb-0">Kelola informasi profil dan data pribadi Anda</p>
            </div>
        </div>
    </div>
</div>

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

<form action="{{ route('learner.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Profile Photo & Basic Info -->
        <div class="col-md-4">
            <div class="student-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-camera me-2"></i>Foto Profil
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($learner->profile_photo)
                            <img src="{{ asset('storage/' . $learner->profile_photo) }}" 
                                 alt="Profile Photo" 
                                 class="rounded-circle" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 120px; height: 120px; font-size: 3rem;">
                                {{ substr($learner->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" 
                           name="profile_photo" accept="image/*">
                    @error('profile_photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">JPG, PNG max 2MB</small>
                </div>
            </div>
            
            <!-- Quick Info -->
            <div class="student-card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Info Siswa
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>NIS:</strong> {{ $learner->student_id }}
                    </div>
                    <div class="mb-2">
                        <strong>Kelas:</strong> {{ $learner->schoolClass->name ?? 'Belum ditentukan' }}
                    </div>
                    <div class="mb-2">
                        <strong>Tingkat:</strong> {{ $learner->grade_level ?? 'Belum diisi' }}
                    </div>
                    <div>
                        <strong>Bergabung:</strong> {{ $learner->enrollment_date ? $learner->enrollment_date->format('d M Y') : 'Belum diisi' }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Profile Form -->
        <div class="col-md-8">
            <!-- Personal Information -->
            <div class="student-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-user me-2"></i>Informasi Pribadi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', $learner->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $learner->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', $learner->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                   name="birth_date" value="{{ old('birth_date', $learner->birth_date?->format('Y-m-d')) }}">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender', $learner->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $learner->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Golongan Darah</label>
                            <select class="form-select @error('blood_type') is-invalid @enderror" name="blood_type">
                                <option value="">Pilih Golongan Darah</option>
                                <option value="A" {{ old('blood_type', $learner->blood_type) == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ old('blood_type', $learner->blood_type) == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ old('blood_type', $learner->blood_type) == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ old('blood_type', $learner->blood_type) == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            @error('blood_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3">{{ old('address', $learner->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Bio/Tentang Saya</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      name="bio" rows="3" maxlength="500" 
                                      placeholder="Ceritakan tentang diri Anda...">{{ old('bio', $learner->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 500 karakter</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Interests & Aspirations -->
            <div class="student-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-heart me-2"></i>Minat & Cita-cita
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hobi</label>
                            <input type="text" class="form-control @error('hobby') is-invalid @enderror" 
                                   name="hobby" value="{{ old('hobby', $learner->hobby) }}"
                                   placeholder="Contoh: Membaca, Olahraga, Musik">
                            @error('hobby')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Cita-cita</label>
                            <textarea class="form-control @error('aspirations') is-invalid @enderror" 
                                      name="aspirations" rows="3" maxlength="500"
                                      placeholder="Apa cita-cita dan impian Anda di masa depan?">{{ old('aspirations', $learner->aspirations) }}</textarea>
                            @error('aspirations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 500 karakter</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Parent Information -->
            <div class="student-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-users me-2"></i>Informasi Orang Tua
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Orang Tua/Wali</label>
                            <input type="text" class="form-control @error('parent_name') is-invalid @enderror" 
                                   name="parent_name" value="{{ old('parent_name', $learner->parent_name) }}">
                            @error('parent_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pekerjaan Orang Tua</label>
                            <input type="text" class="form-control @error('parent_occupation') is-invalid @enderror" 
                                   name="parent_occupation" value="{{ old('parent_occupation', $learner->parent_occupation) }}">
                            @error('parent_occupation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon Orang Tua</label>
                            <input type="text" class="form-control @error('parent_phone') is-invalid @enderror" 
                                   name="parent_phone" value="{{ old('parent_phone', $learner->parent_phone) }}">
                            @error('parent_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Orang Tua</label>
                            <input type="email" class="form-control @error('parent_email') is-invalid @enderror" 
                                   name="parent_email" value="{{ old('parent_email', $learner->parent_email) }}">
                            @error('parent_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Social Media -->
            <div class="student-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-share-alt me-2"></i>Media Sosial
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-instagram text-danger me-1"></i>Instagram
                            </label>
                            <input type="url" class="form-control @error('social_media.instagram') is-invalid @enderror" 
                                   name="social_media[instagram]" 
                                   value="{{ old('social_media.instagram', $learner->social_media['instagram'] ?? '') }}"
                                   placeholder="https://instagram.com/username">
                            @error('social_media.instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-tiktok text-dark me-1"></i>TikTok
                            </label>
                            <input type="url" class="form-control @error('social_media.tiktok') is-invalid @enderror" 
                                   name="social_media[tiktok]" 
                                   value="{{ old('social_media.tiktok', $learner->social_media['tiktok'] ?? '') }}"
                                   placeholder="https://tiktok.com/@username">
                            @error('social_media.tiktok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-youtube text-danger me-1"></i>YouTube
                            </label>
                            <input type="url" class="form-control @error('social_media.youtube') is-invalid @enderror" 
                                   name="social_media[youtube]" 
                                   value="{{ old('social_media.youtube', $learner->social_media['youtube'] ?? '') }}"
                                   placeholder="https://youtube.com/@username">
                            @error('social_media.youtube')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Medical & Achievements -->
            <div class="student-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Kesehatan & Prestasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Catatan Kesehatan</label>
                            <textarea class="form-control @error('medical_notes') is-invalid @enderror" 
                                      name="medical_notes" rows="2"
                                      placeholder="Alergi, penyakit kronis, atau catatan kesehatan lainnya...">{{ old('medical_notes', $learner->medical_notes) }}</textarea>
                            @error('medical_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Prestasi</label>
                            <textarea class="form-control @error('achievements') is-invalid @enderror" 
                                      name="achievements" rows="3"
                                      placeholder="Prestasi akademik, non-akademik, atau penghargaan yang pernah diraih...">{{ old('achievements', $learner->achievements) }}</textarea>
                            @error('achievements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submit Button -->
    <div class="row">
        <div class="col-12">
            <div class="student-card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Change Password Section -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="student-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-lock me-2"></i>Ubah Password
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('learner.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                               name="current_password" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" 
                               name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i>Ubah Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection