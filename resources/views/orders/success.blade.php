<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Order Confirmation</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="max-w-md mx-auto p-8 bg-white shadow-2xl rounded-2xl mt-24 text-center 
                ring-1 ring-green-300
                animate-fadeIn">
        <!-- Success Icon -->
        <div class="mx-auto mb-6 w-20 h-20 flex items-center justify-center rounded-full bg-green-100 text-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="text-4xl font-extrabold text-green-700 mb-4">Order Placed Successfully!</h1>

        <p class="text-gray-700 text-lg mb-4">Thank you for your purchase.</p>

        <p class="text-gray-800 text-lg mb-6">
            Your order <span class="font-semibold text-indigo-600">#12345</span> has been placed.
        </p>

        <p class="text-gray-900 text-xl font-bold mb-8">
            Order total: <span class="text-green-600">Rs. 2,499.00</span>
        </p>

        <a href="{{route('home')}}" 
           class="inline-block px-8 py-3 rounded-full bg-indigo-600 text-white font-semibold
                  hover:bg-indigo-700 transition shadow-lg
                  focus:outline-none focus:ring-4 focus:ring-indigo-300">
            Back to Home
        </a>
    </div>

</body>
</html>
