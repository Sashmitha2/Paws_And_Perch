
{{--resources/views/auth/verify-otp.blade.php --}}
 <x-guest-layout>
    <div 
        class="min-h-screen flex justify-center items-center bg-cover bg-center bg-no-repeat py-12 px-6"
        style="background-image: url('{{ asset('images/bac.jpg') }}');"
    >
        <div class="max-w-md w-full bg-white bg-opacity-90 backdrop-blur-md shadow-2xl rounded-xl p-10">

            <h2 class="text-4xl font-extrabold text-[#D2691E] lobster-font mb-8 text-center drop-shadow-sm">
                Verify Your OTP
            </h2>

            @if(session('error'))
                <div 
                    role="alert" 
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center shadow-sm"
                >
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('otp.check') }}" class="space-y-6" aria-label="OTP Verification Form">
                @csrf

                <div>
                    <label for="otp" class="block text-gray-700 font-semibold mb-2">Enter OTP</label>
                    <input 
                        type="text" 
                        name="otp" 
                        id="otp" 
                        maxlength="6"
                        autocomplete="one-time-code"
                        inputmode="numeric"
                        pattern="\d{6}"
                        required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:border-orange-400 focus:ring focus:ring-orange-200 focus:ring-opacity-50"
                        placeholder="6-digit code"
                    />
                    @error('otp')
                        <p class="text-red-600 mt-2 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full bg-[#FF9472] hover:bg-[#e67e5f] text-white font-bold py-3 rounded shadow-md transition duration-300 ease-in-out"
                >
                    Verify OTP
                </button>
            </form>

            <p class="text-sm text-center text-gray-400 mt-4">&copy; {{ date('Y') }} Paws & Perch. All rights reserved.</p>
        </div>
    </div>
</x-guest-layout> 