@extends('layouts.app')

@section('title', 'Admin - Manage Tickets')

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
            <h1 class="text-2xl font-bold text-center flex-grow mx-4">Daftar Tiket</h1>

            <!-- Tombol Tambah Tiket di kanan -->
            <a href="{{ route('admin.tickets.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow transition">
                + Tambah Tiket
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
                        <th class="px-4 py-3">Event</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Stok</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                            <td class="px-4 py-3">{{ $ticket->event->title }}</td>
                            <td class="px-4 py-3">{{ $ticket->category }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $ticket->stock }}</td>
                            <td class="px-4 py-3 flex gap-2">
                                <a href="{{ route('admin.tickets.edit', $ticket) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tiket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow transition">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-400">Belum ada tiket.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4 text-white">
            {{ $tickets->links() }}
        </div>
    </div>
</div>
@endsection
