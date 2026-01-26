@extends('layouts.teacher')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">👨‍🏫 Edit Profil Guru</h2>
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

<form action="{{ route('teacher.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Profile Photo & Basic Info -->
        <div class="col-md-4">
            <div class="teacher-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-camera me-2"></i>Foto Profil
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        @if($teacher->profile_photo)
                            <img src="{{ asset('storage/' . $teacher->profile_photo) }}" 
                                 alt="Profile Photo" 
                                 class="rounded-circle" 
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                 style="width: 120px; height: 120px; font-size: 3rem;">
                                {{ substr($teacher->name, 0, 1) }}
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
            <div class="teacher-card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Info Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <strong>NIP:</strong> {{ $teacher->nip }}
                    </div>
                    <div class="mb-2">
                        <strong>Spesialisasi:</strong> {{ $teacher->subject_specialization ?? 'Belum diisi' }}
                    </div>
                    <div class="mb-2">
                        <strong>Pendidikan:</strong> {{ $teacher->education_level ?? 'Belum diisi' }}
                    </div>
                    <div>
                        <strong>Bergabung:</strong> {{ $teacher->hire_date ? $teacher->hire_date->format('d M Y') : 'Belum diisi' }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Profile Form -->
        <div class="col-md-8">
            <!-- Personal Information -->
            <div class="teacher-card mb-4">
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
                                   name="name" value="{{ old('name', $teacher->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $teacher->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', $teacher->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                   name="birth_date" value="{{ old('birth_date', $teacher->birth_date?->format('Y-m-d')) }}">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('gender', $teacher->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('gender', $teacher->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3">{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Bio/Deskripsi Diri</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" 
                                      name="bio" rows="4" maxlength="1000" 
                                      placeholder="Ceritakan tentang diri Anda, pengalaman mengajar, atau hal menarik lainnya...">{{ old('bio', $teacher->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Maksimal 1000 karakter</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Emergency Contact -->
            <div class="teacher-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-phone-alt me-2"></i>Kontak Darurat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Kontak Darurat</label>
                            <input type="text" class="form-control @error('emergency_contact') is-invalid @enderror" 
                                   name="emergency_contact" value="{{ old('emergency_contact', $teacher->emergency_contact) }}">
                            @error('emergency_contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon Darurat</label>
                            <input type="text" class="form-control @error('emergency_phone') is-invalid @enderror" 
                                   name="emergency_phone" value="{{ old('emergency_phone', $teacher->emergency_phone) }}">
                            @error('emergency_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Social Media -->
            <div class="teacher-card mb-4">
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
                                   value="{{ old('social_media.instagram', $teacher->social_media['instagram'] ?? '') }}"
                                   placeholder="https://instagram.com/username">
                            @error('social_media.instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-facebook text-primary me-1"></i>Facebook
                            </label>
                            <input type="url" class="form-control @error('social_media.facebook') is-invalid @enderror" 
                                   name="social_media[facebook]" 
                                   value="{{ old('social_media.facebook', $teacher->social_media['facebook'] ?? '') }}"
                                   placeholder="https://facebook.com/username">
                            @error('social_media.facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-twitter text-info me-1"></i>Twitter
                            </label>
                            <input type="url" class="form-control @error('social_media.twitter') is-invalid @enderror" 
                                   name="social_media[twitter]" 
                                   value="{{ old('social_media.twitter', $teacher->social_media['twitter'] ?? '') }}"
                                   placeholder="https://twitter.com/username">
                            @error('social_media.twitter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-linkedin text-primary me-1"></i>LinkedIn
                            </label>
                            <input type="url" class="form-control @error('social_media.linkedin') is-invalid @enderror" 
                                   name="social_media[linkedin]" 
                                   value="{{ old('social_media.linkedin', $teacher->social_media['linkedin'] ?? '') }}"
                                   placeholder="https://linkedin.com/in/username">
                            @error('social_media.linkedin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Achievements & Certifications -->
            <div class="teacher-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Prestasi & Sertifikasi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Prestasi</label>
                            <textarea class="form-control @error('achievements') is-invalid @enderror" 
                                      name="achievements" rows="3"
                                      placeholder="Tuliskan prestasi atau penghargaan yang pernah diraih...">{{ old('achievements', $teacher->achievements) }}</textarea>
                            @error('achievements')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Sertifikasi</label>
                            <textarea class="form-control @error('certifications') is-invalid @enderror" 
                                      name="certifications" rows="3"
                                      placeholder="Tuliskan sertifikasi atau pelatihan yang pernah diikuti...">{{ old('certifications', $teacher->certifications) }}</textarea>
                            @error('certifications')
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
            <div class="teacher-card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg">
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
        <div class="teacher-card">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-lock me-2"></i>Ubah Password
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('teacher.profile.password') }}" method="POST">
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