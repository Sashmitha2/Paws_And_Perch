<!-- resources/views/components/footer.blade.php -->
<footer class="bg-gray-900 text-gray-300 py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-3 gap-8">
        
        <!-- About Section -->
        <div>
            <h3 class="text-white text-lg font-semibold mb-4">🐾 Paws & Perch</h3>
            <p class="text-gray-400">
                Your trusted spot for quality pet products and care tips. Bringing happiness to your furry friends every day!
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                {{--<li><a href="{{ route('shop') }}" class="hover:text-white">Shop</a></li> 
                <li><a href="{{ route('orders') }}" class="hover:text-white">My Orders</a></li> --}}
                <li><a href="{{ route('profile.show') }}" class="hover:text-white">Profile</a></li>
                {{--<li><a href="{{ route('contact') }}" class="hover:text-white">Contact Us</a></li> --}}
            </ul>
        </div>

        <!-- Contact & Social -->
        <div>
            <h3 class="text-white text-lg font-semibold mb-4">Contact & Follow Us</h3>
            <p>Email: support@pawsandperch.com</p>
            <p>Phone: +1 (555) 123-4567</p>

            <div class="flex space-x-4 mt-4">
                <a href="https://facebook.com" target="_blank" class="hover:text-white" aria-label="Facebook">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54v-2.205c0-2.507 1.492-3.89 3.778-3.89 1.094 0 2.238.195 2.238.195v2.462h-1.26c-1.243 0-1.63.771-1.63 1.562v1.876h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/></svg>
                </a>
                <a href="https://twitter.com" target="_blank" class="hover:text-white" aria-label="Twitter">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14.86 4.48 4.48 0 001.98-2.48 9.05 9.05 0 01-2.87 1.1 4.52 4.52 0 00-7.69 4.12A12.85 12.85 0 013 4.15 4.52 4.52 0 004.9 10.1 4.5 4.5 0 012 9.7v.06a4.52 4.52 0 003.63 4.43 4.52 4.52 0 01-2.05.08 4.53 4.53 0 004.22 3.14A9 9 0 012 19.54 12.8 12.8 0 008.29 21c7.54 0 11.67-6.25 11.67-11.67 0-.18 0-.35-.01-.53A8.18 8.18 0 0023 3z"/></svg>
                </a>
                <a href="https://instagram.com" target="_blank" class="hover:text-white" aria-label="Instagram">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 2A3.75 3.75 0 004 7.75v8.5A3.75 3.75 0 007.75 20h8.5a3.75 3.75 0 003.75-3.75v-8.5A3.75 3.75 0 0016.25 4h-8.5zm8.25 1.5a1.25 1.25 0 110 2.5 1.25 1.25 0 010-2.5zM12 7a5 5 0 110 10 5 5 0 010-10zm0 2a3 3 0 100 6 3 3 0 000-6z"/></svg>
                </a>
            </div>
        </div>

    </div>

    <div class="mt-8 border-t border-gray-800 pt-4 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Paws & Perch. All rights reserved.
    </div>
</footer>
