@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">➕ Tambah Guru Baru</h2>
                <p class="text-muted mb-0">Tambahkan data guru dan buat akun login</p>
            </div>
            <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<form action="{{ route('admin.teachers.store') }}" method="POST">
    @csrf
    
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
                                   name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIP (Opsional)</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                   name="nip" value="{{ old('nip') }}" 
                                   placeholder="Kosongkan untuk auto-generate">
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jika kosong, akan dibuat otomatis</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email (Opsional)</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" 
                                   placeholder="Kosongkan untuk auto-generate">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Jika kosong, akan dibuat otomatis dari nama</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" id="password" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="passwordIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone') }}" 
                                   placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3" 
                                      placeholder="Alamat lengkap guru">{{ old('address') }}</textarea>
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
                            <option value="Matematika" {{ old('subject_specialization') == 'Matematika' ? 'selected' : '' }}>Matematika</option>
                            <option value="Bahasa Indonesia" {{ old('subject_specialization') == 'Bahasa Indonesia' ? 'selected' : '' }}>Bahasa Indonesia</option>
                            <option value="Bahasa Inggris" {{ old('subject_specialization') == 'Bahasa Inggris' ? 'selected' : '' }}>Bahasa Inggris</option>
                            <option value="Fisika" {{ old('subject_specialization') == 'Fisika' ? 'selected' : '' }}>Fisika</option>
                            <option value="Kimia" {{ old('subject_specialization') == 'Kimia' ? 'selected' : '' }}>Kimia</option>
                            <option value="Biologi" {{ old('subject_specialization') == 'Biologi' ? 'selected' : '' }}>Biologi</option>
                            <option value="Sejarah" {{ old('subject_specialization') == 'Sejarah' ? 'selected' : '' }}>Sejarah</option>
                            <option value="Geografi" {{ old('subject_specialization') == 'Geografi' ? 'selected' : '' }}>Geografi</option>
                            <option value="Ekonomi" {{ old('subject_specialization') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Sosiologi" {{ old('subject_specialization') == 'Sosiologi' ? 'selected' : '' }}>Sosiologi</option>
                            <option value="Seni Budaya" {{ old('subject_specialization') == 'Seni Budaya' ? 'selected' : '' }}>Seni Budaya</option>
                            <option value="Pendidikan Jasmani" {{ old('subject_specialization') == 'Pendidikan Jasmani' ? 'selected' : '' }}>Pendidikan Jasmani</option>
                            <option value="Pendidikan Agama" {{ old('subject_specialization') == 'Pendidikan Agama' ? 'selected' : '' }}>Pendidikan Agama</option>
                            <option value="PKn" {{ old('subject_specialization') == 'PKn' ? 'selected' : '' }}>PKn</option>
                            <option value="Teknik Komputer Jaringan" {{ old('subject_specialization') == 'Teknik Komputer Jaringan' ? 'selected' : '' }}>Teknik Komputer Jaringan</option>
                            <option value="Pemrograman" {{ old('subject_specialization') == 'Pemrograman' ? 'selected' : '' }}>Pemrograman</option>
                            <option value="Multimedia" {{ old('subject_specialization') == 'Multimedia' ? 'selected' : '' }}>Multimedia</option>
                            <option value="Desain Grafis" {{ old('subject_specialization') == 'Desain Grafis' ? 'selected' : '' }}>Desain Grafis</option>
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
                            <option value="S1" {{ old('education_level') == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                            <option value="S2" {{ old('education_level') == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                            <option value="S3" {{ old('education_level') == 'S3' ? 'selected' : '' }}>S3 (Doktor)</option>
                            <option value="D3" {{ old('education_level') == 'D3' ? 'selected' : '' }}>D3 (Diploma)</option>
                            <option value="D4" {{ old('education_level') == 'D4' ? 'selected' : '' }}>D4 (Sarjana Terapan)</option>
                        </select>
                        @error('education_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Quick Info -->
            <div class="admin-card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li class="mb-2">Guru akan mendapat akun login otomatis</li>
                        <li class="mb-2">Email akan dibuat otomatis dari nama jika kosong</li>
                        <li class="mb-2">Format email: nama.belakang@smk-ihsanulfikri.edu</li>
                        <li class="mb-2">NIP akan dibuat otomatis jika kosong</li>
                        <li>Guru dapat mengubah password setelah login</li>
                    </ul>
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
                        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="admin-btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Guru
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
function togglePassword() {
    const passwordField = document.getElementById('password');
    const passwordIcon = document.getElementById('passwordIcon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.className = 'fas fa-eye-slash';
    } else {
        passwordField.type = 'password';
        passwordIcon.className = 'fas fa-eye';
    }
}

// Auto-generate password suggestion and email preview
document.addEventListener('DOMContentLoaded', function() {
    const nameField = document.querySelector('input[name="name"]');
    const emailField = document.querySelector('input[name="email"]');
    const passwordField = document.querySelector('input[name="password"]');
    
    let emailPreviewTimeout;
    
    // Update email preview when name changes
    nameField.addEventListener('input', function() {
        if (!emailField.value) {
            clearTimeout(emailPreviewTimeout);
            
            emailPreviewTimeout = setTimeout(() => {
                if (this.value.trim()) {
                    // Call API to get accurate email preview
                    fetch('{{ route("admin.teachers.preview-email") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ name: this.value })
                    })
                    .then(response => response.json())
                    .then(data => {
                        emailField.placeholder = data.email || 'Kosongkan untuk auto-generate';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                } else {
                    emailField.placeholder = 'Kosongkan untuk auto-generate';
                }
            }, 500); // Delay 500ms untuk menghindari terlalu banyak request
        }
    });
    
    nameField.addEventListener('blur', function() {
        // Auto-generate password if empty
        if (!passwordField.value && this.value) {
            const name = this.value.toLowerCase().replace(/\s+/g, '');
            const randomNum = Math.floor(Math.random() * 1000);
            passwordField.value = name.substring(0, 6) + randomNum;
        }
    });
});
</script>
@endsection