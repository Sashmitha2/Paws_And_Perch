<?php



namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;

class CatProducts extends Component
{
    public $parentCategoryId;
    public $subcategories;
    public $products;
    public $search = '';

    public function mount($parentCategoryId)
    {
        $this->parentCategoryId = $parentCategoryId;

        // Load subcategories for this parent category
        $this->subcategories = Category::where('parent_category_id', $this->parentCategoryId)->get();

        // Get IDs of subcategories
        $subCatIds = $this->subcategories->pluck('id')->toArray();

        // Load products under these subcategories
        $this->products = Product::whereIn('category_id', $subCatIds)->get();
    }

    public function updatedSearch()
    {
        // Filter products by search query within the subcategories
        $subCatIds = Category::where('parent_category_id', $this->parentCategoryId)->pluck('id')->toArray();

        $this->products = Product::whereIn('category_id', $subCatIds)
            ->where('product_name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function render()
    {
        return view('livewire.cat-products')->layout('layouts.app');
    }
}

?>
