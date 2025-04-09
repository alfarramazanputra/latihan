@extends('layout.main')

@section('content')
    <!-- Toast Success -->
    @if (Session::get('success'))
        <div class="position-fixed bottom-0 end-0 p-3 z-50" style="z-index: 9999">
            <div class="toast align-items-center text-bg-success show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ Session::get('success') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>    
    @endif

    <!-- Heading -->
    <h1 class="h3 fw-bold text-dark mb-4">Produk</h1>

    <!-- Main Section -->
    <div class="bg-white p-4 p-md-5 rounded shadow-sm border">
        
        <!-- Admin Button -->
        @if (Auth::user()->role === 'admin')
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
            </div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        @if (Auth::user()->role === 'admin')
                            <th scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded overflow-hidden border" style="width: 64px; height: 64px;">
                                        @if ($item->image)
                                            <img src="{{ asset('asset/product_images/' . $item->image) }}" alt="photo" class="img-fluid h-100 w-100 object-fit-cover">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center h-100 text-muted small">Tidak ada gambar</div>
                                        @endif
                                    </div>
                                    <span class="fw-medium">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['stock'] }}</td>

                            @if (Auth::user()->role === 'admin')
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.edit', $item['id']) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                        <form action="{{ route('products.delete', $item['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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