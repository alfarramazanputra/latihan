@extends('layout.main')

@section('content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>

    <!-- Heading -->
    <h1 class="h3 fw-bold text-dark mb-4">Edit Produk</h1>

    <!-- Form -->
    <form action="{{ route('products.update', $productId['id']) }}" method="POST" enctype="multipart/form-data" class="bg-white p-4 p-md-5 rounded shadow-sm border">
        @csrf
        @method('PATCH')

        <div class="row g-4">
            <!-- Nama Produk -->
            <div class="col-md-6">
                <label for="name" class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name" value="{{ $productId['name'] }}" class="form-control" required>
            </div>

            <!-- Gambar Produk -->
            <div class="col-md-6">
                <label for="image" class="form-label fw-semibold">Gambar Produk</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>

            <!-- Harga -->
            <div class="col-md-6">
                <label for="price_display" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                <input type="text" id="price_display" class="form-control" value="Rp. {{ number_format($productId['price'], 0, ',', '.') }}" required>
                <input type="hidden" id="price" name="price" value="{{ $productId['price'] }}">
            </div>

            <!-- Stok -->
            <div class="col-md-6">
                <label for="stock" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                <input type="number" id="stock" name="stock" value="{{ $productId['stock'] }}" class="form-control" required>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-5 d-flex justify-content-end gap-3">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>

    <!-- Script Format Harga -->
    <script>
        const priceDisplay = document.getElementById('price_display');
        const priceHidden = document.getElementById('price');

        priceDisplay.addEventListener('input', function () {
            let raw = this.value.replace(/[^\d]/g, '');
            let formatted = new Intl.NumberFormat('id-ID').format(raw);
            this.value = 'Rp. ' + formatted;
            priceHidden.value = raw;
        });
    </script>

@endsection