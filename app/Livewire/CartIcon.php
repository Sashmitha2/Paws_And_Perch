<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;

class CartIcon extends Component
{
    public $cartItemCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();

            if ($cart) {
                $this->cartItemCount = CartItem::where('cart_id', $cart->id)->sum('quantity');
            } else {
                $this->cartItemCount = 0;
            }
        } else {
            $this->cartItemCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
