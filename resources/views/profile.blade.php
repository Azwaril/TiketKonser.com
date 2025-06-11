@extends('layouts.app')

@section('title', 'Profil Saya')
@section('main_class', 'flex-grow w-full px-6')

@section('content')
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-6 rounded-xl shadow-lg mt-8">

    <h1 class="text-3xl font-bold mb-6 text-center">Profil Saya</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-500 text-white rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert sukses password --}}
    @if(session('success_password'))
        <div class="mb-4 p-3 bg-green-600 text-white rounded">
            {{ session('success_password') }}
        </div>
    @endif

    {{-- FORM UBAH PROFIL --}}
    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block font-medium mb-1">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-gray-900 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                Simpan Perubahan
            </button>
        </div>
    </form>

    <hr class="my-8 border-gray-300 dark:border-gray-700">

    <h2 class="text-2xl font-semibold mb-4">Ganti Password</h2>

    {{-- FORM GANTI PASSWORD --}}
    <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="current_password" class="block font-medium mb-1">Password Lama</label>
            <input type="password" name="current_password" id="current_password"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   required>
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-medium mb-1">Password Baru</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium mb-1">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   required>
        </div>

        <div class="text-right">
            <button type="submit"
                    class="bg-gray-900 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded-lg transition">
                Ganti Password
            </button>
        </div>
    </form>
</div>
@endsection
