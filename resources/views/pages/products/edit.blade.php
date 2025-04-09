@extends('layout.main')

@section('content')

    <!-- Breadcrumb -->
    <div class="text-sm breadcrumbs mb-4">
        <ul>
            <li><a href="/">Dashboard</a></li>
            <li><a href="{{ route('products.index') }}">Produk</a></li>
            <li class="text-gray-500">Edit</li>
        </ul>
    </div>

    <h1 class="text-2xl font-semibold text-gray-800 mb-4">Edit Produk</h1>

    <!-- Form -->
    <form action="{{ route('products.update', $productId['id']) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium">Nama Produk</label>
                <input type="text" id="name" name="name" value="{{ $productId['name'] }}" class="input input-bordered w-full mt-2" required>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium">Gambar Produk</label>
                <input type="file" id="image" name="image" class="file-input file-input-bordered w-full mt-2">
            </div>

            <div>
                <label for="price_display" class="block text-sm font-medium">Harga</label>
                <input type="text" id="price_display" class="input input-bordered w-full mt-2" value="Rp. {{ number_format($productId['price'], 0, ',', '.') }}" required>
                <input type="hidden" id="price" name="price" value="{{ $productId['price'] }}">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium">Stok</label>
                <input type="number" id="stock" name="stock" value="{{ $productId['stock'] }}" class="input input-bordered w-full mt-2" required>
            </div>
        </div>

        <div class="flex justify-end mt-6 gap-2">
            <a href="{{ route('products.index') }}" class="btn btn-ghost">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>

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