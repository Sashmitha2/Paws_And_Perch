

<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center py-12 px-6 bg-gray-50">
        <div class="max-w-md w-full bg-white/80 backdrop-blur-lg shadow-2xl rounded-xl p-10">

            <h2 class="text-3xl font-extrabold text-[#D2691E] lobster-font mb-8 text-center drop-shadow-sm">
                Forgot Password
            </h2>

            <p class="mb-6 text-gray-700 text-center">
                Forgot your password? No problem. Just enter your email address below and we’ll send you a link to reset it.
            </p>

            @if (session('status'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded text-center shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-6" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        autofocus 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                        value="{{ old('email') }}"
                    />
                </div>

                <div>
                    <button 
                        type="submit"
                        class="w-full bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-3 rounded shadow-md transition duration-300 ease-in-out"
                    >
                        Email Password Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" class="text-orange-500 font-semibold hover:underline">
                    Back to login
                </a>
            </div>

            <p class="text-sm text-center text-gray-400 mt-8">&copy; {{ date('Y') }} Paws & Perch. All rights reserved.</p>
        </div>
    </div>
</x-guest-layout>
