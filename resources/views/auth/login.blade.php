@extends('layouts.app')

@section('title', 'Login - TiketKonser.com')


@section('content')
<div class="flex justify-center items-center min-h-[70vh] bg-gray-50"> <!-- kasih background abu-abu muda agar ada kontras -->
    <div class="w-full max-w-xl bg-white p-10 rounded-lg shadow-2xl border border-gray-200"> <!-- max-w lebih besar, padding lebih besar, border tipis, shadow lebih jelas -->
        <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-800">Masuk ke Akunmu</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6 border border-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-base font-semibold text-gray-700">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm p-3 text-gray-900 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan emailmu"
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-base font-semibold text-gray-700">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm p-3 text-gray-900 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan passwordmu"
                    required
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition font-semibold text-lg"
            >
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
        </p>
    </div>
</div>
@endsection
