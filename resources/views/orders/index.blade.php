<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My Orders</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

  <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-xl mt-16">
    <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-900">My Orders</h2>

    @if($orders->isEmpty())
      <div class="text-center text-gray-600 py-10">
        <p class="text-xl">You haven't placed any orders yet.</p>
        <a href="{{ url('/') }}" class="mt-4 inline-block text-indigo-600 font-semibold hover:underline">
          Go to Shop
        </a>
      </div>
    @else
      @foreach($orders as $order)
        <div class="mb-8 border border-gray-200 rounded-lg shadow-sm overflow-hidden">
          <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
            <div>
              <h3 class="text-xl font-semibold text-gray-800">Order #{{ $order->id }}</h3>
              <p class="text-sm text-gray-600">Placed on {{ $order->created_at->format('F j, Y') }}</p>
            </div>
            <div class="text-right">
              <span class="text-lg font-bold text-green-600">Rs. {{ number_format($order->total_amount, 2) }}</span>
              <p class="text-sm text-gray-500">
                Payment: {{ ucfirst($order->payment->method ?? 'N/A') }}
              </p>
            </div>
          </div>

          <div class="px-6 py-4">
            <ul class="divide-y divide-gray-200">
              @foreach($order->items as $item)
                <li class="py-4 flex items-center">
                  <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden mr-4 flex items-center justify-center">
                    @if($item->product && $item->product->image)
                      <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->product_name }}" class="object-cover w-full h-full" />
                    @else
                      <span class="text-gray-400 text-sm italic">No Image</span>
                    @endif
                  </div>
                  <div class="flex-1">
                    <h4 class="text-gray-800 font-semibold">{{ $item->product->product_name ?? 'Product Deleted' }}</h4>
                    <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                    <p class="text-sm text-gray-600">Price: Rs. {{ number_format($item->price, 2) }}</p>
                  </div>
                  <div class="text-right font-bold text-green-600">
                    Rs. {{ number_format($item->price * $item->quantity, 2) }}
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endforeach
    @endif
  </div>

</body>
</html>
