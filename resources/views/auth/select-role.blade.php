<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Role - Paws & Perch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: url('{{ asset('images/back.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-4 py-8">

    <!-- Main Container -->
    <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-lg w-full max-w-3xl mx-auto px-6 md:px-12 py-10 md:py-16 md:ml-16">
        
        <!-- Logo and Title -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-orange-500 mb-2">🐾 Paws & Perch</h1>
            <p class="text-gray-700 text-lg font-semibold">Please select your login type</p>
        </div>

        <!-- Icons -->
        <div class="flex flex-col md:flex-row items-center justify-center gap-10">
            <!-- Customer Card -->
            <a href="{{ route('login') }}" class="flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/customer.png') }}" alt="Customer" class="w-24 h-24 object-cover rounded-full border-4 border-orange-300 shadow-md">
                <p class="mt-3 text-lg font-medium text-gray-800">Customer</p>
            </a>

            <!-- Admin Card -->
            <a href="{{ route('admin.login') }}" class="flex flex-col items-center hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/user.png') }}" alt="Admin" class="w-24 h-24 object-cover rounded-full border-4 border-orange-300 shadow-md">
                <p class="mt-3 text-lg font-medium text-gray-800">Admin</p>
            </a>
        </div>
    </div>

</body>
</html>
