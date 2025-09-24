<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;

class DogProducts extends Component
{
    public $parentCategoryId;
    public $subcategories;
    public $products;
    public $search = '';

    public $cart;  // store user's cart

    public function mount($parentCategoryId)
    {
        $this->parentCategoryId = $parentCategoryId;

        // Load subcategories for this parent category (dog categories)
        $this->subcategories = Category::where('parent_category_id', $this->parentCategoryId)->get();

        // Get IDs of subcategories
        $subCatIds = $this->subcategories->pluck('id')->toArray();

        // Load products under these subcategories
        $this->products = Product::whereIn('category_id', $subCatIds)->get();

        // Initialize user's cart if logged in
        if (Auth::check()) {
            $this->cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['status' => 'active']
            );
        }
    }

    public function updatedSearch()
    {
        $subCatIds = Category::where('parent_category_id', $this->parentCategoryId)->pluck('id')->toArray();

        $this->products = Product::whereIn('category_id', $subCatIds)
            ->where('product_name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to add items to cart.');
            return;
        }

        // Ensure cart is loaded
        if (!$this->cart) {
            $this->cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['status' => 'active']
            );
        }

        $cartItem = CartItem::where('cart_id', $this->cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'cart_id' => $this->cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.dog-products')->layout('layouts.app');
    }
}
