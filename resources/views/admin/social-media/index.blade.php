@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">📱 Kelola Sosial Media</h2>
                <p class="text-muted mb-0">Update link sosial media dan informasi kontak sekolah</p>
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

<form action="{{ route('admin.social-media.update') }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Social Media Links -->
        <div class="col-md-8">
            <div class="admin-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-share-alt me-2"></i>Link Sosial Media
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-facebook text-primary me-2"></i>Facebook
                            </label>
                            <input type="url" class="form-control @error('facebook') is-invalid @enderror" 
                                   name="facebook" value="{{ old('facebook', $socialMedia['facebook']) }}" 
                                   placeholder="https://facebook.com/username">
                            @error('facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-instagram text-danger me-2"></i>Instagram
                            </label>
                            <input type="url" class="form-control @error('instagram') is-invalid @enderror" 
                                   name="instagram" value="{{ old('instagram', $socialMedia['instagram']) }}" 
                                   placeholder="https://instagram.com/username">
                            @error('instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-youtube text-danger me-2"></i>YouTube
                            </label>
                            <input type="url" class="form-control @error('youtube') is-invalid @enderror" 
                                   name="youtube" value="{{ old('youtube', $socialMedia['youtube']) }}" 
                                   placeholder="https://youtube.com/@channel">
                            @error('youtube')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fab fa-whatsapp text-success me-2"></i>WhatsApp
                            </label>
                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                   name="whatsapp" value="{{ old('whatsapp', $socialMedia['whatsapp']) }}" 
                                   placeholder="https://wa.me/6281234567890">
                            @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: https://wa.me/6281234567890</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="admin-card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-address-book me-2"></i>Informasi Kontak
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-phone text-success me-2"></i>Nomor Telepon
                            </label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone', $socialMedia['phone']) }}" 
                                   placeholder="+62 293 123456">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-envelope text-primary me-2"></i>Email
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $socialMedia['email']) }}" 
                                   placeholder="info@sekolah.sch.id">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-globe text-info me-2"></i>Website
                            </label>
                            <input type="text" class="form-control @error('website') is-invalid @enderror" 
                                   name="website" value="{{ old('website', $socialMedia['website']) }}" 
                                   placeholder="www.sekolah.sch.id">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt text-danger me-2"></i>Alamat
                            </label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3" 
                                      placeholder="Alamat lengkap sekolah">{{ old('address', $socialMedia['address']) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Preview & Info -->
        <div class="col-md-4">
            <div class="admin-card mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Preview
                    </h6>
                </div>
                <div class="card-body text-center">
                    <h6>Link Sosial Media</h6>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @if($socialMedia['facebook'])
                        <a href="{{ $socialMedia['facebook'] }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif
                        <a href="{{ $socialMedia['instagram'] }}" target="_blank" class="btn btn-danger btn-sm">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ $socialMedia['youtube'] }}" target="_blank" class="btn btn-danger btn-sm">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="{{ $socialMedia['whatsapp'] }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                    
                    <small class="text-muted">
                        Link ini akan muncul di website sekolah
                    </small>
                </div>
            </div>
            
            <div class="admin-card">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Petunjuk
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small mb-0">
                        <li class="mb-2">Pastikan link sosial media valid dan dapat diakses</li>
                        <li class="mb-2">WhatsApp gunakan format: https://wa.me/nomor</li>
                        <li class="mb-2">Perubahan akan langsung terlihat di website</li>
                        <li>Kosongkan field jika tidak ingin menampilkan link tersebut</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Submit Button -->
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="admin-btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection