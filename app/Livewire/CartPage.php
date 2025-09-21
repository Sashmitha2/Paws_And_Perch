<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class CartPage extends Component
{
    public $cart;
    public $cartItems; // Add this property to hold cart items
    public $cartItemCount = 0;

    public function mount()
    {
        if (Auth::check()) {
            $this->cart = Cart::firstOrCreate([
                'user_id' => Auth::id(),
                'status' => 'active',
            ]);
            $this->loadCartItems();
            $this->updateCartCount();
        }
    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please login to add items to cart.');
            return;
        }

        $cartItem = CartItem::where('cart_id', $this->cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $this->cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        $this->loadCartItems();
        $this->updateCartCount();

       // $this->emit('cartUpdated');

       $this->dispatch('cartUpdated');

        session()->flash('success', 'Product added to cart!');
    }

    public function removeFromCart($cartItemId)
    {
        $item = CartItem::find($cartItemId);
        if ($item) {
            $item->delete();
        }
        $this->loadCartItems();
        $this->updateCartCount();

        //$this->emit('cartUpdated');
    }

    public function updateCartCount()
    {
        $this->cartItemCount = CartItem::where('cart_id', $this->cart->id)->sum('quantity');
    }

    // New method to load cart items with product relationship
    public function loadCartItems()
    {
        $this->cartItems = CartItem::with('product')
            ->where('cart_id', $this->cart->id)
            ->get();
    }

    public function increaseQuantity($cartItemId)
    {
        $item = CartItem::find($cartItemId);
        if ($item) {
            $item->quantity++;
            $item->save();
            $this->loadCartItems();
            $this->updateCartCount();
            //$this->emit('cartUpdated');

           $this->dispatch('cartUpdated');

        }
    }

    public function decreaseQuantity($cartItemId)
    {
        $item = CartItem::find($cartItemId);
        if ($item && $item->quantity > 1) {
            $item->quantity--;
            $item->save();
            $this->loadCartItems();
            $this->updateCartCount();
            //$this->emit('cartUpdated');

            $this->dispatch('cartUpdated');

        }
    }

    public function getTotalPriceProperty()
        {
            return $this->cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
        }



    public function render()
    {
        return view('livewire.cart-page', [
            'cartItems' => $this->cartItems,
            'cartItemCount' => $this->cartItemCount,
        ])->layout('layouts.app');
    }
}
