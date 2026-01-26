@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-user-shield me-2"></i>Edit Profil Administrator
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-lock me-2"></i>Update Password
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="admin-card border-danger">
            <div class="card-header bg-light">
                <h5 class="mb-0 text-danger">
                    <i class="fas fa-trash me-2"></i>Hapus Akun
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection