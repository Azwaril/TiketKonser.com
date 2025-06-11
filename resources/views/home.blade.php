@extends('layouts.app')

@section('title', 'Beranda - TiketKonser.com')

@section('content')

<!-- Hero Section mirip Bucini -->
<section class="relative mb-16">
    <img src="{{ asset('images/konser.jpeg') }}" alt="Konser" class="w-full h-[500px] object-cover ">
    <div class="absolute inset-0 flex items-center justify-start p-10">
        <div class="text-white max-w-xl bg-black/50 p-6 rounded-lg">
            <h1 class="text-4xl font-bold mb-4">Temukan & Beli Tiket Konser Favoritmu</h1>
            <p class="text-base mb-6">Dari konser lokal hingga internasional, semua tiket konser ada di sini. Nikmati pengalaman menonton konser dengan mudah dan cepat!</p>
            <a href="{{ route('events.index') }}" class="bg-white text-black px-6 py-3 rounded hover:bg-gray-200 transition">Lihat Event</a>
        </div>
    </div>
</section>



@endsection
