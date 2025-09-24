<div class="min-h-screen bg-gradient-to-b from-white via-blue-50 to-white text-gray-900 font-[Inter]">
    <div class="max-w-screen-xl mx-auto px-6 py-20">

         @if (session()->has('success'))
            <div class="mb-6 bg-green-100 text-green-800 px-6 py-4 rounded-lg text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 bg-red-100 text-red-800 px-6 py-4 rounded-lg text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif
        
        {{-- Page Title --}}
        <h1 class="text-4xl md:text-6xl font-extrabold text-center tracking-tight font-[Playfair Display] text-gray-900 drop-shadow-sm">
            Discover Elegant <span class="text-blue-600">Bird Products</span>
        </h1>
        <p class="text-center mt-4 text-lg text-gray-500 max-w-2xl mx-auto">
            Curated essentials your bird will love — crafted for comfort and luxury.
        </p>

        {{-- Subcategories (only Food and Cages) --}}
        <div class="flex flex-wrap justify-center gap-3 mt-12">
            @foreach($subcategories->whereIn('name', ['Food', 'Cages']) as $subcategory)
                <button
                    class="px-5 py-2.5 bg-blue-100 text-blue-800 hover:bg-blue-200 rounded-full transition font-medium focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                    {{ $subcategory->name }}
                </button>
            @endforeach
        </div>

        {{-- Search Input --}}
        <div class="mt-10 mb-16 flex justify-center">
            <input
                type="text"
                wire:model.debounce.500ms="search"
                placeholder="Search bird products..."
                class="w-full md:w-1/2 px-5 py-3 border border-blue-300 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-200 shadow-md placeholder:text-gray-400 text-gray-800"
            />
        </div>

        {{-- Products Grid --}}
        @if($products->isEmpty())
            <p class="text-center text-gray-500 text-lg italic">No bird products found.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach($products as $product)
                    <div class="group bg-white border border-gray-200 rounded-3xl p-5 shadow-md hover:shadow-2xl transition-shadow duration-300 flex flex-col justify-between relative overflow-hidden">

                        {{-- Ribbon (Optional new tag) --}}
                        <div class="absolute top-0 right-0">
                            <span class="bg-yellow-400 text-white text-xs font-bold px-3 py-1 rounded-bl-xl">New</span>
                        </div>

                        {{-- Image --}}
                        @if($product->image)
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->product_name }}" 
                                class="rounded-xl mb-4 w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                            >
                        @else
                            <div class="mb-4 w-full h-48 flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg text-sm italic">
                                No image available
                            </div>
                        @endif

                        {{-- Product Details --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 font-[Playfair Display] group-hover:text-blue-600 transition">
                                {{ $product->product_name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                Category: <span class="font-medium text-gray-700">{{ $product->category->name }}</span>
                            </p>

                            <p class="mt-2 text-sm text-gray-600 line-clamp-3">
                                {{ $product->description }}
                            </p>
                        </div>

                        {{-- Price & Add to Cart --}}
                        <div class="mt-6 flex items-center justify-between">
                            <p class="text-lg font-semibold text-green-600">
                                Rs.{{ number_format($product->price, 2) }}
                            </p>
                            <button
                                class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition font-semibold shadow-sm"
                                wire:click.prevent="addToCart({{ $product->id }})"
                            >
                                Add
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>

    @include('layouts.footer')
</div>
