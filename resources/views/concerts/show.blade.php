@extends('layouts.app')

@section('main_class', 'flex-grow w-full px-6')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">

    <h2 class="text-4xl font-extrabold mb-8 text-gray-900">{{ $event->title }}</h2>

    {{-- Detail Event --}}
    <div class="bg-white shadow-lg rounded-lg p-6 mb-10">
        <p class="text-sm text-gray-500 mb-3">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
        <p class="text-gray-700 leading-relaxed">{{ $event->description }}</p>
    </div>

    {{-- Komentar --}}
    <h3 class="text-3xl font-semibold mb-6 text-gray-900">Komentar</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form komentar utama --}}
    <form action="{{ route('concerts.show', $event->id) }}" method="POST" class="mb-12 bg-white shadow-md rounded-lg p-6">
        @csrf
        <input type="hidden" name="parent_id" value="">

        <div class="mb-5">
            <label for="user_name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
            <input 
                type="text" 
                name="user_name" 
                id="user_name" 
                class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Masukkan nama Anda"
                required>
            @error('user_name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
            <textarea 
                name="comment" 
                id="comment" 
                rows="4" 
                class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                placeholder="Tulis komentar Anda di sini..." 
                required></textarea>
            @error('comment')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition-colors text-white font-semibold px-6 py-3 rounded-md shadow-sm">Kirim Komentar</button>
    </form>

    {{-- Daftar komentar --}}
    @if($event->comments->count())
        <ul class="space-y-8">
            @foreach($event->comments as $comment)
                <li class="bg-white shadow rounded-lg p-5">
                    <div class="flex justify-between items-center mb-3">
                        <p class="font-semibold text-gray-900">{{ $comment->user_name }}</p>
                        <time class="text-gray-400 text-sm" title="{{ $comment->created_at }}">{{ $comment->created_at->format('d M Y H:i') }}</time>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-4">{{ $comment->comment }}</p>

                    {{-- Balasan komentar --}}
                    @if($comment->replies->count())
                        <ul class="ml-6 border-l-2 border-gray-200 pl-5 space-y-4 mb-4">
                            @foreach($comment->replies as $reply)
                                <li class="bg-gray-50 rounded-md p-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <p class="font-semibold text-gray-800">{{ $reply->user_name }}</p>
                                        <time class="text-gray-400 text-xs" title="{{ $reply->created_at }}">{{ $reply->created_at->format('d M Y H:i') }}</time>
                                    </div>
                                    <p class="text-gray-600 leading-relaxed">{{ $reply->comment }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Form Balasan --}}
                    <button 
                        onclick="toggleReplyForm({{ $comment->id }})" 
                        class="text-blue-600 hover:underline text-sm font-medium mb-3"
                        type="button">Balas</button>
                    <form action="{{ route('concerts.show', $event->id) }}" method="POST" class="hidden mb-4" id="reply-form-{{ $comment->id }}">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">

                        <input 
                            type="text" 
                            name="user_name" 
                            placeholder="Nama Anda" 
                            class="border border-gray-300 rounded-md px-3 py-2 w-full mb-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                            required>

                        <textarea 
                            name="comment" 
                            rows="2" 
                            placeholder="Tulis balasan..." 
                            class="border border-gray-300 rounded-md px-3 py-2 w-full mb-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                            required></textarea>

                        <button type="submit" class="bg-green-600 hover:bg-green-700 transition-colors text-white font-semibold px-4 py-2 rounded-md shadow-sm">Kirim Balasan</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p class="italic text-gray-500">Belum ada komentar.</p>
    @endif

</div>

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById('reply-form-' + commentId);
    form.classList.toggle('hidden');
}
</script>
@endsection
