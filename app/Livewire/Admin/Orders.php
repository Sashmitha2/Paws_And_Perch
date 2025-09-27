<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order; // Assuming you have an Order model
use Illuminate\Support\Collection;

class Orders extends Component
{

    public $orders;       // Will hold all orders
    public $statuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled']; // Possible statuses

    public function mount()
    {
        $this->orders = Order::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function updateStatus($orderId, $newStatus)
{
    $order = Order::find($orderId);
    if ($order && in_array($newStatus, $this->statuses)) {
        $order->order_status = $newStatus;  // Use order_status here
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
