@extends('layout.main')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
        <li class="breadcrumb-item active text-muted" aria-current="page">Edit</li>
    </ol>
</nav>

<h1 class="h4 fw-bold text-dark mb-4">Edit User</h1>

<!-- Form -->
<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('users.update', $userId['id']) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $userId['name'] }}" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $userId['email'] }}" required>
                </div>

                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select">
                        <option disabled selected>Pilih Role</option>
                        <option value="admin" {{ $userId['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $userId['role'] == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label">Password <small class="text-muted">(opsional)</small></label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('users.index') }}" class="btn btn-danger me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection