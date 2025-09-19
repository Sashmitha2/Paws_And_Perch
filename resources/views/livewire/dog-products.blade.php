<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Dog Products</h1>

    <!-- Filters -->
    <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <input wire:model.debounce.500ms="search" type="text" placeholder="Search dog products..."
               class="w-full border px-3 py-2 rounded shadow-sm">

        <input wire:model="min_price" type="number" placeholder="Min Price"
               class="w-full border px-3 py-2 rounded shadow-sm">

        <input wire:model="max_price" type="number" placeholder="Max Price"
               class="w-full border px-3 py-2 rounded shadow-sm">
    </div>

    <!-- Product Grid -->
    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ $product->image ?? '/images/default.jpg' }}" alt="{{ $product->product_name }}"
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $product->product_name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 60) }}</p>
                        <p class="text-pink-600 font-bold mt-2">₹{{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-gray-600">No dog products found.</p>
    @endif
</div>
