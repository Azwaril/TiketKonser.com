@extends('layouts.app')

@section('title', $event->title . ' - TiketKonser.com')


@section('content')

@php
    // Ambil tiket kategori 'reguler' dengan stok > 0
    $regulerTickets = $event->tickets->filter(fn($t) => strtolower($t->category) === 'reguler' && $t->stock > 0);

    // Ambil harga minimum tiket reguler jika ada, kalau tidak fallback ke tiket mana pun yang stok > 0
    $minPriceTicket = $regulerTickets->min('price');
    if (is_null($minPriceTicket)) {
        $availableTickets = $event->tickets->filter(fn($t) => $t->stock > 0);
        $minPriceTicket = $availableTickets->min('price') ?? 0;
    }

    // Cek ada stok tiket atau tidak
    $hasAvailableTickets = $event->tickets->contains(fn($t) => $t->stock > 0);
@endphp

<section class="max-w-5xl mx-auto my-12 p-6 bg-white rounded-xl shadow-lg">
    <div class="mb-8">
        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full rounded-lg object-cover max-h-96">
    </div>

    <h1 class="text-3xl font-bold mb-4 text-gray-900">{{ $event->title }}</h1>

    <div class="flex flex-wrap gap-6 mb-6 text-gray-700">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6a9 9 0 110 18 9 9 0 010-18z" />
            </svg>
            <span>{{ \Carbon\Carbon::parse($event->date)->format('d M Y, H:i') }}</span>
        </div>

        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414 17.657 8.172" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.343 8.172L10.586 12.414 6.343 16.657" />
            </svg>
            <span>{{ $event->location }}</span>
        </div>
    </div>

    <p class="text-gray-700 leading-relaxed mb-8">{{ $event->description }}</p>

    <div class="border-t pt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="text-lg font-semibold text-gray-900">Harga Tiket: 
            <span class="text-indigo-600">{{ number_format($minPriceTicket, 0, ',', '.') }} IDR</span>
        </div>

        @if($hasAvailableTickets)
            <a href="{{ route('events.ticket', $event->id) }}" 
               class="inline-block bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition">
                Pilih Tiket
            </a>
        @else
            <button disabled
                    class="inline-block bg-gray-400 text-white px-6 py-3 rounded-lg font-semibold cursor-not-allowed" 
                    title="Tiket habis">
                Tiket Habis
            </button>
        @endif
    </div>
</section>

@endsection
