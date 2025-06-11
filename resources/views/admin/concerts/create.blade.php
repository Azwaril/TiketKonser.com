@extends('layouts.app')

@section('title', 'Tambah Konser Selesai')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-gray-900 p-6 rounded-xl shadow-md text-white">
    <h2 class="text-2xl font-bold mb-6 text-white">Tambah Konser Selesai</h2>
    <form action="{{ route('admin.concerts.store') }}" method="POST">
        @csrf
        
        <div class="mb-5">
            <label class="block font-semibold mb-2">Judul</label>
            <input type="text" name="title" 
                   class="w-full bg-gray-800 border border-gray-700 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   value="{{ old('title') }}" required>
        </div>

        <div class="mb-5">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="description" rows="4" 
                      class="w-full bg-gray-800 border border-gray-700 px-4 py-2 rounded resize-none focus:outline-none focus:ring-2 focus:ring-blue-500" 
                      required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Tanggal Konser</label>
            <input type="date" name="date" 
                   class="w-full bg-gray-800 border border-gray-700 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   value="{{ old('date') }}" required>
        </div>

        <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200">
            Simpan
        </button>
    </form>
</div>
@endsection
