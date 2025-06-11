@extends('layouts.app')
@section('content')

<h1 class="text-3xl font-bold mb-6">Keranjang Belanja</h1>

@if(session('cart') && count(session('cart')) > 0)
    <table class="w-full bg-white rounded shadow">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-4">Event</th>
                <th class="p-4">Kategori Tiket</th>
                <th class="p-4">Jumlah</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $key => $item)
            <tr>
                <td class="p-4">{{ $item['event_title'] }}</td>
                <td class="p-4">{{ $item['ticket_category'] }}</td>
                <td class="p-4">{{ $item['quantity'] }}</td>
                <td class="p-4">
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="key" value="{{ $key }}">
                        <button class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('cart.checkout') }}" method="POST" class="mt-6">
        @csrf
        <button class="bg-green-600 text-white px-6 py-3 rounded">Checkout Sekarang</button>
    </form>
@else
    <p class="text-gray-600">Keranjang kamu kosong.</p>
@endif

@endsection
