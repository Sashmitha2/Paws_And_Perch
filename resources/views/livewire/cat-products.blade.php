{{-- <div>
    <h2>Subcategories</h2>
    <ul>
        @foreach($subcategories as $subcategory)
            <li>{{ $subcategory->name }}</li>
        @endforeach
    </ul>

    <input type="text" wire:model.debounce.500ms="search" placeholder="Search products..." />

    <h2>Products</h2>
    <ul>
        @forelse($products as $product)
            <li>
                <strong>{{ $product->product_name }}</strong> - {{ $product->category->name }} - ${{ number_format($product->price, 2) }}
            </li>
        @empty
            <li>No products found.</li>
        @endforelse
    </ul>
</div> --}}


<div class="max-w-7xl mx-auto p-8 rounded-2xl shadow-xl bg-gradient-to-br from-orange-50 via-orange-100 to-orange-200">

    {{-- Subcategories --}}
    <h2 class="text-4xl font-extrabold mb-8 text-[#D2691E] border-b-4 border-orange-300 pb-3 lobster-font drop-shadow-sm">
        Subcategories
    </h2>

    <div class="flex flex-wrap gap-5 mb-10">
        @foreach($subcategories as $subcategory)
            <button
                class="px-6 py-3 bg-[#F4A261] text-white rounded-xl font-semibold shadow-md hover:bg-[#E76F51] transition duration-300"
            >
                {{ $subcategory->name }}
            </button>
        @endforeach
    </div>

    {{-- Search Input --}}
    <div class="mb-10">
        <input
            type="text"
            wire:model.debounce.500ms="search"
            placeholder="Search products..."
            class="w-full md:w-1/2 px-5 py-4 border-2 border-[#E76F51] rounded-xl focus:outline-none focus:ring-4 focus:ring-[#F4A261]/50 shadow-md placeholder:text-[#CC7445] font-medium"
        />
    </div>

    {{-- Products --}}
    <h2 class="text-4xl font-extrabold mb-8 text-[#D2691E] border-b-4 border-orange-300 pb-3 lobster-font drop-shadow-sm">
        Products
    </h2>

    @if($products->isEmpty())
        <p class="text-gray-700 italic text-lg">No products found.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div
                    class="bg-white rounded-2xl shadow-lg p-6 flex flex-col hover:shadow-2xl transition"
                >
                    <div class="flex-grow">
                        <h3 class="text-2xl font-bold text-[#D2691E] lobster-font mb-3">
                            {{ $product->product_name }}
                        </h3>
                        <p class="text-sm text-[#8B5E3C] mb-4">
                            Category: <span class="font-semibold">{{ $product->category->name }}</span>
                        </p>
                        <p class="text-xl font-extrabold text-[#E76F51]">
                            ${{ number_format($product->price, 2) }}
                        </p>
                    </div>
                    <button
                        class="mt-6 bg-[#D2691E] text-white py-3 rounded-xl shadow-md hover:bg-[#B25411] transition font-semibold lobster-font"
                        wire:click.prevent="addToCart({{ $product->id }})"
                    >
                        Add to Cart
                    </button>
                </div>
            @endforeach
        </div>
    @endif

</div>
