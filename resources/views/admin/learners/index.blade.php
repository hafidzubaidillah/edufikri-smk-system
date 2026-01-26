@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')

<style>
.action-buttons .btn-group {
    display: flex;
    gap: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border-radius: 0.375rem;
}

.action-buttons .btn {
    min-width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 0;
    border-right: 1px solid rgba(255,255,255,0.2);
    transition: all 0.2s ease;
}

.action-buttons .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.action-buttons .btn:last-child {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
    border-right: none;
}

.action-buttons .btn i {
    font-size: 14px;
}

.action-buttons .btn:hover {
    transform: translateY(-1px);
    z-index: 1;
}

.table td {
    vertical-align: middle;
}

.btn-info {
    background-color: #17a2b8;
    border-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
    border-color: #117a8b;
    color: white;
}
</style>

<div class="container-fluid px-2">

    <!-- Success Message -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    timer: 3000,
                    timerProgressBar: true,
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif
 
    <!-- Sticky header -->
    <div class="sticky-top bg-white shadow-sm py-2 mb-0">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-users me-2"></i>Data Siswa
            </h5>

            <div class="d-flex gap-2">
                <!-- Add Learner Button -->
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addLearnerModal">
                    <i class="fas fa-user-plus me-1"></i> Tambah Siswa
                </button>
            </div>
        </div>
    </div>

    <!-- Learner Table -->
    <div class="overflow-auto rounded-lg border border-gray-300 shadow-sm">
         <table class="table table-sm table-compact table-bordered table-hover bg-white">
            <thead class="table-light">
                <tr>
                    <th style="width: 1%;">No.</th>
                    <th class="px-3 py-2 text-left">Nama</th>
                    <th class="px-3 py-2 text-left">Email</th>
                    <th class="px-3 py-2 text-left">Tingkat</th>
                    <th class="px-3 py-2 text-left">Kelas</th>
                    <th class="px-3 py-2 text-center" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($learners as $learner)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-1">{{ $loop->iteration }}</td>
                        <td class="px-3 py-1">{{ $learner->name }}</td>
                        <td class="px-3 py-1">{{ $learner->email }}</td>
                        <td class="px-3 py-1">{{ $learner->grade_level }}</td>
                        <td class="px-3 py-1">{{ $learner->section }}</td>
                        <td class="px-3 py-1 text-center action-buttons">
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- View Details Button -->
                                <a href="{{ route('admin.learners.show', $learner->id) }}" 
                                   class="btn btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <!-- Edit Button -->
                                <button type="button"
                                    class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editLearnerModal{{ $learner->id }}"
                                    title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <button type="button" class="btn btn-danger" 
                                        onclick="deleteLearner({{ $learner->id }}, '{{ $learner->name }}')"
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Edit Modal -->
                    <div class="modal fade" id="editLearnerModal{{ $learner->id }}" tabindex="-1" aria-labelledby="editLearnerLabel{{ $learner->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered">
                          <div class="modal-content border border-1 border-primary rounded-4 shadow">
                          <form action="{{ route('admin.learners.update', $learner->id) }}" method="POST">
                              @csrf
                              @method('PUT')
                              <div class="modal-header py-2 px-3">
                              <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="editLearnerLabel{{ $learner->id }}">
                                  <i class="fas fa-edit"></i>
                                  Edit Siswa
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <div class="modal-body pt-1">
                              <div class="container-fluid">
                                  <div class="row g-3 mb-3">
                                  <div class="col-md-12">
                                      <label class="form-label">Nama Lengkap</label>
                                      <input type="text" name="name" class="form-control" value="{{ $learner->name }}" required>
                                  </div>
                                  </div>

                                  <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ $learner->email }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelas</label>
                                        <select name="class_id" class="form-select" required>
                                        <option disabled>Select Class</option>
                                        @foreach(\App\Models\SchoolClass::active()->get() as $class)
                                            <option value="{{ $class->id }}" @selected($learner->class_id === $class->id)>{{ $class->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                  </div>
                              </div>
                              </div>

                              <div class="modal-footer d-flex justify-content-end">
                              <button type="button" class="btn btn-outline-primary rounded-pill px-4"
                                      style="background-color: transparent !important; border-color: #0d6efd; color: #0d6efd;"
                                      data-bs-dismiss="modal">
                                      Cancel
                                  </button>
                              <button type="submit" class="btn btn-primary rounded-pill px-4">Update</button>
                              </div>
                          </form>
                          </div>
                      </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap Modal For Add -->
<div class="modal fade" id="addLearnerModal" tabindex="-1" aria-labelledby="addLearnerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border border-1 border-primary rounded-4 shadow" style="z-index: 1055;">
      <form action="{{ route('admin.learners.store') }}" method="POST" id="addLearnerForm">
        @csrf
        <div class="modal-header border-bottom-0 bg-gradient-primary text-white">
            <h5 class="modal-title fw-bold d-flex align-items-center gap-2" id="addLearnerModalLabel">
                <i class="fas fa-user-plus"></i>
                Tambah Siswa Baru
            </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body pt-3">
          <div class="container-fluid">
            
            <!-- Error Display -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Info Alert -->
            <div class="alert alert-info mb-4">
                <h6 class="mb-2"><i class="fas fa-info-circle me-2"></i>Form Sederhana:</h6>
                <p class="mb-0 small">Cukup isi 4 field di bawah ini. Sistem akan otomatis membuat email, NIS, dan akun login untuk siswa.</p>
            </div>

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <label for="studentName" class="form-label fw-bold">
                    <i class="fas fa-user me-2"></i>Nama Lengkap Siswa
                </label>
                <input type="text" name="name" id="studentName" class="form-control form-control-lg rounded-3" 
                       placeholder="Contoh: Ahmad Rizki Pratama" value="{{ old('name') }}" required>
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label for="studentUsername" class="form-label fw-bold">
                    <i class="fas fa-at me-2"></i>Username untuk Login
                </label>
                <div class="input-group">
                    <input type="text" name="username" id="studentUsername" class="form-control form-control-lg rounded-start-3" 
                           placeholder="Contoh: ahmad.rizki" value="{{ old('username') }}" required>
                    <button class="btn btn-outline-info" type="button" onclick="generateUsernameModal()">
                        <i class="fas fa-magic me-1"></i>Auto
                    </button>
                </div>
                <small class="text-muted">Username unik untuk login siswa</small>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="studentPassword" class="form-label fw-bold">
                    <i class="fas fa-lock me-2"></i>Password
                </label>
                <div class="input-group">
                    <input type="password" name="password" id="studentPassword" class="form-control form-control-lg" 
                           placeholder="Minimal 6 karakter" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordModal()">
                        <i class="fas fa-eye" id="passwordIconModal"></i>
                    </button>
                    <button class="btn btn-outline-warning" type="button" onclick="generatePasswordModal()">
                        <i class="fas fa-key me-1"></i>Auto
                    </button>
                </div>
            </div>

            <!-- Kelas -->
            <div class="mb-4">
                <label for="studentClass" class="form-label fw-bold">
                    <i class="fas fa-chalkboard me-2"></i>Pilih Kelas
                </label>
                <select name="class_id" id="studentClass" class="form-select form-select-lg rounded-3" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach(\App\Models\SchoolClass::active()->orderBy('grade')->orderBy('major')->orderBy('class_number')->get() as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} - {{ $class->major }} ({{ $class->current_students }}/{{ $class->capacity }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Tingkat dan section akan otomatis diambil dari kelas yang dipilih</small>
            </div>

            <!-- Auto Generate Info -->
            <div class="alert alert-success">
                <h6 class="mb-2"><i class="fas fa-magic me-2"></i>Yang Akan Dibuat Otomatis:</h6>
                <ul class="mb-0 small">
                    <li>✅ Akun login siswa dengan role "learner"</li>
                    <li>✅ Email otomatis: username@student.edufikri.com</li>
                    <li>✅ NIS otomatis berdasarkan tahun dan urutan</li>
                    <li>✅ Tingkat dan section dari kelas yang dipilih</li>
                </ul>
            </div>

          </div>
        </div>

        <!-- Modal Footer Buttons -->
        <div class="modal-footer border-top-0 d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                <i class="fas fa-times me-1"></i>Batal
            </button>
          <button type="submit" class="btn btn-primary rounded-pill px-4" id="submitBtn">
              <i class="fas fa-save me-1"></i>Tambah Siswa & Buat Akun
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #1a5f1a, #ffc107) !important;
}
</style>

<script>
// Generate username from name in modal
function generateUsernameModal() {
    const name = document.getElementById('studentName').value;
    const usernameField = document.getElementById('studentUsername');
    
    if (name) {
        const cleanName = name.toLowerCase()
            .replace(/[^a-z\s]/g, '')
            .trim()
            .split(' ')
            .slice(0, 2)
            .join('.');
        
        usernameField.value = cleanName;
    } else {
        alert('Isi nama terlebih dahulu');
        document.getElementById('studentName').focus();
    }
}

// Toggle password visibility in modal
function togglePasswordModal() {
    const passwordField = document.getElementById('studentPassword');
    const passwordIcon = document.getElementById('passwordIconModal');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}

// Generate random password in modal
function generatePasswordModal() {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let password = '';
    
    for (let i = 0; i < 8; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    
    document.getElementById('studentPassword').value = password;
    
    // Show password temporarily
    const passwordField = document.getElementById('studentPassword');
    const passwordIcon = document.getElementById('passwordIconModal');
    passwordField.type = 'text';
    passwordIcon.classList.remove('fa-eye');
    passwordIcon.classList.add('fa-eye-slash');
    
    // Copy to clipboard if supported
    if (navigator.clipboard) {
        navigator.clipboard.writeText(password).then(() => {
            const btn = event.target.closest('button');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i>Tersalin!';
            btn.classList.remove('btn-outline-warning');
            btn.classList.add('btn-success');
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-warning');
            }, 2000);
        });
    }
}

// Auto-generate username when name changes
document.addEventListener('DOMContentLoaded', function() {
    const nameField = document.getElementById('studentName');
    const usernameField = document.getElementById('studentUsername');
    
    if (nameField && usernameField) {
        nameField.addEventListener('blur', function() {
            if (this.value && !usernameField.value) {
                generateUsernameModal();
            }
        });
    }
    
    // SIMPLIFIED FORM HANDLER - NO VALIDATION BLOCKING
    const form = document.getElementById('addLearnerForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitted!');
            // Let the form submit naturally - no preventDefault
        });
    }
});

// Delete learner function
function deleteLearner(learnerId, learnerName) {
    if (confirm(`Apakah Anda yakin ingin menghapus siswa ${learnerName}? Tindakan ini tidak dapat dibatalkan.`)) {
        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/learners/${learnerId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
