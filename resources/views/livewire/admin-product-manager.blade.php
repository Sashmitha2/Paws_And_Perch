




{{-- <div class="p-6 max-w-7xl mx-auto">

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
   {{-- @if($showCreateModal || $showEditModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h3 class="text-xl font-semibold mb-4">
                {{ $productId ? 'Edit Product' : 'Add New Product' }}
            </h3>

            <form wire:submit.prevent="{{ $productId ? 'update' : 'store' }}" enctype="multipart/form-data">

               
                
                {{-- Main Category Dropdown --}}
                {{--<div class="mb-4">
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
                {{--<div class="mb-4">
                    <label class="block font-semibold mb-1">Product Subcategory</label>
                    <select wire:model="subCategory" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Product Category --</option>
                        @foreach($subCategories as $subcat)
                            <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                        @endforeach
                    </select>
                    @error('subCategory') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div> --}}



                {{-- Product Name --}}
                {{--<div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" wire:model.defer="product_name" class="w-full border rounded px-3 py-2" />
                    @error('product_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Price --}}
                {{--<div class="mb-4">
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" step="0.01" wire:model.defer="price" class="w-full border rounded px-3 py-2" />
                    @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Description --}}
                {{--<div class="mb-4">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea wire:model.defer="description" class="w-full border rounded px-3 py-2"></textarea>
                    @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Image --}}
                {{--<div class="mb-4">
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
</div> --}}


<div class="p-6 max-w-7xl mx-auto" x-data="productManager(window.mainCategories, window.subCategories)" x-init="fetchProducts()">

    <h2 class="text-3xl font-bold mb-6">Manage Products (via API)</h2>

    <template x-if="message">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" x-text="message"></div>
    </template>

    <button
        @click="openCreateModal()"
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
            <template x-for="product in products" :key="product.id">
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3" x-text="product.product_name"></td>
                    <td class="px-4 py-3" x-text="product.category && product.category.parent ? product.category.parent.name : '—'"></td>
                    <td class="px-4 py-3" x-text="product.category ? product.category.name : ''"></td>
                    <td class="px-4 py-3" x-text="product.description"></td>
                    <td class="px-4 py-3" x-text="`Rs.${parseFloat(product.price).toFixed(2)}`"></td>
                    <td class="px-4 py-3">
                        <template x-if="product.image">
                            <img :src="`/storage/${product.image}`" :alt="product.product_name" class="h-16 w-16 object-cover rounded" />
                        </template>
                        <template x-if="!product.image">
                            <span class="text-gray-400">No image</span>
                        </template>
                    </td>
                    <td class="px-4 py-3 space-x-2">
                        <button @click="openEditModal(product)" class="bg-blue-400 hover:bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                        <button @click="deleteProduct(product.id)" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Delete</button>
                    </td>
                </tr>
            </template>
            <template x-if="products.length === 0">
                <tr>
                    <td colspan="7" class="text-center p-4 text-gray-500">No products found.</td>
                </tr>
            </template>
        </tbody>
    </table>

    <!-- Modal for Create/Edit -->
    <div x-show="showModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h3 class="text-xl font-semibold mb-4" x-text="modalTitle"></h3>

            <form @submit.prevent="submitForm()" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Main Category</label>
                    <select x-model="form.mainCategory" @change="onMainCategoryChange()" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Animal Category --</option>
                        <template x-for="cat in mainCategories" :key="cat.id">
                            <option :value="cat.id" x-text="cat.name"></option>
                        </template>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Product Subcategory</label>
                    <select x-model="form.category_id" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Product Category --</option>
                        <template x-for="sub in subCategories" :key="sub.id">
                            <option :value="sub.id" x-text="sub.name"></option>
                        </template>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Name</label>
                    <input type="text" x-model="form.product_name" class="w-full border rounded px-3 py-2" />
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Price</label>
                    <input type="number" step="0.01" x-model="form.price" class="w-full border rounded px-3 py-2" />
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Description</label>
                    <textarea x-model="form.description" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Product Image</label>
                    <template x-if="form.newImagePreview">
                        <img :src="form.newImagePreview" class="h-24 mb-2 rounded object-cover" />
                    </template>
                    <input type="file" @change="onFileChange($event)" class="w-full" />
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="closeModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700" x-text="modalButtonText"></button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    window.apiToken = @json(session('api_token') ?? null);
</script>

<script>

    
    window.mainCategories = @json($mainCategories);
    window.subCategories = @json($subCategories);

   function productManager(mainCategories, subCategories) {
    return {
        products: [],
        mainCategories: mainCategories,
        subCategories: subCategories,
        showModal: false,
        isEdit: false,
        modalTitle: '',
        modalButtonText: '',
        message: '',
        form: {
            id: null,
            product_name: '',
            price: '',
            description: '',
            category_id: '',
            mainCategory: '',
            newImageFile: null,
            newImagePreview: null,
        },

        async fetchProducts() {
            await fetch('/sanctum/csrf-cookie', { credentials: 'include' });
            const res = await fetch('/api/products', {
                credentials: 'include',
                headers: { 'Accept': 'application/json', 
                            'Authorization': `Bearer ${window.apiToken}`,
            },
            
            });
            if (res.ok) {
                const json = await res.json();
                console.log('API response:', json);
                this.products = json.data ?? json;
            } else {
                console.error('Error fetching products', res.status);
            }
        },

        openCreateModal() {
            this.resetForm();
            this.isEdit = false;
            this.modalTitle = 'Add New Product';
            this.modalButtonText = 'Create';
            this.showModal = true;
        },

        openEditModal(product) {
            this.resetForm();
            this.isEdit = true;
            this.modalTitle = 'Edit Product';
            this.modalButtonText = 'Update';

            this.form.id = product.id;
            this.form.product_name = product.product_name;
            this.form.price = product.price;
            this.form.description = product.description;
            this.form.category_id = product.category_id;
            this.form.mainCategory = product.category && product.category.parent ? product.category.parent.id : '';
            this.showModal = true;
        },

        onFileChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            this.form.newImageFile = file;
            this.form.newImagePreview = URL.createObjectURL(file);
        },

        onMainCategoryChange() {
            // Optional: filter subCategories if needed
            // Currently subCategories are unfiltered per your request
        },

    async submitForm() {
    const formData = new FormData();
    formData.append('product_name', this.form.product_name);
    formData.append('price', this.form.price);
    formData.append('description', this.form.description);
    formData.append('category_id', this.form.category_id);
    if (this.form.newImageFile) {
        formData.append('image', this.form.newImageFile);
    }

    // Get CSRF cookie for Sanctum
    await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

    let url = '/api/products';
    let method = 'POST';

    if (this.isEdit) {
        url = `/api/products/${this.form.id}`;
        formData.append('_method', 'PUT');  // Use PUT via POST with _method
    }

    const res = await fetch(url, {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Authorization': `Bearer ${window.apiToken}`,
            'Accept': 'application/json'
        },
        body: formData,
    });

    if (res.ok) {
        const data = await res.json();
        this.message = data.message || (this.isEdit ? 'Product updated' : 'Product created');
        await this.fetchProducts();
        this.closeModal();
    } else {
        // Try to parse JSON error, fallback to text in case of failure
        let errorData;
        try {
            errorData = await res.json();
        } catch {
            errorData = await res.text();
        }
        console.error('Error submitting form', errorData);
        this.message = 'An error occurred';
    }
},



        async deleteProduct(id) {
            if (!confirm('Are you sure you want to delete this product?')) return;

            await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

            const res = await fetch(`/api/products/${id}`, {
                method: 'DELETE',
                credentials: 'include',
                headers: { 'Accept': 'application/json',
                            'Authorization': `Bearer ${window.apiToken}`
                 },
            });

            if (res.ok) {
                const data = await res.json();
                this.message = data.message || 'Product deleted';
                await this.fetchProducts();
            } else {
                console.error('Error deleting product', res.status);
                this.message = 'An error occurred when deleting';
            }
        },

        resetForm() {
            this.form = {
                id: null,
                product_name: '',
                price: '',
                description: '',
                category_id: '',
                mainCategory: '',
                newImageFile: null,
                newImagePreview: null,
            };
        },

        closeModal() {
            this.showModal = false;
        },
    }
}

</script>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
