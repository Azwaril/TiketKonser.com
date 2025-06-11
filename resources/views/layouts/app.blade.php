<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'TiketKonser.com')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-white text-gray-900 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="flex justify-between items-center p-4 border-b">
        <a href="/" class="text-2xl font-bold text-gray-900 hover:text-black">TiketKonser.com</a>

         <nav class="hidden md:flex gap-6 text-sm absolute left-1/2 transform -translate-x-1/2">
            <a href="/" class="text-gray-700 hover:text-black">Beranda</a>
            <a href="{{ route('events.index') }}" class="text-gray-700 hover:text-black">Event</a>
            <a href="{{ route('tickets.index') }}" class="text-gray-700 hover:text-black">Ticket</a>
            <a href="{{ route('concerts.finished') }}" class="text-gray-700 hover:text-black">Article</a>
            <a href="/contact" class="text-gray-700 hover:text-black">Contact</a>
        </nav>

        <div class="relative" x-data="{ open: false }">
            @auth
                <button @click="open = !open"
                        <button @click="open = !open" class="flex items-center space-x-1 text-xm font-semibold text-black hover:text-gray-700 focus:outline-none">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" @click.outside="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg py-2 z-50 text-sm">
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Dashboard</a>
                    @else
                        <a href="/profile"
                        class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Profile</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600 font-semibold">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}" 
                        class="text-gray-800 border border-gray-800 hover:bg-gray-100 
                            py-1.5 px-4 rounded-full transition duration-200 text-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                        class="bg-black hover:bg-gray-500 text-white 
                            py-1.5 px-4 rounded-full transition duration-200 text-sm">
                        Register
                    </a>
                </div>
            @endauth

        </div>

    </header>

    <!-- Main Content -->
    <main class="{{ $__env->yieldContent('main_class', 'flex-grow max-w-7xl mx-auto p-4') }}">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-6">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-white text-lg font-semibold mb-3">TiketKonser.com</h3>
                <p class="text-gray-400 text-sm leading-relaxed">
                    Platform terpercaya untuk membeli tiket konser favoritmu dengan mudah dan cepat. Nikmati pengalaman konser yang tak terlupakan bersama kami.
                </p>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-3">Link Cepat</h3>
                <ul class="text-sm space-y-1">
                    <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Event</a></li>
                    <li><a href="{{ route('tickets.index') }}" class="hover:text-white transition">ticket</a></li>
                    <li><a href="{{ route('concerts.finished') }}" class="hover:text-white transition">article</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-3">Kontak Kami</h3>
                <p class="text-sm">Email: support@tiketkonser.com</p>
                <p class="text-sm">Telepon: +62 812 3456 7890</p>
                <div class="flex space-x-3 mt-3">
                    <!-- Icon social media -->
                    <a href="#" class="hover:text-white transition" aria-label="Facebook">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M22 12a10 10 0 10-11.5 9.9v-7h-3v-3h3v-2.3c0-3 1.8-4.7 4.5-4.7 1.3 0 2.7.24 2.7.24v3h-1.5c-1.5 0-2 1-2 2v2.3h3.4l-.54 3h-2.9v7A10 10 0 0022 12z"/></svg>
                    </a>
                    <a href="#" class="hover:text-white transition" aria-label="Twitter">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5.5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
                    </a>
                    <a href="#" class="hover:text-white transition" aria-label="Instagram">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zm8.75 2a1 1 0 110 2 1 1 0 010-2zm-4.25 2a4.5 4.5 0 110 9 4.5 4.5 0 010-9zm0 2a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center text-gray-500 text-xs">
            &copy; {{ date('Y') }} TiketKonser.com
        </div>
    </footer>

</body>
</html>
