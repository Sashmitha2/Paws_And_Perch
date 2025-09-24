<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Payment;
use App\Http\Resources\PaymentResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments= Payment::with(['order'])->paginate(10);
        return PaymentResource::collection($payments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'nullable|string|max:255',
            'paid_at' => 'nullable|date',
        ]);

        $payment = Payment::create($validated);

        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'payment_method' => 'sometimes|string|max:255',
            'payment_status' => 'sometimes|string|max:255',
            'paid_at' => 'nullable|date',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($validated);

        return new PaymentResource($payment);

    }

    public function showCheckoutForm()
{
    $cartItems = auth()->user()->cartItems()->with('product')->get();
    $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

    return view('orders.checkout', compact('cartItems', 'totalPrice'));
}

public function placeOrder(Request $request)
{
    $request->validate([
        'address' => 'required|string',
        'payment_method' => 'required|in:cash,card',
    ]);

    $cartItems = auth()->user()->cartItems()->with('product')->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    DB::beginTransaction();

    try {
        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create Order
        $order = Order::create([
            'user_id' => auth()->id(),
            'address' => $request->address,
            'total_amount' => $totalAmount,
            'order_status' => 'pending',
        ]);

        // Create Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
            $item->delete(); // clear cart
        }

        // Create Payment Record
        Payment::create([
            'order_id' => $order->id,
            'amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method === 'cash' ? 'pending' : 'initiated',
            'paid_at' => $request->payment_method === 'cash' ? now() : null,
        ]);

        DB::commit();

        return redirect()->route('order.success', $order->id);

    } catch (\Exception $e) {
        DB::rollBack();
        logger()->error('Order Placement Error: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong. Please try again.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully'], 200);
    }
}
