@extends('layout.main')

@section('content')
<div class="container bg-white p-4 rounded shadow mb-4">

    <!-- Tombol Aksi -->
    <div class="mb-3">
        <a href="{{ route('sales.index') }}" class="btn btn-dark">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <!-- Header Invoice -->
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
        <div>
            <h4 class="mb-0">Invoice #{{ $saleData['sale_id'] }}</h4>
            <small class="text-muted">{{ \Carbon\Carbon::parse($saleData['date'])->translatedFormat('d F Y') }}</small>
        </div>
        <span class="badge bg-success fs-6">Sukses</span>
    </div>

    <!-- Info Member -->
    @if ($saleData['member_id'])
    <div class="row g-3 mb-4 border p-3 rounded bg-light">
        <div class="col-md-6">
            <small class="text-muted">Member Sejak</small>
            <p class="mb-0 fw-semibold">{{ \Carbon\Carbon::parse($saleData['member_date'])->translatedFormat('d F Y') }}</p>
        </div>
        <div class="col-md-6">
            <small class="text-muted">Poin Tersisa</small>
            <p class="mb-0 fw-semibold">{{ number_format($saleData['member_point'], 0, ',', '.') }}</p>
        </div>
    </div>
    @endif

    <!-- Tabel Produk -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($saleData['products'] as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['qty'] }}</td>
                    <td>Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Info Pembayaran -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <small class="text-muted">Poin Digunakan</small>
            <p class="mb-0 fw-semibold">{{ $saleData['point_used'] }}</p>
        </div>
        <div class="col-md-3">
            <small class="text-muted">Tunai</small>
            <p class="mb-0 fw-semibold">Rp {{ number_format($saleData['amount_paid'], 0, ',', '.') }}</p>
        </div>
        <div class="col-md-3">
            <small class="text-muted">Kembalian</small>
            <p class="mb-0 fw-semibold">Rp {{ number_format($saleData['change'], 0, ',', '.') }}</p>
        </div>
        <div class="col-md-3">
            <small class="text-muted">Oleh</small>
            <p class="mb-0 fw-semibold">{{ $saleData['created_by'] }}</p>
        </div>
    </div>

    <!-- Total -->
    <div class="bg-dark text-white p-4 rounded d-flex justify-content-between align-items-center">
        <div>
            <p class="mb-0 fs-5">TOTAL</p>
        </div>
        <div class="text-end">
            @if ($saleData['point_used'] > 0)
            <p class="mb-0 text-decoration-line-through text-secondary small">Rp {{ number_format($saleData['sub_total'], 0, ',', '.') }}</p>
            @endif
            <h4 class="mb-0">Rp {{ number_format($saleData['total'], 0, ',', '.') }}</h4>
        </div>
    </div>

</div>
@endsection
