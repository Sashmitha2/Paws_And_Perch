{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center py-12 px-6 bg-gray-50">
        <div class="max-w-md w-full bg-white/80 backdrop-blur-lg shadow-2xl rounded-xl p-10">

            <h2 class="text-3xl font-extrabold text-[#D2691E] lobster-font mb-8 text-center drop-shadow-sm">
                Reset Password
            </h2>

            <x-validation-errors class="mb-6" />

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        autofocus 
                        autocomplete="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                        value="{{ old('email', $request->email) }}"
                    />
                </div>

                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                    />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                    <input 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        type="password" 
                        required 
                        autocomplete="new-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                    />
                </div>

                <div>
                    <button 
                        type="submit"
                        class="w-full bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-3 rounded shadow-md transition duration-300 ease-in-out"
                    >
                        Reset Password
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
