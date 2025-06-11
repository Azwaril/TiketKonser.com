@extends('layouts.app')

@section('title', 'Tambah Event - Admin')

@section('content')
<div class="max-w-4xl mx-auto mt-12 bg-gray-900 p-8 rounded-xl shadow-md text-white">
    <h2 class="text-3xl font-bold mb-6 text-gray-100">Tambah Event</h2>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="title" class="block text-sm font-medium text-gray-300">Judul Event</label>
            <input id="title" name="title" type="text" 
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-300">Deskripsi</label>
            <textarea id="description" name="description" rows="4" 
                      class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required></textarea>
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-300">Lokasi</label>
            <input id="location" name="location" type="text" 
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div>
            <label for="date" class="block text-sm font-medium text-gray-300">Tanggal</label>
            <input id="date" name="date" type="date" 
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white placeholder-gray-400 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-300">Gambar</label>
            <input id="image" name="image" type="file" accept="image/*" 
                   class="w-full bg-gray-800 border border-gray-700 rounded-md p-2 text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>

        <div>
            <button type="submit" 
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl shadow font-semibold transition duration-300">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
