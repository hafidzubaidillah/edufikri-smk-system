@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Mata Pelajaran</h1>
            <p class="text-muted">Tambahkan mata pelajaran baru untuk sekolah</p>
        </div>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subjects.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Nama Mata Pelajaran -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-book text-primary"></i> Nama Mata Pelajaran *
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Contoh: Matematika"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kode Mata Pelajaran -->
                        <div class="form-group">
                            <label for="code" class="form-label">
                                <i class="fas fa-code text-primary"></i> Kode Mata Pelajaran *
                            </label>
                            <input type="text" 
                                   class="form-control @error('code') is-invalid @enderror" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code') }}" 
                                   placeholder="Contoh: MTK"
                                   style="text-transform: uppercase;"
                                   required>
                            <small class="form-text text-muted">Kode unik untuk mata pelajaran (akan otomatis uppercase)</small>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="form-group">
                            <label for="category" class="form-label">
                                <i class="fas fa-tags text-primary"></i> Kategori *
                            </label>
                            <select class="form-control @error('category') is-invalid @enderror" 
                                    id="category" 
                                    name="category" 
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $key => $label)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jam Per Minggu -->
                        <div class="form-group">
                            <label for="hours_per_week" class="form-label">
                                <i class="fas fa-clock text-primary"></i> Jam Pelajaran Per Minggu *
                            </label>
                            <input type="number" 
                                   class="form-control @error('hours_per_week') is-invalid @enderror" 
                                   id="hours_per_week" 
                                   name="hours_per_week" 
                                   value="{{ old('hours_per_week') }}" 
                                   min="1" 
                                   max="20"
                                   required>
                            @error('hours_per_week')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Tingkat Kelas -->
                        <div class="form-group">
                            <label for="grade_level" class="form-label">
                                <i class="fas fa-graduation-cap text-primary"></i> Tingkat Kelas *
                            </label>
                            <select class="form-control @error('grade_level') is-invalid @enderror" 
                                    id="grade_level" 
                                    name="grade_level" 
                                    required>
                                <option value="">Pilih Tingkat</option>
                                @foreach($gradeLevels as $key => $label)
                                    <option value="{{ $key }}" {{ old('grade_level') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grade_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jurusan -->
                        <div class="form-group">
                            <label for="majors" class="form-label">
                                <i class="fas fa-users text-primary"></i> Jurusan
                            </label>
                            <div class="card">
                                <div class="card-body">
                                    <small class="text-muted mb-2 d-block">Kosongkan jika untuk semua jurusan</small>
                                    @foreach($majors as $key => $label)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="checkbox" 
                                                   name="majors[]" 
                                                   value="{{ $key }}" 
                                                   id="major_{{ $key }}"
                                                   {{ in_array($key, old('majors', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="major_{{ $key }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('majors')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-cog text-primary"></i> Status & Jenis
                            </label>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="is_mandatory" 
                                               value="1" 
                                               id="is_mandatory"
                                               {{ old('is_mandatory') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_mandatory">
                                            <strong>Mata Pelajaran Wajib</strong>
                                            <br><small class="text-muted">Akan otomatis ditugaskan ke semua kelas yang sesuai</small>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="description" class="form-label">
                        <i class="fas fa-align-left text-primary"></i> Deskripsi
                    </label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" 
                              name="description" 
                              rows="3"
                              placeholder="Deskripsi singkat tentang mata pelajaran ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Mata Pelajaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="card border-left-info shadow">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        Informasi Penting
                    </div>
                    <div class="text-gray-800">
                        <ul class="mb-0">
                            <li><strong>Mata Pelajaran Wajib:</strong> Akan otomatis ditugaskan ke semua kelas yang sesuai dengan tingkat dan jurusan</li>
                            <li><strong>Mata Pelajaran Tambahan:</strong> Harus ditugaskan manual ke kelas tertentu</li>
                            <li><strong>Kode:</strong> Harus unik dan akan digunakan untuk identifikasi sistem</li>
                            <li><strong>Jurusan:</strong> Kosongkan jika mata pelajaran untuk semua jurusan</li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-generate code from name
    $('#name').on('input', function() {
        let name = $(this).val();
        let code = name.replace(/[^a-zA-Z0-9]/g, '').substring(0, 10).toUpperCase();
        $('#code').val(code);
    });

    // Uppercase code input
    $('#code').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });

    // Show/hide major selection based on category
    $('#category').on('change', function() {
        let category = $(this).val();
        if (category === 'kejuruan') {
            $('#majors').closest('.form-group').show();
        } else {
            $('#majors').closest('.form-group').hide();
            $('input[name="majors[]"]').prop('checked', false);
        }
    });

    // Trigger category change on page load
    $('#category').trigger('change');
});
</script>
@endpush
@endsection