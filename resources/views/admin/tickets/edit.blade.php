@extends('layouts.app')

@section('content')
<div class="py-6 bg-gray-900 min-h-screen px-4 text-white rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Tiket</h1>

    <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="event_id" class="block mb-1">Event</label>
            <select name="event_id" id="event_id" required
                    class="w-full bg-gray-700 text-white rounded px-3 py-2">
                @foreach($events as $event)
                    <option value="{{ $event->id }}" @selected(old('event_id', $ticket->event_id) == $event->id)>
                        {{ $event->title ?? $event->name }}
                    </option>
                @endforeach
            </select>
            @error('event_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category" class="block mb-1">Kategori Tiket</label>
            <select name="category" id="category" required
                    class="w-full bg-gray-700 text-white rounded px-3 py-2">
                <option value="vip" {{ old('category', $ticket->category) == 'vip' ? 'selected' : '' }}>VIP</option>
                <option value="reguler" {{ old('category', $ticket->category) == 'reguler' ? 'selected' : '' }}>Reguler</option>
            </select>
            @error('category')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="block mb-1">Harga Tiket</label>
            <input type="number" name="price" id="price" required min="0"
                   class="w-full bg-gray-700 text-white rounded px-3 py-2" value="{{ old('price', $ticket->price) }}">
            @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="stock" class="block mb-1">Stok Tiket</label>
            <input type="number" name="stock" id="stock" required min="0"
                   class="w-full bg-gray-700 text-white rounded px-3 py-2" value="{{ old('stock', $ticket->stock) }}">
            @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 px-4 py-2 rounded text-white">Update</button>
            <a href="{{ route('admin.tickets.index') }}" class="ml-2 text-gray-300 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
