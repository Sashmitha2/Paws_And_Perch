<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class DogProducts extends Component
{
    use WithPagination;

    public $search = '';
    public $min_price;
    public $max_price;

    public $dogCategoryId;

    public function mount()
    {
        $this->dogCategoryId = Category::where('name', 'Dog')->value('id');
    }

    public function updating($property)
    {
        if (in_array($property, ['search', 'min_price', 'max_price'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        // $query = Product::query()->where('category_id', $this->dogCategoryId);

        // if ($this->search) {
        //     $query->where('product_name', 'like', '%' . $this->search . '%');
        // }

        // if ($this->min_price) {
        //     $query->where('price', '>=', $this->min_price);
        // }

        // if ($this->max_price) {
        //     $query->where('price', '<=', $this->max_price);
        // }

        // $products = $query->paginate(12);

        $products = Product::whereHas('category', function($query) {
            $query->where('slug', 'dog');  // Filtering by category slug
        })->get();

       return view('livewire.dog-products', compact('products'))->layout('layouts.app');

    }
}
?>