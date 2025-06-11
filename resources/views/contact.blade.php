@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<section class="bg-gray-100 py-16 min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Hubungi Kami</h2>
            <p class="mt-2 text-gray-600 text-base md:text-lg">Kami siap membantu Anda kapan saja.</p>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
        <div id="alert-success" class="mb-6 px-4 py-3 rounded-md bg-green-100 text-green-800 shadow text-center">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Formulir Kontak -->
            <div class="bg-gray-200 rounded-xl p-8 shadow">
                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:ring-2 focus:ring-gray-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:ring-2 focus:ring-gray-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pesan</label>
                        <textarea name="message" rows="5" required
                            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-700 focus:ring-2 focus:ring-gray-500 focus:outline-none"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-3 bg-gray-900 text-white font-semibold rounded-md hover:bg-gray-800 transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Info Kontak -->
            <div class="text-gray-900 space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-gray-300 rounded-full">
                        <svg class="w-6 h-6 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 10.5a8.38 8.38 0 01-1.9 5.4L12 22l-7.1-6.1A8.38 8.38 0 013 10.5C3 6.4 6.4 3 10.5 3S18 6.4 18 10.5zM10.5 12a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold">Alamat</h4>
                        <p class="text-sm text-gray-600">Jl. Harmoni Musik No. 88, Jakarta, Indonesia 12345</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-gray-300 rounded-full">
                        <svg class="w-6 h-6 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 4l-7 4.5L5 8V6l7 4.5L19 6v2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold">Email</h4>
                        <p class="text-sm text-gray-600">support@tiketkonser.com</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-gray-300 rounded-full">
                        <svg class="w-6 h-6 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 10.5c0-.28-.22-.5-.5-.5h-2.54c-.28 0-.52.22-.52.5v2.54c0 .28.22.5.5.5h2.54c.28 0 .5-.22.5-.5V10.5zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold">Telepon</h4>
                        <p class="text-sm text-gray-600">+62 812 3456 7890</p>
                    </div>
                </div>

                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-500 hover:text-gray-800">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-800">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-800">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fade-out notifikasi -->
<script>
    setTimeout(() => {
        const alert = document.getElementById('alert-success');
        if (alert) {
            alert.classList.add('opacity-0', 'transition-opacity', 'duration-700');
            setTimeout(() => alert.remove(), 800);
        }
    }, 4000);
</script>
@endsection
