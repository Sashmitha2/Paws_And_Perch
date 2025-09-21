<div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-16">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-900">Your Cart</h2>

    @if($cartItems->isEmpty())
        <p class="text-center text-gray-500 italic text-lg">Your cart is empty.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left text-gray-700 font-semibold uppercase tracking-wide">Product</th>
                        <th class="py-3 px-6 text-center text-gray-700 font-semibold uppercase tracking-wide">Price</th>
                        <th class="py-3 px-6 text-center text-gray-700 font-semibold uppercase tracking-wide">Quantity</th>
                        <th class="py-3 px-6 text-center text-gray-700 font-semibold uppercase tracking-wide">Total</th>
                        <th class="py-3 px-6 text-center text-gray-700 font-semibold uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr class="border-b hover:bg-yellow-50 transition">
                            <td class="py-4 px-6 flex items-center space-x-4">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->product_name }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded-lg text-gray-400 text-sm italic">No Image</div>
                                @endif
                                <span class="font-semibold text-gray-900">{{ $item->product->product_name }}</span>
                            </td>
                            <td class="py-4 px-6 text-center text-gray-700 font-medium">
                                Rs.{{ number_format($item->product->price, 2) }}
                            </td>

                            <!-- Quantity controls -->
                            <td class="py-4 px-6 text-center">
                                <button 
                                    wire:click="decreaseQuantity({{ $item->id }})"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 rounded hover:bg-gray-300 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if($item->quantity <= 1) disabled @endif
                                >−</button>

                                <span class="mx-3 font-medium text-gray-900">{{ $item->quantity }}</span>

                                <button 
                                    wire:click="increaseQuantity({{ $item->id }})"
                                    class="inline-flex items-center justify-center w-8 h-8 bg-gray-200 rounded hover:bg-gray-300 transition"
                                >+</button>
                            </td>

                            <td class="py-4 px-6 text-center font-semibold text-green-600">
                                Rs.{{ number_format($item->product->price * $item->quantity, 2) }}
                            </td>

                            <!-- Remove button -->
                            <td class="py-4 px-6 text-center">
                                <button 
                                    wire:click="removeFromCart({{ $item->id }})"
                                    class="text-red-600 hover:text-red-700 font-semibold transition"
                                    onclick="return confirm('Are you sure you want to remove this item?')"
                                >
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="mt-8 flex justify-end items-center space-x-6">
            <span class="text-xl font-bold text-gray-900">Total:</span>
            <span class="text-2xl font-extrabold text-green-600">Rs.{{ number_format($this->totalPrice, 2) }}</span>
        </div>
    @endif
</div>
