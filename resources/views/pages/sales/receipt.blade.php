@extends('layout.main')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-md space-y-6">
    <!-- Tombol Aksi -->
    <div class="flex gap-3">
        <a href="{{ route('sales.index') }}" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md transition">← Kembali</a>
    </div>

    <!-- Header Invoice -->
    <div class="flex justify-between items-center border-b pb-3">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Invoice #{{ $saleData['sale_id'] }}</h2>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($saleData['date'])->translatedFormat('d F Y') }}</p>
        </div>
        <div class="text-right">
            <span class="inline-block bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Sukses</span>
        </div>
    </div>

    <!-- Info Member -->
    @if ($saleData['member_id'])
        <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl grid sm:grid-cols-2 gap-3">
            <div>
                <p class="text-sm text-gray-500">Member Sejak</p>
                <p class="font-semibold text-blue-800">{{ \Carbon\Carbon::parse($saleData['member_date'])->translatedFormat('d F Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Poin Tersisa</p>
                <p class="font-semibold text-blue-800">{{ number_format($saleData['member_point'], 0, ',', '.') }}</p>
            </div>
        </div>
    @endif

    <!-- Produk -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm border rounded-lg overflow-hidden shadow-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Produk</th>
                    <th class="px-4 py-3 text-left">Harga</th>
                    <th class="px-4 py-3 text-left">Qty</th>
                    <th class="px-4 py-3 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($saleData['products'] as $item)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $item['product_name'] }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $item['qty'] }}</td>
                        <td class="px-4 py-2">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Info Pembayaran -->
    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
        @foreach ([
            'Poin Digunakan' => $saleData['point_used'],
            'Tunai' => 'Rp ' . number_format($saleData['amount_paid'], 0, ',', '.'),
            'Kembalian' => 'Rp ' . number_format($saleData['change'], 0, ',', '.'),
            'Oleh' => $saleData['created_by']
        ] as $label => $value)
            <div>
                <p class="text-xs text-gray-500">{{ $label }}</p>
                <p class="text-base font-semibold text-gray-800">{{ $value }}</p>
            </div>
        @endforeach
    </div>

    <!-- Total -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-700 text-white p-5 rounded-xl flex justify-between items-center shadow">
        <p class="text-lg font-medium">TOTAL</p>
        <div class="text-right">
            @if ($saleData['point_used'] > 0)
                <p class="text-xl line-through text-white/60">Rp {{ number_format($saleData['sub_total'], 0, ',', '.') }}</p>
            @endif
            <p class="text-2xl font-bold">Rp {{ number_format($saleData['total'], 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection