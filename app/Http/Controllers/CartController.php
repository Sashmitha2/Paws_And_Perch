<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart= Cart::with('user')->paginate(10);
        return CartResource::collection($cart);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:carts,user_id',
            'created_date' => 'nullable|date',
            'status' => 'nullable|string|max:255',
        ]);

        $cart= Cart::create($validated);
        $cart->load('user');

        return new CartResource($cart);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cart = Cart::with('user')->findOrFail($id);
        return new CartResource($cart);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated= $request->validate([
            'status' => 'nullable|string|max:255',
        ]);

        $cart=Cart::findOrFail($id);
        $cart->update($validated);

        return new CartResource($cart);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart=Cart::findOrFail($id);
        $cart->delete();

        return response()->json(['message'=> 'Cart deleted successfully'], 200);
    }
}
