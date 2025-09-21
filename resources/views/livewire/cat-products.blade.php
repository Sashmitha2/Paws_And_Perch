<div class="min-h-screen bg-gradient-to-br from-[#F0F4F8] to-[#D9E2EC] py-16 px-6 flex justify-center font-[Inter]">
    <div class="max-w-7xl w-full bg-white shadow-xl rounded-lg p-10">

        {{-- Page Title --}}
        <h2 class="text-5xl md:text-6xl font-semibold text-blue-900 pb-5 mb-14 text-center tracking-tight font-[Playfair Display]">
            Discover Elegant <span class="text-blue-500">Cat Products</span>
        </h2>

        {{-- Subcategories --}}
        <div class="flex flex-wrap justify-center gap-4 mb-10">
            @foreach($subcategories as $subcategory)
                <button
                    class="px-4 py-2 bg-blue-500 text-white rounded-md font-medium hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                    {{ $subcategory->name }}
                </button>
            @endforeach
        </div>

        {{-- Search Input --}}
        <div class="mb-12 flex justify-center">
            <input
                type="text"
                wire:model.debounce.500ms="search"
                placeholder="Search cat products..."
                class="w-full md:w-1/2 px-4 py-3 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-sm placeholder:text-blue-400 font-[Inter]"
            />
        </div>

        {{-- Products Grid --}}
        @if($products->isEmpty())
            <p class="text-blue-700 italic text-lg text-center">No cat products found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col hover:shadow-xl transition duration-300">
                        <div class="flex-grow">
                            <h3 class="text-xl font-semibold text-blue-800 mb-2 font-[Playfair Display]">
                                {{ $product->product_name }}
                            </h3>
                            <p class="text-sm text-blue-600 mb-3 font-medium">
                                Category: <span class="font-normal">{{ $product->category->name }}</span>
                            </p>
                            <p class="text-lg font-bold text-green-600 font-[Inter]">
                                ${{ number_format($product->price, 2) }}
                            </p>
                        </div>
                        <button
                            class="mt-6 bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition font-semibold font-[Inter]"
                            wire:click.prevent="addToCart({{ $product->id }})" class="btn"
                        >
                            Add to Cart
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
