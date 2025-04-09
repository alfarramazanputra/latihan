@extends('layout.main')

@section('content')
    <!-- Breadcrumb -->
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="/">Dashboard</a></li>
            <li><a href="{{ route('users.index') }}">User</a></li>
            <li class="text-gray-500">Edit</li>
        </ul>
    </div>

    <h1 class="text-2xl font-semibold text-gray-800 mb-4">EDIT USER</h1>

    <!-- Form -->
    <div class="mt-8 p-5 shadow bg-white rounded">
        <form action="{{ route('users.update', $userId['id']) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block font-medium">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $userId['name'] }}" required class="input input-bordered w-full mt-2" />
                </div>

                <div>
                    <label for="email" class="block font-medium">Email</label>
                    <input type="email" id="email" name="email" value="{{ $userId['email'] }}" required class="input input-bordered w-full mt-2" />
                </div>

                <div>
                    <label for="role" class="block font-medium">Role</label>
                    <select id="role" name="role" class="select select-bordered w-full mt-2">
                        <option disabled selected>Pilih Role</option>
                        <option value="admin" {{ $userId['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $userId['role'] == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block font-medium">Password (opsional)</label>
                    <input type="password" id="password" name="password" class="input input-bordered w-full mt-2" />
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('users.index') }}" class="btn btn-error px-8 m-2 text-white">Batal</a>
                <button type="submit" class="btn btn-primary px-8 m-2 text-white">Simpan</button>
            </div>
        </form>
    </div>
@endsection