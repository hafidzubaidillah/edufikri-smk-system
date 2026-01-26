@extends('layouts.admin')

@section('title', 'Edit Siswa - ' . $student->name . ' - SMK IT Ihsanul Fikri')

@section('content')

@push('styles')
<style>
    .form-card {
        border-left: 4px solid #ffc107;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .stats-card {
        background: linear-gradient(135deg, #ffc107, #1a5f1a);
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
                            <i class="fas fa-user-edit me-2"></i>Edit Siswa: {{ $student->name }}
                        </h2>
                        <p class="mb-0">Perbarui data siswa di kelas {{ $class->name }}</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-light btn-lg">
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
                    <i class="fas fa-user me-2"></i>Data Siswa
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

                <!-- Class Info -->
                <div class="alert alert-info mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Kelas:</strong> {{ $class->name }}<br>
                            <strong>Jurusan:</strong> {{ $class->major }}
                        </div>
                        <div class="col-md-6">
                            <strong>NIS:</strong> {{ $student->student_id }}<br>
                            <strong>Terdaftar:</strong> {{ \Carbon\Carbon::parse($student->enrollment_date)->format('d/m/Y') }}
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.classes.students.update', [$class, $student]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Data Pribadi -->
                    <h6 class="mb-3 text-primary">
                        <i class="fas fa-user me-2"></i>Data Pribadi
                    </h6>
                    
                    <div class="row g-3 mb-4">
                        <!-- Nama Lengkap -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') ?? $student->name }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIS -->
                        <div class="col-md-6">
                            <label for="student_id" class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                                   id="student_id" name="student_id" value="{{ old('student_id') ?? $student->student_id }}" required>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') ?? $student->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Jenis Kelamin</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ (old('gender') ?? $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ (old('gender') ?? $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" 
                                   id="birth_date" name="birth_date" value="{{ old('birth_date') ?? $student->birth_date }}" required>
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No. Telepon -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">No. Telepon (Opsional)</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') ?? $student->phone }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="col-12">
                            <label for="address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" required>{{ old('address') ?? $student->address }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Data Orang Tua -->
                    <h6 class="mb-3 text-primary">
                        <i class="fas fa-users me-2"></i>Data Orang Tua/Wali
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Nama Orang Tua -->
                        <div class="col-md-6">
                            <label for="parent_name" class="form-label">Nama Orang Tua/Wali</label>
                            <input type="text" class="form-control @error('parent_name') is-invalid @enderror" 
                                   id="parent_name" name="parent_name" value="{{ old('parent_name') ?? $student->parent_name }}" required>
                            @error('parent_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- No. Telepon Orang Tua -->
                        <div class="col-md-6">
                            <label for="parent_phone" class="form-label">No. Telepon Orang Tua/Wali</label>
                            <input type="text" class="form-control @error('parent_phone') is-invalid @enderror" 
                                   id="parent_phone" name="parent_phone" value="{{ old('parent_phone') ?? $student->parent_phone }}" required>
                            @error('parent_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.classes.students', $class) }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-2"></i>Perbarui Data
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
// Format phone numbers
function formatPhone(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.startsWith('0')) {
        value = '+62' + value.substring(1);
    } else if (!value.startsWith('+62')) {
        value = '+62' + value;
    }
    input.value = value;
}

document.getElementById('phone').addEventListener('blur', function() {
    if (this.value) formatPhone(this);
});

document.getElementById('parent_phone').addEventListener('blur', function() {
    if (this.value) formatPhone(this);
});
</script>
@endpush