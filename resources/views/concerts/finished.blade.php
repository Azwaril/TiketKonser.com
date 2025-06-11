@extends('layouts.app')

@section('title', 'Konser yang Sudah Selesai')
@section('main_class', 'flex-grow w-full px-6')


@section('content')
<section class="pt-12 mb-16 px-6 bg-white text-gray-900 min-h-screen">
    <h1 class="text-5xl font-bold text-black mb-12 text-center">Konser Selesai</h1>

    @if($events->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($events as $event)
                <div
                    class="bg-white border border-gray-300 rounded-2xl shadow-md hover:shadow-xl transition flex flex-col overflow-hidden"
                >
                    {{-- Gambar event --}}
                    <div class="h-48 md:h-56 w-full overflow-hidden rounded-t-2xl">
                        <img 
                            src="{{ $event->image ? asset('storage/' . $event->image) : 'https://via.placeholder.com/600x400?text=No+Image' }}" 
                            alt="{{ $event->title }}" 
                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                        >
                    </div>


                    {{-- Isi konten --}}
                    <div class="p-6 flex flex-col flex-grow justify-between">
                        <div>
                            <h2 class="text-2xl font-semibold text-black mb-2 line-clamp-2">{{ $event->title }}</h2>
                            <p class="text-gray-700 mb-3 line-clamp-3">{{ $event->description }}</p>
                            <p class="text-sm text-gray-500">Tanggal: {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                        </div>

                        {{-- Tombol Komentar --}}
                        <div class="mt-6">
                            <a href="{{ route('concerts.show', $event->id) }}#comments" 
                            class="inline-block bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition"
                            >
                                Tulis Komentar
                            </a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 italic">Belum ada konser yang selesai.</p>
    @endif
</div>
@endsection
