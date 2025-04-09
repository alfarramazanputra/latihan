@extends('layout.main')

@section('content')

<h1 class="text-2xl font-semibold text-gray-800 mb-4">TAMBAH USER</h1>

    <!-- Form -->
    <div class="mt-8 p-5 shadow bg-white rounded">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block font-medium">Nama<span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" required class="input input-bordered w-full mt-2" />
                </div>

                <div>
                    <label for="email" class="block font-medium">Email<span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" required class="input input-bordered w-full mt-2" />
                </div>

                <div>
                    <label for="role" class="block font-medium">Role<span class="text-red-500">*</span></label>
                    <select id="role" name="role" required class="select select-bordered w-full mt-2">
                        <option disabled selected>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                </div>

                <div>
                    <label for="password" class="block font-medium">Password<span class="text-red-500">*</span></label>
                    <input type="password" id="password" name="password" required class="input input-bordered w-full mt-2" />
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('users.index') }}" class="btn btn-error px-8 m-2 text-white">Batal</a>
                <button type="submit" class="btn btn-primary px-8 m-2 text-white">Simpan</button>
            </div>
        </form>
    </div>

@endsection