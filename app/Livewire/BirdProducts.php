<?php

namespace App\Livewire;

use Livewire\Component;

class BirdProducts extends Component
{
    public function render()
    {

        // In BirdProducts Livewire component
        $products = Product::whereHas('category', function($query) {
            $query->where('slug', 'bird');
        })->get();

        return view('livewire.bird-products');
    }
}
