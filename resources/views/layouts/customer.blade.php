{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Paws & Perch - Customer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- ✅ Custom Navigation Bar -->
    <nav class="bg-orange-100 border-b border-orange-300 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-xl font-bold text-orange-700">🐾 Paws & Perch</a>
                    <a href="#" class="text-orange-700 hover:underline">My Orders</a>
                    <a href="#" class="text-orange-700 hover:underline">Shop</a>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-600 hover:underline">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- ✅ Page Content -->
    <main class="py-10 max-w-7xl mx-auto px-4">
        {{ $slot }}
    </main>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html> --}}
