@extends('layout.main')

@section('content')
    <!-- Toast -->
    @if (Session::get('success'))
        <div class="toast toast-end fixed bottom-5 right-5 z-50 pointer-events-none">
            <div class="alert alert-success shadow-lg pointer-events-auto">
                <span class="text-white">{{ Session::get('success') }}</span>
            </div>
        </div>
    @endif

    <!-- Judul Halaman dan Tombol Tambah -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Manajemen User</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>

    <!-- Tabel -->
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="table">
            <thead class="bg-gray-100">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ ucfirst($item['role']) }}</td>
                        <td class="text-end">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('users.edit', $item['id']) }}" class="btn btn-warning btn-sm text-white">Edit</a>  
                                <form action="{{ route('users.delete', $item['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm text-black">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-400 py-4">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
