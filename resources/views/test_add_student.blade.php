<!DOCTYPE html>
<html>
<head>
    <title>Test Add Student</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Test Form Tambah Siswa</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('admin.learners.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', 'Test Student') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', 'test.student') }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="password123" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="class_id" class="form-control" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach(\App\Models\SchoolClass::active()->get() as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} ({{ $class->current_students }}/{{ $class->capacity }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Tambah Siswa</button>
            <a href="{{ route('admin.learners.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
        
        <hr>
        <h4>Debug Info:</h4>
        <p>Route: {{ route('admin.learners.store') }}</p>
        <p>CSRF Token: {{ csrf_token() }}</p>
        <p>Classes Available: {{ \App\Models\SchoolClass::active()->count() }}</p>
    </div>
</body>
</html>