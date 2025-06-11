@extends('layouts.app')

@section('title', 'Tiket Saya')
@section('main_class', 'flex-grow w-full px-6')


@section('content')
<section class="pt-12 mb-16 px-6 bg-white text-gray-900 min-h-screen">
    <h1 class="text-5xl font-bold text-black mb-12 text-center">Tiket Saya</h1>

    @if($transactions->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($transactions as $transaction)
                @if($transaction->status === 'paid')
                <div
                    class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white rounded-3xl shadow-xl overflow-hidden transform hover:scale-105 transition-transform duration-300 cursor-pointer relative">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold tracking-wide">{{ $transaction->ticket->event->title }}</h2>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-500">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>

                        <p class="text-sm text-gray-300 mb-2">{{ $transaction->ticket->category }} — 
                            <span class="font-semibold">Qty: {{ $transaction->quantity }}</span></p>

                        <p class="text-sm text-gray-300 mb-6">
                            Tanggal Konser: 
                            <span class="font-semibold text-white">
                                {{ \Carbon\Carbon::parse($transaction->ticket->event->date)->format('d M Y') }}
                            </span>
                        </p>

                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <p class="text-lg font-semibold">Total Bayar</p>
                                <p class="text-xl text-green-400 font-extrabold">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right text-gray-400 text-sm">
                                <p>Tanggal Pembelian</p>
                                <p>{{ $transaction->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 w-20 h-10 border-t-4 border-white rounded-t-full opacity-70"></div>
                    </div>

                    <!-- Decorative side cuts like ticket edges -->
                    <div class="absolute top-0 bottom-0 left-0 w-6 bg-gray-900 rounded-r-full shadow-inner"></div>
                    <div class="absolute top-0 bottom-0 right-0 w-6 bg-gray-900 rounded-l-full shadow-inner"></div>
                </div>
                @endif
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 italic text-lg mt-10">Kamu belum membeli tiket apapun.</p>
    @endif
</div>
@endsection
