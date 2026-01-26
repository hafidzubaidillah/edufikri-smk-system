@extends('layouts.admin')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-1">🔐 Manajemen Password</h2>
                <p class="text-muted mb-0">Kelola password semua pengguna sistem</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-users me-2"></i>Kelola User
                </a>
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

<div class="admin-card">
    <div class="card-header bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="fas fa-key me-2"></i>Daftar Password Pengguna
            </h6>
            <span class="badge bg-primary">{{ $users->total() }} Total User</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Password</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px; font-size: 0.9rem;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        @if($user->learner)
                                            <small class="text-muted">
                                                <i class="fas fa-graduation-cap me-1"></i>
                                                {{ $user->learner->student_id ?? 'Siswa' }}
                                            </small>
                                        @elseif($user->teacher)
                                            <small class="text-muted">
                                                <i class="fas fa-chalkboard-teacher me-1"></i>
                                                {{ $user->teacher->nip ?? 'Guru' }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-{{ $role->name === 'admin' ? 'danger' : ($role->name === 'employee' ? 'success' : 'info') }} me-1">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                @if($user->plain_password)
                                    <div class="d-flex align-items-center">
                                        <code class="password-field" data-password="{{ $user->plain_password }}">
                                            ••••••••
                                        </code>
                                        <button class="btn btn-sm btn-outline-secondary ms-2 toggle-password" 
                                                onclick="togglePassword(this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                @else
                                    <span class="text-muted">Tidak tersedia</span>
                                @endif
                            </td>
                            <td>
                                <div>{{ $user->created_at->format('d M Y') }}</div>
                                <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-outline-warning" 
                                            onclick="showResetModal({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" 
                                            onclick="generatePassword({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-random"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-users text-muted mb-2" style="font-size: 2rem;"></i>
                                <p class="text-muted mb-0">Tidak ada pengguna ditemukan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
        <div class="card-footer">
            {{ $users->links() }}
        </div>
    @endif
</div>

<!-- Reset Password Modal -->
<div class="modal fade" id="resetPasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="resetPasswordForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-key me-2"></i>Reset Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Reset password untuk: <strong id="resetUserName"></strong></p>
                    
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i>Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword(button) {
    const passwordField = button.parentElement.querySelector('.password-field');
    const icon = button.querySelector('i');
    const actualPassword = passwordField.getAttribute('data-password');
    
    if (passwordField.textContent === '••••••••') {
        passwordField.textContent = actualPassword;
        icon.className = 'fas fa-eye-slash';
    } else {
        passwordField.textContent = '••••••••';
        icon.className = 'fas fa-eye';
    }
}

function showResetModal(userId, userName) {
    document.getElementById('resetUserName').textContent = userName;
    document.getElementById('resetPasswordForm').action = `/admin/users/${userId}/reset-password`;
    new bootstrap.Modal(document.getElementById('resetPasswordModal')).show();
}

function generatePassword(userId, userName) {
    if (confirm(`Generate password otomatis untuk ${userName}?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/users/${userId}/generate-password`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection