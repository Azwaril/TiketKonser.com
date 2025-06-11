@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
<div class="py-6 bg-gray-900 min-h-screen px-4 text-white rounded-lg">
    <div class="max-w-3xl mx-auto bg-gray-800 p-8 rounded shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">Profile Saya</h1>

        <div class="space-y-4">
            <div>
                <label class="block text-gray-400 mb-1 font-semibold">Nama Lengkap</label>
                <p class="text-lg text-white">{{ Auth::user()->name }}</p>
            </div>

            <div>
                <label class="block text-gray-400 mb-1 font-semibold">Email</label>
                <p class="text-lg text-white">{{ Auth::user()->email }}</p>
            </div>

            <div>
                <label class="block text-gray-400 mb-1 font-semibold">Role</label>
                <p class="text-lg text-white">{{ ucfirst(Auth::user()->role) }}</p>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <a href="{{ route('profile.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded font-semibold transition">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
