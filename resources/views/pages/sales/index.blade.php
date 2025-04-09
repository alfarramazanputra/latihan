@extends('layout.main')

@section('content')
<div class="container mt-4">
    <!-- Title -->
    <h1 class="h4 mb-4">Penjualan</h1>

    <!-- Actions -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <div>
            @if (Auth::user()->role === 'petugas')
                <a href="{{ route('sales.productSale') }}" class="btn btn-primary">+ Tambah Penjualan</a>
            @endif
        </div>
        <form action="{{ route('sales.index') }}" method="GET" class="d-flex">
            <input type="text" name="keyword" class="form-control me-2" placeholder="Cari..." value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-outline-secondary">Cari</button>
        </form>
    </div>

    <!-- Table -->
    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table table-striped table-bordered mb-0">
            <thead class="table-light">
                <tr>
                    <th>No.</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Dibuat Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->member_id ? $item->member_name : 'Non-Member' }}</td>
                        <td>{{ $item->date }}</td>
                        <td>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                        <td>{{ $item->created_by }}</td>
                        <td>
                            {{-- Uncomment jika ingin export PDF
                            <form action="{{ route('sales.invoice', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning text-white">PDF</button>
                            </form>
                            --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-3 d-flex justify-content-end">
        {{ $data->links() }}
    </div>
</div>
@endsection