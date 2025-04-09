@extends('layout.main')

@section('content')
<div class="container mt-4">
    <!-- Title -->
    <h1 class="h4 mb-4">Penjualan</h1>

    <!-- Content -->
    <div class="row g-4">
        <!-- Cart Section -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Produk yang Dipilih</h5>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($checkout as $item)
                                @php $subtotal = $item['qty'] * $item['price']; @endphp
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>x{{ $item['qty'] }}</td>
                                    <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @php $total += $subtotal; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-end fw-semibold mt-3">
                        Total: Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Member + Payment Section -->
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="checkout_form" action="{{ route('sales.payment') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Status Member</label>
                            <select name="member_status" id="member_status" class="form-select">
                                <option value="non_member">Non-Member</option>
                                <option value="member">Member</option>
                            </select>
                        </div>

                        <div id="phone-container" class="mb-3 d-none">
                            <label class="form-label">No. Telepon</label>
                            <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder="0812xxxxxx">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Bayar</label>
                            <input type="text" id="total_bayar" class="form-control" placeholder="Masukkan nominal pembayaran">
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="cart" id="cart-input">
                        <input type="hidden" name="amount_paid" id="amount-paid-input">
                        <input type="hidden" name="sub_total" id="sub-total-input">
                        <input type="hidden" name="is_member" id="is-member-input">
                        <input type="hidden" name="phone_number" id="no-telp-input">

                        <button type="submit" class="btn btn-primary w-100 mt-3">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var cart = @json($checkout);
    var totalHarga = {{ $total }};

    document.getElementById('member_status').addEventListener('change', function () {
        const isMember = this.value === 'member';
        document.getElementById('phone-container').classList.toggle('d-none', !isMember);
        document.getElementById('is-member-input').value = isMember ? 1 : 0;
    });

    document.getElementById('total_bayar').addEventListener('input', function () {
        let value = this.value.replace(/[^0-9]/g, '');
        this.value = value ? 'Rp ' + new Intl.NumberFormat('id-ID').format(value) : '';
    });

    document.getElementById('checkout_form').addEventListener('submit', function () {
        const totalBayar = parseInt(document.getElementById('total_bayar').value.replace(/[^0-9]/g, '')) || 0;
        const isMember = document.getElementById('member_status').value === 'member';
        const phone = document.getElementById('phone_number').value;

        if (totalBayar < totalHarga) {
            alert('Uang tidak cukup!');
            return false;
        }

        if (isMember && phone.trim() === '') {
            alert('Nomor telepon wajib diisi untuk member.');
            return false;
        }

        document.getElementById('cart-input').value = JSON.stringify(cart);
        document.getElementById('amount-paid-input').value = totalBayar;
        document.getElementById('sub-total-input').value = totalHarga;
        document.getElementById('no-telp-input').value = isMember ? phone : '';
    });
</script>
@endsection
