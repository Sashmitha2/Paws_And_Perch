<div class="p-6 max-w-7xl mx-auto">

    <h2 class="text-3xl font-bold mb-6">Manage Products</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <button
        wire:click="openCreateModal"
        class="mb-6 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
    >Add New Product</button>

    <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead>
            <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-600">
                <th class="px-4 py-3">Product Name</th>
                <th class="px-4 py-3">Pet Type</th>
                <th class="px-4 py-3">Category</th>
                <th class="px-4 py-3">Description</th>
                <th class="px-4 py-3">Price</th>
                <th class="px-4 py-3">Image</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $product->product_name }}</td>
                     <td class="px-4 py-3">{{ optional($product->category->parent)->name ?? '—' }}</td>
                    <td class="px-4 py-3">{{ optional($product->category)->name }}</td>
                    <td class="px-4 py-3">{{$product->description}}</td>
                    <td class="px-4 py-3">Rs.{{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="h-16 w-16 object-cover rounded" />
                        @else
                            <span class="text-gray-400">No image</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 space-x-2">
                        <button
                            wire:click="openEditModal({{ $product->id }})"
                            class="bg-blue-400 hover:bg-yellow-500 text-white px-3 py-1 rounded"
                        >Edit</button>
                        <button
                            wire:click="deleteProduct({{ $product->id }})"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded"
                            onclick="confirm('Are you sure you want to delete this product?') || event.stopImmediatePropagation()"
                        >Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Create/Edit Modal --}}
    @if($showCreateModal || $showEditModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h3 class="text-xl font-semibold mb-4">
                {{ $productId ? 'Edit Product' : 'Add New Product' }}
            </h3>

            <form wire:submit.prevent="{{ $productId ? 'update' : 'store' }}" enctype="multipart/form-data">

               
                
                {{-- Main Category Dropdown --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Animal Category</label>
                    <select wire:model="mainCategory" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Animal Category --</option>
                        @foreach($mainCategories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('mainCategory') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Subcategory Dropdown --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Product Subcategory</label>
                    <select wire:model="subCategory" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Product Category --</option>
                        @foreach($subCategories as $subcat)
                            <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                        @endforeach
                    </select>
                    @error('subCategory') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>



                {{-- Product Name --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" wire:model.defer="product_name" class="w-full border rounded px-3 py-2" />
                    @error('product_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Price --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" step="0.01" wire:model.defer="price" class="w-full border rounded px-3 py-2" />
                    @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea wire:model.defer="description" class="w-full border rounded px-3 py-2"></textarea>
                    @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Image</label>

                    @if ($new_image)
                        <img src="{{ $new_image->temporaryUrl() }}" class="h-24 mb-2 rounded object-cover" />
                    @elseif ($image)
                        <img src="{{ asset('storage/' . $image) }}" class="h-24 mb-2 rounded object-cover" />
                    @else
                        <span class="text-gray-400">No image</span>
                    @endif

                    <input type="file" wire:model="new_image" class="w-full" />
                    @error('new_image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    @if($showCreateModal)
                        <button type="button" wire:click="$set('showCreateModal', false)" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    @elseif($showEditModal)
                        <button type="button" wire:click="$set('showEditModal', false)" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    @endif

                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                        {{ $productId ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
</div>