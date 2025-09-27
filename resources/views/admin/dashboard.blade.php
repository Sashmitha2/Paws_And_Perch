<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>Admin Dashboard • Paws & Perch</title>

  <!-- Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap"
    rel="stylesheet"
  />

  <!-- Tailwind and styles -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    .hover-item:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    }
    .bg-glass {
      background: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(10px);
    }
  </style>

  @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

  {{-- Nav / Banner --}}
  <div class="w-full bg-white shadow-sm sticky top-0 z-50">

    <div
      class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between"
    >
      <div class="flex items-center space-x-4">
        <!-- Sidebar toggle button (mobile) -->
        <button
          id="sidebarToggle"
          aria-label="Toggle Sidebar"
          class="lg:hidden p-2 rounded-md text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
          <svg
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
        </button>
        <h1 class="text-2xl lobster-font font-bold text-gray-800 select-none">🐾 Paws & Perch</h1>
      </div>

      <!-- Settings Dropdown -->
      <div class="relative">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <button
              class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
            >
              <img
                class="h-8 w-8 rounded-full object-cover"
                src="{{ Auth::user()->profile_photo_url }}"
                alt="{{ Auth::user()->name }}"
              />
            </button>
            @else
            <span class="inline-flex rounded-md">
              <button
                type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
              >
                {{ Auth::user()->name }}
                <svg
                  class="ml-2 -mr-0.5 h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                  />
                </svg>
              </button>
            </span>
            @endif
          </x-slot>

          <x-slot name="content">
            <div class="block px-4 py-2 text-xs text-gray-400">Manage Account</div>
            <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>
            <div class="border-t border-gray-200"></div>
            <form method="POST" action="{{ route('admin.logout') }}" x-data>
              @csrf
              <x-dropdown-link
                href="{{ route('admin.logout') }}"
                @click.prevent="$root.submit();"
              >
                Log Out
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>
    </div>
  </div>

  <div
    class="flex min-h-screen max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 gap-8"
  >
    {{-- Sidebar --}}
    <aside
      id="sidebar"
      class="fixed inset-y-0 left-0 w-64 bg-white bg-glass rounded-r-2xl p-6 shadow-lg z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out"
      aria-label="Sidebar Navigation"
    >
      <div class="mb-10">
        <h2 class="text-3xl font-semibold">Admin Panel</h2>
      </div>
      <nav class="space-y-4" role="navigation">
        <a
          href="{{ route('admin.dashboard') }}"
          class="block py-3 px-4 rounded-lg hover:bg-gray-100 transition hover-item {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-semibold' : '' }}"
          >Dashboard</a
        >
        <a
          href="{{ route('admin.products') }}"
          class="block py-3 px-4 rounded-lg hover:bg-gray-100 transition hover-item {{ request()->routeIs('admin.products*') ? 'bg-gray-100 font-semibold' : '' }}"
          >Products</a
        >
        <a
          href="{{ route('admin.orders') }}"
          class="block py-3 px-4 rounded-lg hover:bg-gray-100 transition hover-item {{ request()->routeIs('admin.orders*') ? 'bg-gray-100 font-semibold' : '' }}"
          >Orders</a
        >
      </nav>
    </aside>

    {{-- Main Content --}}
    <main
      class="flex-1 flex flex-col space-y-8 lg:ml-64"
      aria-live="polite"
      tabindex="-1"
    >
      {{-- Hero / Header --}}
      <header
        class="bg-white rounded-2xl px-6 py-6 shadow hover-item transition sm:px-8"
      >
        <h1 class="text-3xl sm:text-4xl font-bold">Welcome, Admin</h1>
        <p class="mt-2 text-gray-600 text-sm sm:text-base">
          Here’s what’s happening with your store today.
        </p>
      </header>

      {{-- Metrics Grid --}}
      <section
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
        aria-label="Key Metrics"
      >
        <div
          class="bg-white rounded-2xl p-6 shadow hover-item transition text-center"
        >
          <div class="text-sm font-medium uppercase text-gray-500">
            Total Users
          </div>
          <div class="mt-4 text-3xl font-bold">1,234</div>
        </div>
        <div
          class="bg-white rounded-2xl p-6 shadow hover-item transition text-center"
        >
          <div class="text-sm font-medium uppercase text-gray-500">
            Total Orders
          </div>
          <div class="mt-4 text-3xl font-bold">567</div>
        </div>
        <div
          class="bg-white rounded-2xl p-6 shadow hover-item transition text-center"
        >
          <div class="text-sm font-medium uppercase text-gray-500">
            Revenue (30d)
          </div>
          <div class="mt-4 text-3xl font-bold">Rs.12,345</div>
        </div>
        <div
          class="bg-white rounded-2xl p-6 shadow hover-item transition text-center"
        >
          <div class="text-sm font-medium uppercase text-gray-500">Low Stock</div>
          <div class="mt-4 text-3xl font-bold">5 Items</div>
        </div>
      </section>

      {{-- Chart Section --}}
      <section
        class="bg-white rounded-2xl p-6 shadow hover-item transition"
        aria-label="Sales Trend Chart"
      >
        <h2 class="text-2xl font-semibold mb-4">Sales Trend</h2>
        <div class="overflow-x-auto">
          <canvas id="salesChart" class="w-full h-64 min-w-[320px]"></canvas>
        </div>
      </section>

      {{-- Recent Orders --}}
      <section
        class="bg-white rounded-2xl p-6 shadow hover-item transition"
        aria-label="Recent Orders"
      >
        <h2 class="text-2xl font-semibold mb-4">Recent Orders</h2>
        <div class="overflow-x-auto">
          <table
            class="min-w-full table-auto divide-y divide-gray-200 text-sm"
          >
            <thead class="bg-gray-50">
              <tr>
                <th
                  class="px-6 py-3 text-left uppercase font-medium text-gray-500"
                >
                  Order #
                </th>
                <th
                  class="px-6 py-3 text-left uppercase font-medium text-gray-500"
                >
                  Customer
                </th>
                <th
                  class="px-6 py-3 text-left uppercase font-medium text-gray-500"
                >
                  Total
                </th>
                <th
                  class="px-6 py-3 text-left uppercase font-medium text-gray-500"
                >
                  Status
                </th>
                <th
                  class="px-6 py-3 text-left uppercase font-medium text-gray-500"
                >
                  Date
                </th>
                <th class="px-6 py-3"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
              <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">#1001</td>
                <td class="px-6 py-4">Jane Doe</td>
                <td class="px-6 py-4 font-semibold">$120.00</td>
                <td class="px-6 py-4">
                  <span
                    class="px-3 py-1 inline-block text-xs font-semibold rounded-full text-yellow-800 bg-yellow-100"
                    >Pending</span
                  >
                </td>
                <td class="px-6 py-4 text-gray-500">Sep 26, 2025</td>
                <td class="px-6 py-4 text-right">
                  <a href="#" class="text-indigo-600 hover:underline">View</a>
                </td>
              </tr>
              {{-- more rows --}}
            </tbody>
          </table>
        </div>
      </section>

      {{-- Footer --}}
      <footer class="text-gray-500 text-center py-6">
        © {{ date('Y') }} Paws & Perch. All rights reserved.
      </footer>
    </main>
  </div>

  <script>window.apiToken = @json(session('api_token'));</script>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [
          {
            label: 'Sales',
            data: [100, 150, 120, 180, 170, 140, 200],
            borderColor: '#6366F1',
            backgroundColor: 'rgba(99,102,241,0.2)',
            fill: true,
            tension: 0.4,
          },
        ],
      },
      options: {
        responsive: true,
        scales: {
          y: { beginAtZero: true },
        },
      },
    });

    // Sidebar toggle script
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });

    // Optional: close sidebar when clicking outside on mobile
    window.addEventListener('click', (e) => {
      if (
        !sidebar.contains(e.target) &&
        !sidebarToggle.contains(e.target) &&
        !sidebar.classList.contains('-translate-x-full') &&
        window.innerWidth < 1024
      ) {
        sidebar.classList.add('-translate-x-full');
      }
    });
  </script>

  @livewireScripts
</body>
</html>
