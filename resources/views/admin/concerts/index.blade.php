@extends('layouts.app')

@section('title', 'Kelola Konser Selesai')

@section('content')
<div class="py-6 bg-gray-900 min-h-screen px-4 text-white rounded-lg">
    <div class="max-w-7xl mx-auto">
        <div class="relative flex items-center mb-6">
            <!-- Tombol Back di kiri, posisi absolute -->
            <a href="{{ route('admin.dashboard') }}" 
            class="absolute left-0 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition duration-200 ease-in-out inline-block">
                kembali
            </a>

            <!-- Judul di tengah -->
            <h1 class="text-3xl font-bold text-center w-full">Konser Selesai</h1>

            <!-- Tombol Tambah Konser di kanan, posisi absolute -->
            <a href="{{ route('admin.concerts.create') }}" 
            class="absolute right-0 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow transition text-sm">
            + Tambah Konser
            </a>
        </div>


        @if(session('success'))
            <div class="mb-4 p-3 bg-green-600 rounded text-white shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($finishedEvents->count())
            <div class="bg-gray-800 shadow rounded-md overflow-x-auto">
                <table class="w-full table-auto text-left text-sm">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-6 py-3">Judul</th>
                            <th class="px-6 py-3">Tanggal</th>
                            <th class="px-6 py-3">Deskripsi</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($finishedEvents as $event)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                <td class="px-6 py-4 whitespace-nowrap font-semibold truncate max-w-xs">{{ $event->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300 truncate max-w-md">{{ $event->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                    <a href="{{ route('admin.concerts.edit', $event->id) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow transition font-semibold">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.concerts.destroy', $event->id) }}" method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus konser ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow transition font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-400 italic mt-12">Belum ada konser yang selesai.</p>
        @endif
    </div>
</div>
@endsection
