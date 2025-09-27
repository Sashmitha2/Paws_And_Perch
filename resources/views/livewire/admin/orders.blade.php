<div class="p-8 bg-white rounded-lg shadow-lg max-w-7xl mx-auto">
    <h2 class="text-3xl font-semibold mb-8 text-gray-900 tracking-tight">All Orders</h2>

    @if (session()->has('message'))
        <div class="mb-6 px-6 py-3 bg-green-100 text-green-800 rounded-lg shadow-sm border border-green-200">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Update Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($orders as $order)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->user->name ?? 'Guest' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rs.{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span 
                                class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                @if($order->order_status === 'Pending') bg-yellow-100 text-yellow-800
                                @elseif($order->order_status === 'Processing') bg-blue-100 text-blue-800
                                @elseif($order->order_status === 'Shipped') bg-indigo-100 text-indigo-800
                                @elseif($order->order_status === 'Delivered') bg-green-100 text-green-800
                                @elseif($order->order_status === 'Cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif
                                ">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <select wire:change="updateStatus({{ $order->id }}, $event.target.value)" 
                                    class="border border-gray-300 rounded-md shadow-sm py-1 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" @if($order->order_status === $status) selected @endif>{{ $status }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
