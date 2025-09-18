<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center px-4 bg-gradient-to-br from-[#FFF3E9] via-[#FFD5BC] to-[#FFF3E9]">
        <div class="max-w-5xl w-full bg-white shadow-2xl rounded-xl overflow-hidden flex flex-col md:flex-row">

            <!-- Left: Welcome Section -->
            <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-orange-100 via-white to-orange-50 md:w-1/2 p-10 text-center shadow-inner">
                <div class="z-10">
                    <h2 class="text-4xl font-extrabold text-orange-600 lobster-font mb-6 drop-shadow-md">
                        🐾 Join Paws & Perch
                    </h2>
                    <p class="text-gray-700 text-base leading-relaxed font-medium">
                        Create your account and enjoy premium pet supplies, exclusive deals,<br>
                        and a purr-fect shopping experience for your furry friends!
                    </p>
                    <div class="mt-6 text-orange-400 text-3xl animate-pulse">🐶🐱🐾</div>
                </div>
            </div>

            <!-- Right: Registration Form -->
            <div class="w-full md:w-1/2 p-10 bg-white">
                <h2 class="text-3xl font-bold text-[#D2691E] text-center mb-8 lobster-font">
                    Customer Registration
                </h2>

                @if(session('success'))
                        <div class="mb-6 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded shadow-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                <x-validation-errors class="mb-6" />

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    

                    @csrf

                    <!-- Name -->
                    <div>
                        <x-label for="name" value="Name" class="text-gray-700 font-semibold" />
                        <x-input 
                            id="name" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-label for="email" value="Email" class="text-gray-700 font-semibold" />
                        <x-input 
                            id="email" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                        />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-label for="password" value="Password" class="text-gray-700 font-semibold" />
                        <x-input 
                            id="password" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password" 
                        />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-label for="password_confirmation" value="Confirm Password" class="text-gray-700 font-semibold" />
                        <x-input 
                            id="password_confirmation" 
                            class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                            type="password" 
                            name="password_confirmation" 
                            required 
                        />
                    </div>

                    <!-- Terms -->
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="text-sm">
                            <label for="terms" class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <span class="ms-2 text-gray-600">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-orange-500 hover:text-orange-700">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-orange-500 hover:text-orange-700">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </span>
                            </label>
                        </div>
                    @endif

                    <!-- Submit -->
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('login') }}" class="text-sm text-orange-500 hover:underline">
                            Already registered?
                        </a>


                        <button 
                            type="submit"
                            class="bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out">
                            {{__('Register')}}
                        </button>
                    </div>
                </form>

                <p class="text-sm text-center text-gray-400 mt-8">
                    &copy; {{ date('Y') }} Paws & Perch. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
