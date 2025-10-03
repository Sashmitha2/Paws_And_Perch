<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order; 
use Illuminate\Support\Collection;

class Orders extends Component
{

    public $orders;       // Will hold all orders
    public $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled']; 


    //retrieves all the orders from the database according to the user

    public function mount()
    {
        $this->orders = Order::with('user')->orderBy('created_at', 'desc')->get();
    }

    //Function to update the status of the orders
    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::find($orderId);
        if ($order && in_array($newStatus, $this->statuses)) {
            $order->order_status = $newStatus;  
            $order->save();

            // Refresh orders list
            $this->orders = Order::with('user')->orderBy('created_at', 'desc')->get();

            session()->flash('message', "Order #{$order->id} status updated to {$newStatus}.");
        }
    }

    
    public function render()
    {
        return view('livewire.admin.orders')->layout('layouts.admin');
    }
}
