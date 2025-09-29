<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;

class BirdProducts extends Component
{
    public $parentCategoryId;
    public $subcategories;
    public $products;
    public $search = '';

    public $cart;  // store user's cart

    public function mount($parentCategoryId)
    {
        $this->parentCategoryId = $parentCategoryId;

        // Load ONLY Food and Cages subcategories for this parent category
        $this->subcategories = Category::where('parent_category_id', $this->parentCategoryId)
            ->whereIn('name', ['Food', 'Cages'])
            ->get();

        // Get IDs of these subcategories
        $subCatIds = $this->subcategories->pluck('id')->toArray();

        // Load products under these subcategories
        $this->products = Product::whereIn('category_id', $subCatIds)->get();

        // Initialize user's cart if logged in
        if (Auth::guard('customer')->check()) {
            $this->cart = Cart::firstOrCreate(
                ['user_id' => Auth::guard('customer')->id()],
                ['status' => 'active']
            );
        }
    }

    public function updatedSearch()
    {
        // Get Food and Cages subcategory IDs again (for search)
        $subCatIds = Category::where('parent_category_id', $this->parentCategoryId)
            ->whereIn('name', ['Food', 'Cages'])
            ->pluck('id')
            ->toArray();

        $this->products = Product::whereIn('category_id', $subCatIds)
            ->where('product_name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function addToCart($productId)
    {
        if (!Auth::guard('customer')->check()) {
            session()->flash('error', 'Please login to add items to cart.');
            return;
        }

        // Ensure cart is loaded
        if (!$this->cart) {
            $this->cart = Cart::firstOrCreate(
                ['user_id' => Auth::guard('customer')->id()],
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
                'user_id' => Auth::guard('customer')->id(),
                'cart_id' => $this->cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.bird-products')->layout('layouts.app');
    }
}
