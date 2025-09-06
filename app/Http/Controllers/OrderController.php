<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = Auth::user();
         
        $order = Order::with(['user','items','payment'])->where('user_id', $user->id)->paginate(10);
        return OrderResource::collection($order);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'user_id' => 'nullable|exists:users,id',
            'address' => 'nullable|string',
            'total_amount' => 'required|numeric|min:0',
            'order_status' => 'nullable|string|max:255',
        ]);

        $order = Order::create($validated);

        $order->load(['user','items','payment']);

        return new OrderResource($order);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with(['user','items','payment'])->findOrFail($id);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated=$request->validate([
            'address'=>'nullable|string',
            'total_amount' => 'sometimes|numeric|min:0',
            'order_status'=>'sometimes|string|max:255',
        ]);

        $order=Order::findOrFail($id);
        $order->update($validated);
        $order->load(['user', 'items', 'payment']);


        return new OrderResource($order);



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order=Order::findOrFail($id);
        $order->delete();

        return response()->json(['message'=>'Order deleted successfully', 200]);
    }
}
