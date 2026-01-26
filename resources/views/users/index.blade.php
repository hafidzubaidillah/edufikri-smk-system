@extends('layouts.admin')

@section('title', 'Registered Users')

@section('content')
<div class="container">
    <!-- Loader Overlay -->
    <div id="loader" style="display: none;">
        <div class="spinner-border text-primary" role="status" style="width: 4rem; height: 4rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="mt-3 text-primary" id="loaderMessage">
            Memproses...
        </div>
    </div>


    <!-- Sticky header -->
    <div class="sticky-top bg-white shadow-sm py-2 mb-0">
        <div class="d-flex flex-column flex-md-row flex-wrap justify-content-between align-items-start align-items-md-center">
            <h5 class="mb-2 mb-md-0">
                <i class="fas fa-users me-2"></i>Manajemen User
            </h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.register.form') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-user-plus me-1"></i> Tambah User
                </a>
            </div>
        </div>
    </div>

    <!-- Mail Form and Table -->
    <form id="sendMailForm" method="POST" action="{{ route('users.sendmail') }}">
        @csrf

        <table class="table table-sm table-compact table-bordered table-hover bg-white">
            <thead class="table-light">
                <tr>
                    <th style="width:1%"><input type="checkbox" id="selectAll"></th>
                    <th style="width:1%">No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                    <th class="text-center" style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td><input type="checkbox" name="recipients[]" value="{{ $user->id }}" class="recipient-checkbox"></td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->getRoleNames()->first() ?? 'No Role' }}</td>
                        <td>{{ $user->created_at->format('M d, Y h:i A') }}</td>
                        <td class="text-center action-buttons">
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- View Details Button -->
                                <a href="{{ route('admin.users.passwords') }}" 
                                   class="btn btn-info" title="Lihat Password">
                                    <i class="fas fa-key"></i>
                                </a>
                                
                                <!-- Edit Button -->
                                <button type="button" 
                                        class="btn btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editUserModal{{ $user->id }}"
                                        title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Delete Button -->
                                <button type="button" 
                                        class="btn btn-danger" 
                                        onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')"
                                        title="Hapus User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center py-4">
                        <i class="fas fa-users text-muted mb-2" style="font-size: 2rem;"></i>
                        <p class="text-muted mb-0">Tidak ada user ditemukan</p>
                    </td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- Summary & Send Button -->
        <div class="d-flex justify-content-between align-items-center mt-3" style="font-size: 0.85rem;">
            <div class="small text-muted">
                Menampilkan {{ $users->firstItem() }} sampai {{ $users->lastItem() }} dari {{ $users->total() }} user
            </div>
            <div class="pagination-wrapper small">
                {{ $users->links() }}
            </div>
            <div>
                <button type="submit" id="sendEmailBtn" class="btn btn-success btn-sm">
                    <i class="fas fa-paper-plane me-1"></i> Kirim Email ke Yang Dipilih
                </button>
            </div>
        </div>
    </form>

    <!-- Edit Modal -->
        @foreach($users as $user)
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content border border-1 border-primary rounded-4 shadow">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-edit me-2"></i>Edit User
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user me-2"></i>Nama Lengkap
                                </label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-tag me-2"></i>Role/Peran
                                </label>
                                <select name="role" class="form-select" required>
                                    @foreach(Spatie\Permission\Models\Role::all() as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Modal Footer Buttons -->
                        <div class="modal-footer border-top-0 d-flex justify-content-end">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                                data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Batal
                            </button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-1"></i>Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

    <!-- Hidden DELETE Forms -->
    @foreach($users as $user)
        <form id="delete-user-{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user) }}" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
</div>
@endsection

@push('head')
    <style>
        #loader {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255,255,255,0.8);
            z-index: 9999;
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        
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
@endpush

@push('scripts')
@if(session('emailSuccess'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Emails Sent',
        text: '{{ session('emailSuccess') }}',
        timer: 4000,
        showConfirmButton: false
    });
</script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loader = document.getElementById('loader');
        const loaderMessage = document.getElementById('loaderMessage');
        const form = document.getElementById('sendMailForm');
        const sendEmailBtn = document.getElementById('sendEmailBtn');

        // Hide loader immediately when DOM is loaded
        if (loader) {
            loader.style.display = 'none';
        }

        // Show loader only when sending email
        if (sendEmailBtn) {
            sendEmailBtn.addEventListener('click', function () {
                if (loaderMessage) {
                    loaderMessage.textContent = 'Mengirim email...';
                }
                if (loader) {
                    loader.style.display = 'flex';
                }
            });
        }

        // Checkbox logic
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                document.querySelectorAll('.recipient-checkbox')
                        .forEach(cb => cb.checked = this.checked);
            });
        }
    });
    
    // Delete user function
    function deleteUser(userId, userName) {
        if (confirm(`Apakah Anda yakin ingin menghapus user ${userName}? Tindakan ini tidak dapat dibatalkan.`)) {
            // Submit the hidden form
            const form = document.getElementById(`delete-user-${userId}`);
            if (form) {
                form.submit();
            }
        }
    }
</script>
@endpush
