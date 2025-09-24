<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Checkout</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    @include('partials.navigation')

   <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-16">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-900">Checkout</h2>

    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('checkout.placeOrder') }}" class="flex flex-col lg:flex-row gap-10">
        @csrf

        <!-- Left Side: Form Fields -->
        <div class="flex-1 space-y-6">
            <div>
                <label for="address" class="block mb-2 font-semibold text-gray-700">Shipping Address</label>
                <textarea id="address" name="address" rows="4" required
                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('address') border-red-500 @enderror resize-none">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 font-semibold text-gray-700">Payment Method</label>
                <div class="space-y-3">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="payment_method" value="cash" required
                            class="form-radio text-indigo-600 payment-method" {{ old('payment_method') === 'cash' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-800 hover:text-indigo-600 transition">Cash on Delivery</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" name="payment_method" value="card" required
                            class="form-radio text-indigo-600 payment-method" {{ old('payment_method') === 'card' ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-800 hover:text-indigo-600 transition">Card Payment</span>
                    </label>
                </div>
                @error('payment_method')
                    <p class="text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Card Payment Fields -->
            <div id="card-payment-fields" class="p-5 border border-gray-300 rounded-lg bg-indigo-50 shadow-sm" style="display:none;">
                <h3 class="text-xl font-semibold mb-5 text-gray-900 border-b border-indigo-300 pb-2">Card Details</h3>

                <div class="mb-5">
                    <label for="card_number" class="block mb-2 font-semibold text-gray-700">Card Number</label>
                    <input type="text" name="card_number" id="card_number" maxlength="19" placeholder="1234 5678 9012 3456"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('card_number') border-red-500 @enderror"
                        value="{{ old('card_number') }}">
                    @error('card_number')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-5">
                    <div class="flex-1">
                        <label for="expiry_date" class="block mb-2 font-semibold text-gray-700">Expiry Date</label>
                        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" maxlength="5"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('expiry_date') border-red-500 @enderror"
                            value="{{ old('expiry_date') }}">
                        @error('expiry_date')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex-1">
                        <label for="cvv" class="block mb-2 font-semibold text-gray-700">CVV</label>
                        <input type="password" name="cvv" id="cvv" maxlength="4" placeholder="123"
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('cvv') border-red-500 @enderror"
                            value="{{ old('cvv') }}">
                        @error('cvv')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-center lg:justify-start">
                <button type="submit"
                    class="px-10 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-700 shadow-lg transition">
                    Place Order
                </button>
            </div>
        </div>

        <!-- Right Side: Order Summary -->
        <div class="w-full lg:w-1/3 bg-indigo-50 rounded-xl p-6 shadow-xl sticky top-24 h-max">
            <h3 class="text-2xl font-bold mb-6 text-indigo-900 border-b border-indigo-400 pb-3">Order Summary</h3>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-indigo-300 rounded-lg">
                    <thead class="bg-indigo-100 rounded-t-lg">
                        <tr>
                            <th class="py-3 px-4 text-left text-indigo-900 font-semibold uppercase tracking-wide rounded-tl-lg">Product</th>
                            <th class="py-3 px-4 text-center text-indigo-900 font-semibold uppercase tracking-wide">Price</th>
                            <th class="py-3 px-4 text-center text-indigo-900 font-semibold uppercase tracking-wide">Qty</th>
                            <th class="py-3 px-4 text-center text-indigo-900 font-semibold uppercase tracking-wide rounded-tr-lg">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr class="border-b border-indigo-200 hover:bg-indigo-100 transition">
                                <td class="py-3 px-4 flex items-center space-x-3">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->product_name }}" class="w-12 h-12 object-cover rounded-md shadow-sm">
                                    @else
                                        <div class="w-12 h-12 bg-indigo-200 flex items-center justify-center rounded-md text-indigo-400 text-xs italic">No Image</div>
                                    @endif
                                    <span class="font-medium text-indigo-900">{{ $item->product->product_name }}</span>
                                </td>
                                <td class="py-3 px-4 text-center font-semibold text-indigo-800">
                                    Rs.{{ number_format($item->product->price, 2) }}
                                </td>
                                <td class="py-3 px-4 text-center font-semibold text-indigo-800">
                                    {{ $item->quantity }}
                                </td>
                                <td class="py-3 px-4 text-center font-bold text-green-600">
                                    Rs.{{ number_format($item->product->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-between items-center border-t border-indigo-300 pt-4">
                <span class="text-xl font-bold text-indigo-900">Total:</span>
                <span class="text-3xl font-extrabold text-green-600">Rs.{{ number_format($totalPrice, 2) }}</span>
            </div>
        </div>
    </form>
</div>


    <script>
        function toggleCardPaymentFields() {
            const paymentMethods = document.querySelectorAll('.payment-method');
            const cardFields = document.getElementById('card-payment-fields');
            let selected = false;

            paymentMethods.forEach(radio => {
                if (radio.checked && radio.value === 'card') {
                    selected = true;
                }
            });

            cardFields.style.display = selected ? 'block' : 'none';
        }

        // Run on page load (to handle old input or validation errors)
        window.addEventListener('DOMContentLoaded', () => {
            toggleCardPaymentFields();

            document.querySelectorAll('.payment-method').forEach(el => {
                el.addEventListener('change', toggleCardPaymentFields);
            });
        });
    </script>

</body>
</html>
