@extends('layout.main')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb bg-light px-3 py-2 rounded">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard.index') }}" class="text-decoration-none">
                <i class="bi bi-house-door-fill me-1"></i> Dashboard
            </a>
        </li>
        <li class="breadcrumb-item active text-secondary fw-bold" aria-current="page">Penjualan</li>
    </ol>
</nav>

<!-- Heading -->
<h1 class="mb-4 fw-bold display-6">PENJUALAN</h1>

<!-- Main Content -->
<div class="bg-white p-4 rounded shadow">

    <div class="row g-4">

        <!-- Produk yang dipilih -->
        <div class="col-md-7">
            <div class="card border">
                <div class="card-header bg-primary text-white fw-bold">
                    Produk yang Dipilih
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th></th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_items as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>x</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td>Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 text-end">
                        <p class="mb-1 fw-semibold">Total Harga: Rp {{ number_format($sub_total, 0, ',', '.') }}</p>
                        <p class="mb-0 fw-semibold">Tunai: Rp {{ number_format($amount_paid, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Member -->
        <div class="col-md-5">
            <div class="card border">
                <div class="card-header bg-secondary text-white fw-bold">Data Member</div>
                <div class="card-body">
                    <form id="member-form" action="{{ route('sales.memberpayment') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="member_name" class="form-label">Nama Member</label>
                            <input type="text" name="member_name" id="member_name" class="form-control" value="{{ $member_name ?? '' }}" {{ $member_name ? 'readonly' : '' }}>
                        </div>

                        <div class="mb-3">
                            <label for="point_total" class="form-label">Total Points</label>
                            <input type="text" class="form-control bg-light" value="{{ $point_total }}" disabled>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="use_point" {{ $can_use_point ? '' : 'disabled' }}>
                            <label for="use_point" class="form-check-label">
                                Gunakan Point
                                @if (!$can_use_point)
                                <small class="text-danger d-block">Poin tidak dapat digunakan pada pembelanjaan pertama.</small>
                                @endif
                            </label>
                            <input type="hidden" name="use_point" id="usePointsHidden" value="0">
                        </div>

                        <!-- Hidden Data -->
                        <input type="hidden" name="total_point" value="{{ $point_total }}">
                        <input type="hidden" name="cart" id="cart-input">
                        <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                        <input type="hidden" name="amount_paid" value="{{ $amount_paid }}">
                        <input type="hidden" name="phone_number" value="{{ $phone_number }}">

                        <button type="submit" class="btn btn-primary w-100">Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    var cart = @json($cart_items);

    document.getElementById('member-form').addEventListener('submit', function(event) {
        document.getElementById('cart-input').value = JSON.stringify(cart);
        document.getElementById('usePointsHidden').value = document.getElementById('use_point').checked ? "1" : "0";
    });
</script>

@endsection