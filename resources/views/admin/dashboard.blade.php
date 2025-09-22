{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h1> Welcome to the Admin Dashboard</h1>
        </h2>
    </x-slot>
</x-app-layout> --}}

<!-- resources/views/admin/dashboard.blade.php -->


<div class="min-h-screen bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-gray-800">Admin Panel</h2>
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200' : '' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('admin.products') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.products*') ? 'bg-gray-200' : '' }}">
                📦 Products
            </a>
            {{--<a href="{{ route('admin.orders') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.orders*') ? 'bg-gray-200' : '' }}">
                🛒 Orders
            </a>
            <a href="{{ route('admin.users') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.users*') ? 'bg-gray-200' : '' }}">
                👤 Users
            </a> --}}
            {{--<a href="{{ route('admin.reports') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.reports*') ? 'bg-gray-200' : '' }}">
                📊 Reports
            </a>
            <a href="{{ route('admin.settings') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-200 {{ request()->routeIs('admin.settings*') ? 'bg-gray-200' : '' }}">
                ⚙️ Settings
            </a> --}}
        </nav>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
            <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <!-- Quick actions -->
                {{-- <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + New Product
                </a>
                <a href="{{ route('admin.orders') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    View Orders
                </a> --}}
            </div>
        </header>

        <!-- Metrics Cards -->
        {{--<div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Total Users</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalUsers }}</div>
            </div>
            <div class="bg-white shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Total Orders</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalOrders }}</div>
            </div>
            <div class="bg-white shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Revenue (Last 30 days)</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">${{ $revenueLast30 }}</div>
            </div>
            <div class="bg-white shadow rounded-lg p-5">
                <div class="text-sm font-medium text-gray-500">Products Low in Stock</div>
                <div class="mt-1 text-3xl font-semibold text-gray-900">{{ $lowStockCount }}</div>
            </div>
        </div> --}}

        <!-- Charts & Recent Orders Section -->
        <div class="p-6 space-y-6 flex-1 overflow-y-auto">

            <!-- Sales Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Sales Trend (Last 7 Days)</h2>
                <!-- Here you can insert a chart, e.g. using Chart.js -->
                <canvas id="salesChart" class="w-full h-48"></canvas>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Recent Orders</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        {{--<tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">${{ $order->total }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800 
                                            @elseif($order->status == 'completed') bg-green-100 text-green-800 
                                            @elseif($order->status == 'cancelled') bg-red-100 text-red-800 
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>

                    {{--@if($recentOrders->isEmpty())
                        <p class="text-gray-500">No recent orders</p>
                    @endif--}}
                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer class="bg-white border-t mt-auto py-4 px-6">
            <div class="flex justify-between text-sm text-gray-500">
                <span>© {{ date('Y') }} Paws & Perch Admin. All rights reserved.</span>
                {{--<div>
                    <a href="{{ route('admin.settings') }}" class="hover:underline">Settings</a>
                    <span class="mx-2">|</span>
                    <a href="{{ route('admin.profile') }}" class="hover:underline">Profile</a>
                </div>--}}
            </div>
        </footer>

    </div>
</div>

<!-- Include Chart.js or your preferred chart library script -->
{{--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}

<script>
    window.apiToken = @json(session('api_token'));
</script>

{{--<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesLast7DaysLabels) !!},
            datasets: [{
                label: 'Sales',
                data: {!! json_encode($salesLast7DaysData) !!},
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script> --}}
