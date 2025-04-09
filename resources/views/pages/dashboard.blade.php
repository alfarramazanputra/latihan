@extends('layout.main')
@section('content')

    <div class="text-sm text-gray-500 mb-2">
        <span class="font-semibold text-gray-700">Dashboard</span>
    </div>

    <h1 class="text-2xl font-semibold mb-6">Selamat Datang, {{ Auth::user()->role === 'admin' ? 'Administrator' : 'Petugas' }}!</h1>

    @if (Auth::user()->role === 'admin')
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Grafik Penjualan Harian -->
            <div class="col-span-3 bg-white p-4 rounded shadow">
                <h2 class="text-base font-semibold mb-2 text-center">Grafik Penjualan Harian</h2>
                <canvas id="salesChart" width="400" height="200" class="mx-auto"></canvas>
            </div>
        </div>
    @endif
@endsection