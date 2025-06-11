@extends('layouts.app')

@section('title', 'Edit Event - Admin')

@section('content')
<div class="max-w-4xl mx-auto mt-12 bg-gray-900 p-8 rounded-xl shadow-md text-white">
    <h2 class="text-3xl font-bold mb-6 text-gray-100">Edit Event</h2>

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Judul Event --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-300">Judul Event</label>
            <input id="title" name="title" type="text"
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                   value="{{ old('title', $event->title) }}" required>
            @error('title')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>{{ old('description', $event->description) }}</textarea>
            @error('description')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="location" class="block text-sm font-medium text-gray-300">Lokasi</label>
            <input id="location" name="location" type="text"
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                   value="{{ old('location', $event->location) }}" required>
            @error('location')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="date" class="block text-sm font-medium text-gray-300">Tanggal</label>
            <input id="date" name="date" type="date"
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400"
                   value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d')) }}" required>
            @error('date')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gambar --}}
        <div>
            <label for="image" class="block text-sm font-medium text-gray-300">Gambar (opsional)</label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
            @error('image')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror

            @if ($event->image)
                <div class="mt-3">
                    <p class="text-sm text-gray-400 mb-1">Gambar saat ini:</p>
                    <img src="{{ asset('images/' . $event->image) }}" alt="Event Image" class="w-48 rounded shadow-md">
                </div>
            @endif
        </div>

        {{-- Tombol Submit --}}
        <div>
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl shadow font-semibold transition duration-300">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
