@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="py-6 bg-gray-900 min-h-screen px-4 text-white rounded-lg">
    <div class="max-w-7xl mx-auto">

        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="inline-block bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded shadow text-sm">
                Kembali
            </a>
        </div>

        <h1 class="text-3xl font-bold mb-6 text-center">Kelola Pembayaran</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-600 rounded text-white shadow">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.payments.index') }}" method="GET" class="mb-6 max-w-md mx-auto">
            <div class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama user atau ID transaksi..."
                    class="w-full px-4 py-2 rounded bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                    Cari
                </button>
            </div>
        </form>
        <div class="bg-gray-800 shadow rounded-md overflow-x-auto">
            <table class="w-full table-auto text-left text-sm">
                <thead class="bg-gray-700 text-gray-300">
                    <tr>
                        <th class="px-6 py-3">ID Transaksi</th>
                        <th class="px-6 py-3">User</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                            <td class="px-6 py-4">{{ $payment->id }}</td>
                            <td class="px-6 py-4">{{ $payment->user->name ?? '-' }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($payment->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded 
                                    {{ $payment->status === 'paid' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                @if($payment->status === 'pending')
                                    <form action="{{ route('admin.payments.confirm', $payment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded shadow text-sm">
                                            Konfirmasi
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-400">Belum ada pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
</div>
@endsection
