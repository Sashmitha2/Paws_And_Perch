<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center bg-gradient-to-tr from-orange-100 via-yellow-50 to-white py-12 px-6">
        <div class="max-w-4xl w-full bg-white shadow-2xl rounded-2xl overflow-hidden flex flex-col md:flex-row">
            <!-- Image Section -->
            <div class="hidden md:block md:w-1/2">
                <img 
                    src="{{asset('images/admin.jpg')}}" 
                    alt="Pet Supplies" 
                    class="h-full w-full object-cover transition-transform duration-500 hover:scale-105"
                >
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
                <h2 class="text-4xl font-extrabold text-[#D2691E] text-center lobster-font mb-8 drop-shadow-sm">
                    Admin Login
                </h2>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
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

                    <!-- Login Button -->
                    <div>
                        {{-- <x-button 
                            class="w-full bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-3 rounded-lg shadow-lg transition duration-300 ease-in-out"
                            type="submit"
                        >
                            {{ __('Login') }}
                        </x-button> --}}
                        
                        <button 
                            type="submit"
                            class="bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out">
                            {{__('Login')}}
                        </button>

                    </div>
                </form>

                <p class="text-sm text-center text-gray-400 mt-8">&copy; {{ date('Y') }} Paws & Perch. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
