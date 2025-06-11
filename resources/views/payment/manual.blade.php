@extends('layouts.app')

@section('title', 'Instruksi Pembayaran - Transfer Manual')


@section('content')
<div class="max-w-3xl mx-auto my-10 p-6 bg-white rounded-2xl shadow-xl">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 8c.8 0 1.6.2 2.3.6M8.6 8.6a4 4 0 1 0 6.8 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            Transfer Manual (Bank)
        </h2>
    </div>

    <div class="space-y-4 text-gray-700">
        <p>Silakan transfer total pembayaran ke rekening berikut:</p>

        <div class="bg-gray-100 rounded-xl p-4 space-y-2">
            <div class="flex justify-between">
                <span><strong>Bank</strong></span>
                <span>BCA</span>
            </div>
            <div class="flex justify-between">
                <span><strong>No. Rekening</strong></span>
                <span>1234567890</span>
            </div>
            <div class="flex justify-between">
                <span><strong>Atas Nama</strong></span>
                <span>PT Event Maju</span>
            </div>
            <div class="flex justify-between text-green-600 font-semibold">
                <span><strong>Total</strong></span>
                <span>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <p class="text-sm text-gray-600">Setelah melakukan transfer, konfirmasi pembayaran ke admin melalui WhatsApp atau email.</p>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('payment.show', $transaction->id) }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-200">
            Lihat Pembayaran
        </a>
    </div>
</div>
@endsection
