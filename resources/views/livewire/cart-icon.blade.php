<a href="{{ route('cart.index') }}" class="relative inline-flex items-center">
    <!-- Cart SVG Icon -->
    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
         xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-2 5m10-5l1.4 5M5 21h14" />
    </svg>

    @if($cartItemCount > 0)
        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">
            {{ $cartItemCount }}
        </span>
    @endif
</a>
