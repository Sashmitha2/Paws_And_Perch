<div class="max-w-7xl mx-auto p-8 font-sans text-gray-900" x-data="productManager(window.mainCategories, window.subCategories)" x-init="fetchProducts()">

    <h2 class="text-4xl font-extrabold mb-12 tracking-tight">Manage Products</h2>

    <template x-if="message">
        <div
            class="mb-8 rounded-md bg-green-50 border border-green-200 text-green-800 px-6 py-4 shadow-sm transition-opacity duration-300"
            x-text="message"
            x-show="message"
            x-transition
        ></div>
    </template>

    <button
        @click="openCreateModal()"
        class="mb-10 inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-white font-semibold tracking-wide shadow-md hover:bg-blue-700 hover:shadow-lg transition"
    >
        + Add New Product
    </button>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
        <table class="w-full border-collapse table-auto text-sm text-left text-gray-700">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 font-semibold tracking-wide">Product Name</th>
                    <th class="px-6 py-4 font-semibold tracking-wide">Pet Type</th>
                    <th class="px-6 py-4 font-semibold tracking-wide">Category</th>
                    <th class="px-6 py-4 font-semibold tracking-wide">Description</th>
                    <th class="px-6 py-4 font-semibold tracking-wide">Price</th>
                    <th class="px-6 py-4 font-semibold tracking-wide">Image</th>
                    <th class="px-6 py-4 font-semibold tracking-wide">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <template x-for="product in products" :key="product.id">
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900" x-text="product.product_name"></td>
                        <td class="px-6 py-4 text-gray-600" x-text="product.category && product.category.parent ? product.category.parent.name : '—'"></td>
                        <td class="px-6 py-4 text-gray-600" x-text="product.category ? product.category.name : ''"></td>
                        <td class="px-6 py-4 text-gray-700 max-w-xs truncate" x-text="product.description"></td>
                        <td class="px-6 py-4 font-semibold text-gray-900" x-text="`Rs.${parseFloat(product.price).toFixed(2)}`"></td>
                        <td class="px-6 py-4">
                            <template x-if="product.image">
                                <img
                                    :src="`/storage/${product.image}`"
                                    :alt="product.product_name"
                                    class="h-16 w-16 rounded-lg object-cover shadow-sm"
                                />
                            </template>
                            <template x-if="!product.image">
                                <span class="text-gray-400 italic text-sm">No image</span>
                            </template>
                        </td>
                        <td class="px-6 py-4 flex space-x-3">
                            <button
                                @click="openEditModal(product)"
                                class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-medium shadow-sm hover:bg-indigo-700 transition"
                                aria-label="Edit product"
                            >
                                Edit
                            </button>
                            <button
                                @click="deleteProduct(product.id)"
                                class="inline-flex items-center rounded-md bg-red-600 px-4 py-2 text-white text-sm font-medium shadow-sm hover:bg-red-700 transition"
                                aria-label="Delete product"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </template>
                <template x-if="products.length === 0">
                    <tr>
                        <td colspan="7" class="text-center p-6 text-gray-400 italic">No products found.</td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Modal for Create/Edit -->
    <div
        x-show="showModal"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 px-4"
        @keydown.window.escape="closeModal()"
    >
        <div
            @click.outside="closeModal()"
            class="bg-white rounded-xl shadow-xl max-w-lg w-full p-8 relative transform transition-all scale-100 opacity-100"
            style="will-change: transform, opacity;"
        >
            <h3 class="text-2xl font-bold mb-6 text-gray-900" x-text="modalTitle"></h3>

            <form @submit.prevent="submitForm()" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label for="mainCategory" class="block text-sm font-semibold text-gray-700 mb-1">Main Category</label>
                    <select
                        id="mainCategory"
                        x-model="form.mainCategory"
                        @change="onMainCategoryChange()"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >
                        <option value="">-- Select Animal Category --</option>
                        <template x-for="cat in mainCategories" :key="cat.id">
                            <option :value="cat.id" x-text="cat.name"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label for="subCategory" class="block text-sm font-semibold text-gray-700 mb-1">Product Subcategory</label>
                    <select
                        id="subCategory"
                        x-model="form.category_id"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    >
                        <option value="">-- Select Product Category --</option>
                        <template x-for="sub in subCategories" :key="sub.id">
                            <option :value="sub.id" x-text="sub.name"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label for="productName" class="block text-sm font-semibold text-gray-700 mb-1">Product Name</label>
                    <input
                        id="productName"
                        type="text"
                        x-model="form.product_name"
                        placeholder="Enter product name"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    />
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Price</label>
                    <input
                        id="price"
                        type="number"
                        step="0.01"
                        x-model="form.price"
                        placeholder="0.00"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                    />
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                    <textarea
                        id="description"
                        x-model="form.description"
                        rows="4"
                        placeholder="Enter description"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                    ></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                    <template x-if="form.newImagePreview">
                        <img :src="form.newImagePreview" alt="Preview" class="mb-4 w-32 h-32 object-cover rounded-lg shadow-sm" />
                    </template>
                    <input
                        type="file"
                        @change="onFileChange($event)"
                        class="w-full text-gray-700"
                        accept="image/*"
                    />
                </div>

                <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                    <button
                        type="button"
                        @click="closeModal()"
                        class="px-6 py-2 rounded-md bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-2 rounded-md bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-md transition"
                        x-text="modalButtonText"
                    ></button>
                </div>
            </form>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    window.apiToken = @json(session('api_token') ?? null);
    window.mainCategories = @json($mainCategories);
    window.subCategories = @json($subCategories);

    function productManager(mainCategories, subCategories) {
        return {
            products: [],
            mainCategories,
            subCategories,
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
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${window.apiToken}`,
                    },
                });
                if (res.ok) {
                    const json = await res.json();
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
                // Optional: filter subCategories if needed (left empty per your request)
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

                await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

                let url = '/api/products';
                if (this.isEdit) {
                    url = `/api/products/${this.form.id}`;
                    formData.append('_method', 'PUT');
                }

                const res = await fetch(url, {
                    method: 'POST',
                    credentials: 'include',
                    headers: {
                        'Authorization': `Bearer ${window.apiToken}`,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (res.ok) {
                    const data = await res.json();
                    this.message = data.message || (this.isEdit ? 'Product updated' : 'Product created');
                    await this.fetchProducts();
                    this.closeModal();
                } else {
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
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${window.apiToken}`,
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
        };
    }
</script>
