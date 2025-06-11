@extends('layouts.app')

@section('title', 'Tiket Event - ' . $event->title)
@section('main_class', 'flex-grow w-full px-6')

@section('content')
<div class="max-w-4xl mx-auto my-12 p-8 bg-white rounded-3xl shadow-xl">
    <h1 class="text-3xl font-extrabold mb-4 text-black">{{ $event->title }}</h1>
    <p class="mb-8 text-gray-700 leading-relaxed">{{ $event->description }}</p>

    <h2 class="text-2xl font-semibold mb-6 text-black">Tiket Tersedia</h2>

    @if($event->tickets->count())
        <div class="space-y-5">
            @foreach($event->tickets as $ticket)
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 bg-gray-50 border border-gray-300 rounded-2xl shadow-sm hover:shadow-lg transition duration-300">
                    <div class="space-y-1">
                        <h3 class="text-lg font-bold text-black">{{ $ticket->category }}</h3>
                        <p class="text-gray-600 text-sm">Tersedia: {{ $ticket->stock }} tiket</p>
                        <p class="text-xl text-black font-semibold">Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
                    </div>

                    {{-- Form Beli Tiket --}}
                    <form action="{{ route('checkout') }}" method="POST" class="mt-4 md:mt-0 md:flex md:items-center gap-2">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $ticket->stock }}"
                            class="border border-gray-400 rounded-lg px-3 py-2 w-24 focus:ring focus:ring-gray-300 text-black">
                        <button type="submit"
                            class="px-5 py-2 bg-black hover:bg-gray-800 text-white font-semibold rounded-lg shadow-md transition-all">
                            Beli
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 italic">Belum ada tiket tersedia untuk event ini.</p>
    @endif
</div>
@endsection
