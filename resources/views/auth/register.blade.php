@extends('layouts.app')

@section('title', 'Register - TiketKonser.com')

@section('content')
<div class="flex justify-center items-center min-h-[80vh] bg-gray-50">
    <div class="w-full max-w-4xl bg-white p-16 rounded-lg shadow-2xl border border-gray-00">
        <h1 class="text-3xl font-extrabold mb-8 text-center text-gray-800">Buat Akun Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6 border border-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="name" class="block text-base font-semibold text-gray-700">Nama Lengkap</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm p-3 text-gray-900 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Masukkan nama lengkapmu"
                    required
                >
            </div>

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
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <div>
                <label for="password_confirmation" class="block text-base font-semibold text-gray-700">Konfirmasi Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    class="mt-2 block w-full border border-gray-300 rounded-md shadow-sm p-3 text-gray-900 placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Konfirmasi password"
                    required
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition font-semibold text-lg"
            >
                Daftar
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk</a>
        </p>
    </div>
</div>
@endsection
