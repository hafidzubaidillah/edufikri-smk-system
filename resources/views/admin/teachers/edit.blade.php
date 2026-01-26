@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">✏️ Edit Guru</h2>
                <p class="text-muted mb-0">Perbarui data guru {{ $teacher->name }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-outline-info">
                    <i class="fas fa-eye me-2"></i>Lihat Detail
                </a>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Personal Information -->
        <div class="col-md-8">
            <div class="admin-card mb-4">
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
                            <label class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                   name="nip" value="{{ old('nip', $teacher->nip) }}">
                            @error('nip')
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
                                   name="phone" value="{{ old('phone', $teacher->phone) }}" 
                                   placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3" 
                                      placeholder="Alamat lengkap guru">{{ old('address', $teacher->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Professional Information -->
        <div class="col-md-4">
            <div class="admin-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-graduation-cap me-2"></i>Informasi Profesional
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Spesialisasi Mata Pelajaran</label>
                        <select class="form-select @error('subject_specialization') is-invalid @enderror" 
                                name="subject_specialization">
                            <option value="">Pilih Spesialisasi</option>
                            <option value="Matematika" {{ old('subject_specialization', $teacher->subject_specialization) == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                            <option value="Bahasa Indonesia" {{ old('subject_specialization', $teacher->subject_specialization) == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                            <option value="Bahasa Inggris" {{ old('subject_specialization', $teacher->subject_specialization) == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                            <option value="Fisika" {{ old('subject_specialization', $teacher->subject_specialization) == 'Fisika' ? 'selected' : '' }}>Fisika</option>
                            <option value="Kimia" {{ old('subject_specialization', $teacher->subject_specialization) == 'Kimia' ? 'selected' : '' }}>Kimia</option>
                            <option value="Biologi" {{ old('subject_specialization', $teacher->subject_specialization) == 'Biologi' ? 'selected' : '' }}>Biologi</option>
                            <option value="Sejarah" {{ old('subject_specialization', $teacher->subject_specialization) == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="Geografi" {{ old('subject_specialization', $teacher->subject_specialization) == 'Geografi' ? 'selected' : '' }}>Geografi</option>
                            <option value="Ekonomi" {{ old('subject_specialization', $teacher->subject_specialization) == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Sosiologi" {{ old('subject_specialization', $teacher->subject_specialization) == 'Sosiologi' ? 'selected' : '' }}>Sosiologi</option>
                            <option value="Seni Budaya" {{ old('subject_specialization', $teacher->subject_specialization) == 'Seni Budaya' ? 'selected' : '' }}>Seni Budaya</option>
                            <option value="Pendidikan Jasmani" {{ old('subject_specialization', $teacher->subject_specialization) == 'Pendidikan Jasmani' ? 'selected' : '' }}>Pendidikan Jasmani</option>
                            <option value="Pendidikan Agama" {{ old('subject_specialization', $teacher->subject_specialization) == 'Pendidikan Agama' ? 'selected' : '' }}>Pendidikan Agama</option>
                            <option value="PKn" {{ old('subject_specialization', $teacher->subject_specialization) == 'PKn' ? 'selected' : '' }}>PKn</option>
                            <option value="Teknik Komputer Jaringan" {{ old('subject_specialization', $teacher->subject_specialization) == 'Teknik Komputer Jaringan' ? 'selected' : '' }}>Teknik Komputer Jaringan</option>
                            <option value="Pemrograman" {{ old('subject_specialization', $teacher->subject_specialization) == 'Pemrograman' ? 'selected' : '' }}>Pemrograman</option>
                            <option value="Multimedia" {{ old('subject_specialization', $teacher->subject_specialization) == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                            <option value="Desain Grafis" {{ old('subject_specialization', $teacher->subject_specialization) == 'Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
                        </select>
                        @error('subject_specialization')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tingkat Pendidikan</label>
                        <select class="form-select @error('education_level') is-invalid @enderror" 
                                name="education_level">
                            <option value="">Pilih Tingkat Pendidikan</option>
                            <option value="S1" {{ old('education_level', $teacher->education_level) == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                            <option value="S2" {{ old('education_level', $teacher->education_level) == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                            <option value="S3" {{ old('education_level', $teacher->education_level) == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                            <option value="D3" {{ old('education_level', $teacher->education_level) == 'D3' ? 'selected' : '' }}>D3 (Diploma)</option>
                            <option value="D4" {{ old('education_level', $teacher->education_level) == 'D4' ? 'selected' : '' }}>D4 (Sarjana Terapan)</option>
                        </select>
                        @error('education_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Current Info -->
            <div class="admin-card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Info Saat Ini
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Status:</small>
                        <span class="badge bg-{{ $teacher->is_active ? 'success' : 'secondary' }} ms-2">
                            {{ $teacher->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Bergabung:</small>
                        <span class="ms-2">{{ $teacher->hire_date ? $teacher->hire_date->format('d M Y') : 'Belum diisi' }}</span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Login Terakhir:</small>
                        <span class="ms-2">
                            {{ $teacher->user && $teacher->user->last_login_at ? $teacher->user->last_login_at->diffForHumans() : 'Belum pernah' }}
                        </span>
                    </div>
                    <hr>
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-warning btn-sm" onclick="resetPassword()">
                            <i class="fas fa-key me-1"></i>Reset Password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submit Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.teachers.show', $teacher) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="admin-btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function resetPassword() {
    if (confirm('Reset password untuk {{ $teacher->name }}? Password baru akan dikirim via email.')) {
        alert('Fitur reset password akan segera tersedia');
    }
}
</script>
@endsection