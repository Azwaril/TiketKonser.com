@extends('layouts.app')

@section('title', 'Admin - Manage Events')

@section('content')
<div class="py-6 bg-gray-900 min-h-screen px-4 text-white rounded-lg">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <!-- Tombol Back di kiri -->
            <a href="{{ route('admin.dashboard') }}" 
            class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow transition duration-200 ease-in-out inline-block">
                kembali
            </a>

            <!-- Judul di tengah -->
            <h1 class="text-3xl font-bold text-center flex-grow mx-4">Kelola Event</h1>

            <!-- Tombol Tambah Event di kanan -->
            <a href="{{ route('admin.events.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition">
               + Tambah Event
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-600 rounded text-white shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-gray-800 shadow rounded-md overflow-x-auto">
            <table class="w-full table-auto text-left text-sm">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="px-6 py-3">Judul</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $event->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $event->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                <a href="{{ route('admin.events.edit', $event->id) }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded shadow transition font-semibold">
                                   Edit
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
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

        <div class="mt-4 text-white">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection
