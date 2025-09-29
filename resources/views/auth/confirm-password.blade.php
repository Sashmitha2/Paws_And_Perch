{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


<x-guest-layout>
    <div class="min-h-screen flex justify-center items-center bg-gray-50 py-12 px-6">
        <div class="max-w-md w-full bg-white shadow-2xl rounded-xl p-10">

            <div class="mb-6 text-center">
                <x-authentication-card-logo />
            </div>

            <div class="mb-6 text-sm text-gray-600 text-center">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <x-validation-errors class="mb-6" />

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6" novalidate>
                @csrf

                <div>
                    <x-label for="password" value="{{ __('Password') }}" class="font-semibold text-gray-700" />
                    <x-input 
                        id="password" 
                        class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        autofocus 
                    />
                </div>

                <div class="flex justify-end">
                    <x-button class="bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-2 px-6 rounded shadow-md transition duration-300 ease-in-out">
                        {{ __('Confirm') }}
                    </x-button>
                </div>
            </form>

            <p class="text-sm text-center text-gray-400 mt-8">&copy; {{ date('Y') }} Paws & Perch. All rights reserved.</p>
        </div>
    </div>
</x-guest-layout>
