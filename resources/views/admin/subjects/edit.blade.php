@extends('layouts.admin')

@section('title', 'Edit Mata Pelajaran')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Edit Mata Pelajaran</h1>
            <p class="text-muted">Edit mata pelajaran: <strong>{{ $subject->name }}</strong></p>
        </div>
        <div>
            <a href="{{ route('admin.subjects.show', $subject) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> Detail
            </a>
            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                @csrf
                @method('PUT')
                
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
                                   value="{{ old('name', $subject->name) }}" 
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
                                   value="{{ old('code', $subject->code) }}" 
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
                                    <option value="{{ $key }}" {{ old('category', $subject->category) == $key ? 'selected' : '' }}>
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
                                   value="{{ old('hours_per_week', $subject->hours_per_week) }}" 
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
                                    <option value="{{ $key }}" {{ old('grade_level', $subject->grade_level) == $key ? 'selected' : '' }}>
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
                                                   {{ in_array($key, old('majors', $subject->majors ?? [])) ? 'checked' : '' }}>
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
                                               name="is_active" 
                                               value="1" 
                                               id="is_active"
                                               {{ old('is_active', $subject->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            <strong>Mata Pelajaran Aktif</strong>
                                            <br><small class="text-muted">Mata pelajaran dapat digunakan dalam sistem</small>
                                        </label>
                                    </div>
                                    <hr>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="is_mandatory" 
                                               value="1" 
                                               id="is_mandatory"
                                               {{ old('is_mandatory', $subject->is_mandatory) ? 'checked' : '' }}>
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
                              placeholder="Deskripsi singkat tentang mata pelajaran ini...">{{ old('description', $subject->description) }}</textarea>
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
                            <i class="fas fa-save"></i> Update Mata Pelajaran
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Classes Using This Subject -->
    @if($subject->classes->count() > 0)
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kelas yang Menggunakan Mata Pelajaran Ini</h6>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($subject->classes as $class)
                <div class="col-md-4 mb-3">
                    <div class="card border-left-success">
                        <div class="card-body">
                            <h6 class="card-title">{{ $class->full_name }}</h6>
                            <p class="card-text">
                                <small class="text-muted">
                                    Siswa: {{ $class->current_students }}/{{ $class->capacity }}
                                    @if($class->pivot->teacher_name)
                                        <br>Guru: {{ $class->pivot->teacher_name }}
                                    @endif
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Warning Card -->
    @if($subject->is_mandatory)
    <div class="card border-left-warning shadow">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Peringatan - Mata Pelajaran Wajib
                    </div>
                    <div class="text-gray-800">
                        Ini adalah mata pelajaran wajib. Perubahan pada tingkat kelas atau jurusan akan mempengaruhi 
                        penugasan otomatis ke kelas-kelas yang sesuai.
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
$(document).ready(function() {
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