<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AdminProductManager extends Component
{
    // use WithFileUploads;

    // public $showCreateModal = false;
    // public $showEditModal = false;

    // public $products;

    // // Product fields
    // public $productId;
    // public $product_name;
    // public $price;
    // public $description;
    // public $image;
    // public $new_image;

    // Category fields
    //public $mainCategory = null;
    //public $subCategory = null;
    public $mainCategories = [];
    public $subCategories = [];

    public function mount()
    {
        //$this->loadProducts();

        $this->mainCategories = Category::whereNull('parent_category_id')->get();

        // ✅ Always load all subcategories
        $this->subCategories = Category::whereNotNull('parent_category_id')->get();
    }

    // public function updatedMainCategory($value)
    // {
    //     // If you still want to update mainCategory value
    //     $this->mainCategory = $value;

    //     // ✅ Always load all subcategories (not filtered)
    //     $this->subCategories = Category::whereNotNull('parent_category_id')->get();
    // }

    // public function openCreateModal()
    // {
    //     $this->resetForm();

    //     $this->showCreateModal = true;
    //     $this->showEditModal = false;
    // }

    // public function openEditModal($id)
    // {
    //     $product = Product::with('category.parent')->findOrFail($id);

    //     $this->productId = $product->id;
    //     $this->product_name = $product->product_name;
    //     $this->price = $product->price;
    //     $this->description = $product->description;
    //     $this->image = $product->image;
    //     $this->new_image = null;

    //     // Set selected category
    //     $this->subCategory = $product->category_id;

    //     // Set main category from parent (if any)
    //     $this->mainCategory = optional($product->category->parent)->id;

    //     // ✅ Load all subcategories regardless of mainCategory
    //     $this->subCategories = Category::whereNotNull('parent_category_id')->get();

    //     $this->showEditModal = true;
    //     $this->showCreateModal = false;
    // }

    // public function store()
    // {
    //     $this->validate([
    //         'product_name' => 'required|string',
    //         'price' => 'required|numeric',
    //         'description' => 'required|string',
    //         'subCategory' => 'required|exists:categories,id',
    //         'new_image' => 'nullable|image|max:2048',
    //     ]);

    //     $path = $this->new_image ? $this->new_image->store('products', 'public') : null;

    //     Product::create([
    //         'product_name' => $this->product_name,
    //         'price' => $this->price,
    //         'description' => $this->description,
    //         'category_id' => $this->subCategory,
    //         'image' => $path,
    //     ]);

    //     session()->flash('message', 'Product created.');

    //     $this->resetForm();
    //     $this->loadProducts();
    //     $this->showCreateModal = false;
    // }

    // public function update()
    // {
    //     $this->validate([
    //         'product_name' => 'required|string',
    //         'price' => 'required|numeric',
    //         'description' => 'required|string',
    //         'subCategory' => 'required|exists:categories,id',
    //         'new_image' => 'nullable|image|max:2048',
    //     ]);

    //     $product = Product::findOrFail($this->productId);

    //     $data = [
    //         'product_name' => $this->product_name,
    //         'price' => $this->price,
    //         'description' => $this->description,
    //         'category_id' => $this->subCategory,
    //     ];

    //     if ($this->new_image) {
    //         $data['image'] = $this->new_image->store('products', 'public');
    //     }

    //     $product->update($data);

    //     session()->flash('message', 'Product updated.');

    //     $this->resetForm();
    //     $this->loadProducts();
    //     $this->showEditModal = false;
    // }

    // public function deleteProduct($id)
    // {
    //     Product::findOrFail($id)->delete();

    //     session()->flash('message', 'Product deleted.');
    //     $this->loadProducts();
    // }

    // private function resetForm()
    // {
    //     $this->productId = null;
    //     $this->product_name = null;
    //     $this->price = null;
    //     $this->description = null;
    //     $this->image = null;
    //     $this->new_image = null;
    //     $this->mainCategory = null;
    //     $this->subCategory = null;

    //     // ✅ Always reload all subcategories when form is reset
    //     $this->subCategories = Category::whereNotNull('parent_category_id')->get();
    // }

    // private function loadProducts()
    // {


    //     $this->products = Product::with(['category', 'orderitems'])->latest()->get();
        

    // }

    public function render()
    {
        return view('livewire.admin-product-manager')->layout('layouts.app');
    }
}
