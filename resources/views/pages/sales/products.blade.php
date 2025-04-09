@extends('layout.main')

@section('content')
<div class="container mt-4">
    <!-- Title -->
    <h1 class="h4 mb-3">Penjualan Produk</h1>

    <!-- Produk Grid -->
    <div class="row g-2">
        @foreach ($data as $product)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <div class="card h-100 text-center">
                <div class="ratio ratio-4x3">
                    <img src="{{ asset('asset/product_images/' . $product->image) }}" class="card-img-top object-fit-cover" alt="{{ $product->name }}">
                </div>
                <div class="card-body p-2">
                    <h6 class="card-title text-truncate mb-1" style="font-size: 0.85rem;">{{ $product->name }}</h6>
                    <p class="text-muted mb-1" style="font-size: 0.7rem;">Stok: <span id="stock-{{ $product->id }}">{{ $product->stock }}</span></p>
                    <p class="text-danger fw-bold mb-2" style="font-size: 0.85rem;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                    <div class="d-flex justify-content-center align-items-center gap-1">
                        <button onclick="updateQuantity({{ $product->id }}, -1, {{ $product->stock }})" class="btn btn-outline-secondary btn-sm px-2">-</button>
                        <input type="number" id="qty-{{ $product->id }}" value="0" readonly class="form-control form-control-sm text-center" style="width: 45px;">
                        <button onclick="updateQuantity({{ $product->id }}, 1, {{ $product->stock }})" class="btn btn-outline-secondary btn-sm px-2">+</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Checkout Button -->
    <form id="checkout-form" action="{{ route('sales.checkout') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="cart_checkout" id="cart_checkout">
        <button type="submit" class="btn btn-success w-100 fs-5">Selanjutnya</button>
    </form>
</div>

<script>
    let cart_checkout = [];

    function updateQuantity(id, change, maxStock) {
        const qtyInput = document.getElementById('qty-' + id);
        let qty = parseInt(qtyInput.value) || 0;
        let newQty = qty + change;

        newQty = Math.max(0, Math.min(newQty, maxStock));
        qtyInput.value = newQty;

        const index = cart_checkout.findIndex(item => item.id === id);
        if (index > -1) {
            if (newQty === 0) {
                cart_checkout.splice(index, 1);
            } else {
                cart_checkout[index].qty = newQty;
            }
        } else if (newQty > 0) {
            cart_checkout.push({ id: id, qty: newQty });
        }
    }

    document.getElementById('checkout-form').addEventListener('submit', function () {
        document.getElementById('cart_checkout').value = JSON.stringify(cart_checkout);
    });
</script>
@endsection