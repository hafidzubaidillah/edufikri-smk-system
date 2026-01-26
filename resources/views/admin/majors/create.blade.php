@extends('layouts.admin')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Tambah Jurusan</h1>
            <p class="mb-0 text-muted">Tambah data jurusan baru</p>
        </div>
        <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jurusan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.majors.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="code" id="code" value="{{ old('code') }}" 
                                   class="form-control @error('code') is-invalid @enderror"
                                   placeholder="Contoh: TJKT" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Contoh: Teknik Jaringan Komputer dan Telekomunikasi" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="head_of_major_id" class="form-label">Kepala Jurusan</label>
                            <select name="head_of_major_id" id="head_of_major_id" 
                                    class="form-control @error('head_of_major_id') is-invalid @enderror">
                                <option value="">-- Pilih Kepala Jurusan --</option>
                                @forelse($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('head_of_major_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }} - {{ $teacher->nip ?? 'Tanpa NIP' }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada guru yang tersedia (semua sudah menjadi kepala jurusan)</option>
                                @endforelse
                            </select>
                            @error('head_of_major_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Pilih guru yang akan menjadi kepala jurusan. Hanya guru yang belum menjadi kepala jurusan lain yang ditampilkan.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="capacity" class="form-label">Kapasitas Total <span class="text-danger">*</span></label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 108) }}" 
                                   class="form-control @error('capacity') is-invalid @enderror"
                                   min="1" required>
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Kapasitas total siswa untuk jurusan ini (biasanya 3 kelas x 36 siswa = 108)</div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" rows="3" 
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Deskripsi singkat tentang jurusan ini">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="form-check-input" id="is_active">
                            <label class="form-check-label" for="is_active">
                                Jurusan Aktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection