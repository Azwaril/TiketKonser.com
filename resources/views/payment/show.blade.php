@extends('layouts.app')

@section('title', 'Pembayaran Tiket')
@section('main_class', 'flex-grow w-full px-6')

@section('content')
<div class="max-w-3xl mx-auto my-12 p-6 bg-white rounded-2xl shadow-lg">

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-md shadow">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-semibold mb-6 text-gray-800 flex items-center gap-3">
        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c.8 0 1.6.2 2.3.6M8.6 8.6a4 4 0 1 0 6.8 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        Detail Transaksi
    </h1>

    <div class="bg-gray-50 rounded-xl p-6 shadow-inner mb-8 space-y-4">
        <div class="flex justify-between text-gray-700">
            <span><strong>Event:</strong></span>
            <span>{{ $transaction->ticket->event->title }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span><strong>Kategori Tiket:</strong></span>
            <span>{{ $transaction->ticket->category }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span><strong>Harga Satuan:</strong></span>
            <span>Rp {{ number_format($transaction->ticket->price, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span><strong>Jumlah Tiket:</strong></span>
            <span>{{ $transaction->quantity }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span><strong>Total Pembayaran:</strong></span>
            <span class="text-green-600 font-semibold">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between items-center text-gray-700">
            <span><strong>Status:</strong></span>
            <span class="inline-block px-3 py-1 rounded-full text-white font-semibold 
                {{ $transaction->status === 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}">
                {{ ucfirst($transaction->status) }}
            </span>
        </div>

        @if(session('payment_method'))
        <div class="flex justify-between text-gray-700 mt-4">
            <span><strong>Metode Pembayaran:</strong></span>
            <span class="font-semibold capitalize">{{ session('payment_method') }}</span>
        </div>
        @endif
    </div>

    {{-- Jika status masih pending, tampilkan form pembayaran --}}
    @if($transaction->status === 'pending')
    <form action="{{ route('payment.process', $transaction->id) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="method" class="block mb-2 font-semibold text-gray-800">Pilih Metode Pembayaran</label>
            <select name="method" id="method" required
                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="" disabled selected>Pilih metode pembayaran</option>
                <option value="manual">Transfer Manual (Bank)</option>
                <option value="qris">QRIS</option>
                <option value="va">Virtual Account</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200">
            Bayar Sekarang
        </button>
    </form>
    @else
    {{-- Jika sudah dibayar, tombol selesai untuk kembali --}}
    <div class="mt-6">
        <a href="{{ route('home') }}" 
           class="block text-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-md transition duration-200">
           Selesai
        </a>
    </div>
    @endif

</div>
@endsection
