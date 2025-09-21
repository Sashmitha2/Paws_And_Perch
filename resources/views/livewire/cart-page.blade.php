{{-- <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-6">Your Cart</h2>

    @if($cartItems->isEmpty())
        <p class="text-gray-600 italic">Your cart is empty.</p>
    @else
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b py-2">Product</th>
                    <th class="border-b py-2">Price</th>
                    <th class="border-b py-2">Quantity</th>
                    <th class="border-b py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td class="py-2">{{ $item->product->product_name }}</td>
                        <td class="py-2 text-center">${{ number_format($item->product->price, 2) }}</td>
                        <td class="py-2 text-center">{{ $item->quantity }}</td>
                        <td class="py-2 text-center">${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td class="py-2 text-center">
                            <!-- Remove button -->
                            <button 
                                wire:click="removeFromCart({{ $item->id }})" 
                                class="text-red-600 hover:underline"
                                onclick="return confirm('Are you sure you want to remove this item?')"
                            >
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach

                

            </tbody>
        </table>

        <div class="mt-6 text-right font-bold text-lg">
            Total: ${{ number_format($cartItems->sum(fn($i) => $i->product->price * $i->quantity), 2) }}
        </div>
    @endif
</div> --}}


<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <h2 class="text-2xl font-semibold mb-6">Your Cart</h2>

    @if($cartItems->isEmpty())
        <p class="text-gray-600 italic">Your cart is empty.</p>
    @else
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b py-2">Product</th>
                    <th class="border-b py-2 text-center">Price</th>
                    <th class="border-b py-2 text-center">Quantity</th>
                    <th class="border-b py-2 text-center">Total</th>
                    <th class="border-b py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td class="py-2">{{ $item->product->product_name }}</td>
                        <td class="py-2 text-center">${{ number_format($item->product->price, 2) }}</td>

                        <!-- Quantity controls -->
                        <td class="py-2 text-center">
                            <button 
                                wire:click="decreaseQuantity({{ $item->id }})"
                                class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                                @if($item->quantity <= 1) disabled @endif
                            >−</button>

                            <span class="px-3">{{ $item->quantity }}</span>

                            <button 
                                wire:click="increaseQuantity({{ $item->id }})"
                                class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                            >+</button>
                        </td>

                        <td class="py-2 text-center">
                            ${{ number_format($item->product->price * $item->quantity, 2) }}
                        </td>

                        <!-- Remove button -->
                        <td class="py-2 text-center">
                            <button 
                                wire:click="removeFromCart({{ $item->id }})"
                                class="text-red-600 hover:underline"
                                onclick="return confirm('Are you sure you want to remove this item?')"
                            >
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="mt-6 text-right font-bold text-lg">
            Total: ${{ number_format($this->totalPrice, 2) }}
        </div>
    @endif
</div>
