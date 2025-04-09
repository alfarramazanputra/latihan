@extends('layout.main')

@section('content')
    <!-- Toast Success -->
    @if (Session::get('success'))
        <div class="toast toast-end fixed bottom-5 right-5 z-50 pointer-events-none">
            <div class="alert alert-success shadow-lg pointer-events-auto">
                <span class="text-white">{{ Session::get('success') }}</span>
            </div>
        </div>    
    @endif

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Produk</h1>

    <!-- Main Section -->
    <div class="bg-white p-6 rounded-xl shadow space-y-4">
        <!-- Admin Button -->
        @if (Auth::user()->role === 'admin')
            <div class="flex justify-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary px-4">+ Tambah Produk</a>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Stok</th>
                        @if (Auth::user()->role === 'admin')
                            <th class="px-4 py-3">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($data as $key => $item)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $key + 1 }}</td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 overflow-hidden rounded-lg bg-gray-100 border">
                                        @if ($item->image)
                                            <img src="{{ asset('asset/product_images/' . $item->image) }}" alt="photo" class="object-cover w-full h-full">
                                        @else
                                            <div class="flex items-center justify-center w-full h-full text-xs text-gray-400">Tidak ada gambar</div>
                                        @endif
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $item['stock'] }}</td>

                            @if (Auth::user()->role === 'admin')
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="{{ route('products.edit', $item['id']) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                        <form action="{{ route('products.delete', $item['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-sm text-black">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection