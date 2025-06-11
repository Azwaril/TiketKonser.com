@extends('layouts.app')

@section('title', 'Pembayaran Tiket')
@section('main_class', 'flex-grow w-full px-6')


@section('content')
<div class="max-w-3xl mx-auto my-10 p-6 bg-white rounded-2xl shadow-xl">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-black" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8c.8 0 1.6.2 2.3.6M8.6 8.6a4 4 0 1 0 6.8 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Detail Transaksi
        </h2>
    </div>

    <div class="bg-gray-50 rounded-xl p-6 shadow-inner mb-6 space-y-3">
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
        <div class="flex justify-between text-gray-700 items-center">
            <span><strong>Status:</strong></span>
            <span class="inline-block px-3 py-1 text-sm font-medium text-white rounded-full 
                {{ $transaction->status === 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}">
                {{ ucfirst($transaction->status) }}
            </span>
        </div>
    </div>

    <form action="{{ route('payment.process', $transaction->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="method" class="block mb-1 text-gray-800 font-semibold">Pilih Metode Pembayaran</label>
            <select name="method" id="method" required class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-black focus:border-black">
                <option value="manual">Transfer Manual (Bank)</option>
                <option value="qris">QRIS</option>
                <option value="va">Virtual Account</option>
            </select>
        </div>

        <button type="submit"
            class="w-full bg-black hover:bg-gray-900 transition-all duration-200 text-white font-bold py-3 px-6 rounded-xl shadow-md hover:shadow-lg">
            <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
        </button>
    </form>
</div>
@endsection
