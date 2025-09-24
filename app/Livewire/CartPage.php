<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;

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
                'user_id' => auth()->id(),
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

        public function placeOrder()
            {
                if ($this->cartItems->isEmpty()) {
                    session()->flash('error', 'Your cart is empty.');
                    return;
                }

                DB::beginTransaction();

                try {
                    $order = Order::create([
                        'user_id' => auth()->id(),
                        'total_amount' => $this->totalPrice,
                        'order_status' => 'pending',
                        'address' => 'N/A', // or 'processing'
                    ]);

                    foreach ($this->cartItems as $item) {
                        OrderItem::create([
                            'order_id'   => $order->id,
                            'product_id' => $item->product_id,
                            'quantity'   => $item->quantity,
                            'price'      => $item->product->price,
                        ]);
                    }

                    // Clear the cart (depends on your cart structure)
                    foreach ($this->cartItems as $item) {
                        $item->delete(); // or however you're clearing cart
                    }

                    DB::commit();

                    return redirect()->route('order.success', ['order' => $order->id]);

                } catch (\Exception $e) {
                    DB::rollBack();
                    session()->flash('error', 'Failed to place order. Please try again.');
                    logger($e->getMessage());
                }
            }


    public function render()
    {
        return view('livewire.cart-page', [
            'cartItems' => $this->cartItems,
            'cartItemCount' => $this->cartItemCount,
        ])->layout('layouts.app');
    }
}
