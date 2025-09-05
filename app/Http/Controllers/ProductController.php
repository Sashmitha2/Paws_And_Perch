<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        ///allows to get 10 products per page
        $product = Product::with(['category','orderitems'])->paginate(10);
        return ProductResource::collection($product);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated= $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'price'=> 'required|numeric|min:0',
            'description'=>'nullable|string',
            'image'=>'nullable|string|max:255',
        ]);

        $product=Product::create($validated);
        return new ProductResource($product);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category','orderitems'])->findOrFail($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'product_name'=>'sometimes|string|max:255',
            'price'=>'sometimes|numeric|min:0',
            'description'=>'nullable|string',
            'image'=>'nullable|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);

    }

}
