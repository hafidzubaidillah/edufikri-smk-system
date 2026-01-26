@extends('layouts.admin')

@section('title', 'Tambah Kelas - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .form-card {
        border-left: 4px solid #1a5f1a;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stats-card {
        background: linear-gradient(135deg, #1a5f1a, #ffc107);
        color: white;
    }
</style>
@endpush

<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card stats-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2">
                            <i class="fas fa-plus me-2"></i>Tambah Kelas Baru
                        </h2>
                        <p class="mb-0">Tambahkan kelas baru untuk tahun ajaran aktif</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.classes.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form -->
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-chalkboard me-2"></i>Informasi Kelas
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.classes.store') }}" method="POST">
                    @csrf
                    
                    <div class="row g-3">
                        <!-- Tingkat -->
                        <div class="col-md-6">
                            <label for="grade" class="form-label">Tingkat Kelas</label>
                            <select class="form-select @error('grade') is-invalid @enderror" id="grade" name="grade" required>
                                <option value="">Pilih Tingkat</option>
                                @foreach($grades as $grade)
                                    <option value="{{ $grade }}" {{ old('grade') == $grade ? 'selected' : '' }}>
                                        Kelas {{ $grade == 10 ? 'X' : ($grade == 11 ? 'XI' : 'XII') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('grade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jurusan -->
                        <div class="col-md-6">
                            <label for="major" class="form-label">Jurusan</label>
                            <select class="form-select @error('major') is-invalid @enderror" id="major" name="major" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major }}" {{ old('major') == $major ? 'selected' : '' }}>
                                        {{ $major }} - 
                                        @switch($major)
                                            @case('TJKT')
                                                Teknik Jaringan Komputer dan Telekomunikasi
                                                @break
                                            @case('PPLG')
                                                Pengembangan Perangkat Lunak dan Gim
                                                @break
                                            @case('TKR')
                                                Teknik Kendaraan Ringan
                                                @break
                                            @case('TSM')
                                                Teknik Sepeda Motor
                                                @break
                                            @case('AKL')
                                                Akuntansi dan Keuangan Lembaga
                                                @break
                                        @endswitch
                                    </option>
                                @endforeach
                            </select>
                            @error('major')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor Kelas -->
                        <div class="col-md-6">
                            <label for="class_number" class="form-label">Nomor Kelas</label>
                            <select class="form-select @error('class_number') is-invalid @enderror" id="class_number" name="class_number" required>
                                <option value="">Pilih Nomor</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('class_number') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('class_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kapasitas -->
                        <div class="col-md-6">
                            <label for="capacity" class="form-label">Kapasitas Siswa</label>
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror" 
                                   id="capacity" name="capacity" value="{{ old('capacity', 36) }}" 
                                   min="1" max="50" required>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Wali Kelas -->
                        <div class="col-12">
                            <label for="homeroom_teacher" class="form-label">Wali Kelas</label>
                            <select class="form-select @error('homeroom_teacher') is-invalid @enderror" id="homeroom_teacher" name="homeroom_teacher">
                                <option value="">Pilih Wali Kelas (Opsional)</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->name }}" {{ old('homeroom_teacher') == $teacher->name ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('homeroom_teacher')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tahun Ajaran -->
                        <div class="col-12">
                            <label for="academic_year" class="form-label">Tahun Ajaran</label>
                            <input type="text" class="form-control @error('academic_year') is-invalid @enderror" 
                                   id="academic_year" name="academic_year" value="{{ old('academic_year', '2025/2026') }}" 
                                   placeholder="2025/2026" required>
                            @error('academic_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Preview Nama Kelas -->
                    <div class="mt-4">
                        <div class="alert alert-info">
                            <h6 class="mb-2">Preview Nama Kelas:</h6>
                            <div id="class-preview" class="fw-bold fs-5 text-primary">
                                Pilih tingkat, jurusan, dan nomor kelas
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-2"></i>Simpan Kelas
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function updateClassPreview() {
    const grade = document.getElementById('grade').value;
    const major = document.getElementById('major').value;
    const classNumber = document.getElementById('class_number').value;
    const preview = document.getElementById('class-preview');
    
    if (grade && major && classNumber) {
        const gradeRoman = grade == '10' ? 'X' : (grade == '11' ? 'XI' : 'XII');
        preview.textContent = `${gradeRoman} ${major} ${classNumber}`;
        preview.className = 'fw-bold fs-5 text-success';
    } else {
        preview.textContent = 'Pilih tingkat, jurusan, dan nomor kelas';
        preview.className = 'fw-bold fs-5 text-muted';
    }
}

// Add event listeners
document.getElementById('grade').addEventListener('change', updateClassPreview);
document.getElementById('major').addEventListener('change', updateClassPreview);
document.getElementById('class_number').addEventListener('change', updateClassPreview);

// Update preview on page load if there are old values
document.addEventListener('DOMContentLoaded', updateClassPreview);
</script>
@endpush