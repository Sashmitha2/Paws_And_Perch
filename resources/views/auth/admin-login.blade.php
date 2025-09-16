<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center bg-[#FFF3E9] py-12 px-6">
        <div class="max-w-4xl w-full bg-white shadow-xl rounded-lg overflow-hidden flex flex-col md:flex-row">
            <!-- Image Section -->
            <div class="hidden md:block md:w-1/2">
                <img src="https://images.unsplash.com/photo-1614213297299-b7d69a06f50a" alt="Pet Supplies" class="h-full w-full object-cover">
            </div>

            <!-- Form Section -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-[#D2691E] text-center mb-6">Admin Login</h2>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <x-label for="email" :value="__('Email')" class="text-[#333]" />
                        <x-input id="email" class="block mt-1 w-full border border-gray-300 rounded-lg" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-label for="password" :value="__('Password')" class="text-[#333]" />
                        <x-input id="password" class="block mt-1 w-full border border-gray-300 rounded-lg" type="password" name="password" required />
                    </div>

                    <!-- Login Button -->
                    <div>
                        <x-button class="w-full justify-center bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-2 px-4 rounded">
                            {{ __('Login') }}
                        </x-button>
                    </div>
                </form>

                <p class="text-sm text-center text-gray-500 mt-6">&copy; {{ date('Y') }} Paws & Perch. All rights reserved.</p>
            </div>
        </div>
    </div>
</x-guest-layout>
