<x-guest-layout>
    <div 
        class="min-h-screen flex justify-center items-center bg-cover bg-center bg-no-repeat py-12 px-6"
        style="background-image: url('{{ asset('images/bac.jpg') }}');"
    >
        <div class="max-w-4xl w-full bg-white/80 backdrop-blur-lg shadow-2xl rounded-xl overflow-hidden flex flex-col md:flex-row">
            
            <!-- Left: Welcome Section -->
            <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-orange-100 via-white to-orange-50 md:w-1/2 p-10 text-center relative overflow-hidden shadow-inner">

               
                <div class="z-10">
                    <h2 class="text-4xl font-extrabold text-orange-600 lobster-font mb-6 drop-shadow-md">
                        🐾 Welcome to Paws & Perch
                    </h2>

                    <p class="text-gray-700 text-base leading-relaxed font-medium">
                        Where pets meet quality and care.<br><br>
                        Log in now to explore our curated collection of premium pet supplies,<br>
                        manage your orders, and keep tails wagging!
                    </p>

                    <!-- Optional cute icon or mascot -->
                  <img src="{{ asset('images/pets.png') }}" alt="Cute Dog" class="w-24 mt-6 mx-auto animate-pulse" />

                </div>
            </div>


            <!-- Right: Login Form -->
            <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
                <h2 class="text-4xl font-extrabold text-[#D2691E] text-center lobster-font mb-8 drop-shadow-sm">
                    Login
                </h2>

                <x-validation-errors class="mb-6" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <x-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                        <x-input 
                            id="email" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                        />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                        <x-input 
                            id="password" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50" 
                            type="password" 
                            name="password" 
                            required 
                        />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <label for="remember_me" class="ms-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-between mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-orange-500 hover:underline" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button 
                            type="submit"
                            class="bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out">
                            Log in
                        </button>

                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-700">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-orange-500 font-semibold hover:underline">
                            Register here
                        </a>
                    </p>
                </div>


                <p class="text-sm text-center text-gray-400 mt-8">&copy; {{ date('Y') }} Paws & Perch. All rights reserved.</p>
            </div>

        </div>
    </div>
</x-guest-layout>
