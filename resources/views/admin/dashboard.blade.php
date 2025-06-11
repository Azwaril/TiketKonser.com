@extends('layouts.app')

@section('content')
<div class="py-2 bg-white min-h-screen px-4 text-gray-900">
    <h1 class="text-5xl py-9 font-bold text-center">Dashboard Admin</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Kelola Event -->
        <a href="{{ route('admin.events.index') }}"
           class="bg-gray-900 hover:bg-gray-800 text-gray-900 transition p-6 rounded-xl shadow-md">
            <div class="text-indigo-600 text-4xl mb-3">
                <i class="fas fa-music"></i>
            </div>
            <h3 class="text-lg text-white font-semibold">Kelola Event</h3>
            <p class="text-sm text-gray-200 mt-1">Tambah, edit, dan hapus event konser.</p>
        </a>

        <!-- Kelola Tiket -->
        <a href="{{ route('admin.tickets.index') }}"
           class="bg-gray-900 hover:bg-gray-800 text-gray-900 transition p-6 rounded-xl shadow-md">
            <div class="text-yellow-600 text-4xl mb-3">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <h3 class="text-lg text-white font-semibold">Kelola Tiket</h3>
            <p class="text-sm text-gray-200 mt-1">Atur harga, kuota, dan tipe tiket.</p>
        </a>

        <!-- Kelola Pembayaran -->
        <a href="{{ route('admin.payments.index') }}"
           class="bg-gray-900 hover:bg-gray-800 text-gray-900 transition p-6 rounded-xl shadow-md">
            <div class="text-green-600 text-4xl mb-3">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <h3 class="text-lg text-white font-semibold">Pembayaran</h3>
            <p class="text-sm text-gray-200 mt-1">Pantau dan verifikasi transaksi.</p>
        </a>

        <!-- Kelola Konser Selesai -->
        <a href="{{ route('admin.concerts.index') }}"
           class="bg-gray-900 hover:bg-gray-800 text-gray-900 transition p-6 rounded-xl shadow-md">
            <div class="text-blue-600 text-4xl mb-3">
                <i class="fas fa-history"></i>
            </div>
            <h3 class="text-lg text-white font-semibold">Kelola Konser Selesai</h3>
            <p class="text-sm text-gray-200 mt-1">Buat artikel & review konser yang telah berlalu.</p>
        </a>

    </div>
</div>
@endsection
