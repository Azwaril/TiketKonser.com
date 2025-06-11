@extends('layouts.app')

@section('title', 'Event - TiketKonser.com')
@section('main_class', 'flex-grow w-full px-6')

@section('content')

<section class="pt-12 mb-16 px-6 bg-white text-gray-900 min-h-screen">
    <h1 class="text-5xl font-extrabold mb-12 text-center tracking-tight leading-tight">
        Daftar Event Konser
    </h1>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('events.index') }}" class="mb-6 max-w-7xl mx-auto flex justify-center">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari event konser..."
            class="border border-gray-300 rounded-l-lg px-4 py-2 w-80"
        />
        <button type="submit" class="bg-black text-white px-4 rounded-r-lg hover:bg-gray-800 transition">
            Cari
        </button>
    </form>


    @if ($events->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 max-w-7xl mx-auto">
        @foreach ($events as $event)
        <div 
            class="bg-white border border-gray-300 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden cursor-pointer group"
            onclick="window.location='{{ route('events.show', $event->id) }}'">
            <div class="relative w-full h-64 overflow-hidden rounded-t-2xl">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" 
                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500 ease-in-out">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-70"></div>
                <div class="absolute bottom-4 left-4 text-white drop-shadow-lg font-semibold">
                    <h2 class="text-2xl">{{ $event->title }}</h2>
                    <p class="text-sm flex items-center gap-2 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12l-3 3" />
                          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                        </svg>
                        {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}
                    </p>
                    <p class="text-sm flex items-center gap-2 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10v10h14V10" />
                        </svg>
                        {{ $event->location }}
                    </p>
                </div>
            </div>
            <div class="p-6 space-y-4 text-gray-800 leading-relaxed text-base">
                <p>{{ Str::limit($event->description, 120) }}</p>
                <a href="{{ route('events.show', $event->id) }}" 
                class="inline-flex items-center bg-black text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-800 transition duration-300 font-semibold text-sm tracking-wide">
                Lihat Detail →
                </a>

            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12 max-w-7xl mx-auto flex justify-center">
        {{ $events->links() }}
    </div>

    @else
    <p class="text-center text-gray-600 text-lg mt-20">Belum ada event konser yang tersedia saat ini.</p>
    @endif
</section>

@endsection
