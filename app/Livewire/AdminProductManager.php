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
    
    public $mainCategories = [];
    public $subCategories = [];

    public function mount()
    {
        //$this->loadProducts();

        $this->mainCategories = Category::whereNull('parent_category_id')->get();

        // ✅ Always load all subcategories
        $this->subCategories = Category::whereNotNull('parent_category_id')->get();
    }

    
    public function render()
    {
        return view('livewire.admin-product-manager')->layout('layouts.admin');
    }
}
