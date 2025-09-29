

<div class="min-h-screen bg-gray-100">

    
    {{--<header class="bg-white shadow">--}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            
        </div>
    </header>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-r from-yellow-100 via-pink-100 to-blue-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-extrabold text-gray-800 mb-4">Welcome to Paws & Perch</h2>
            <p class="text-xl text-gray-700 mb-6">Your one-stop shop for pet supplies – because your furry (or feathery) friends deserve the best!</p>
            <a href="#categories" class="inline-block bg-pink-600 text-white px-6 py-3 rounded-md font-semibold shadow hover:bg-pink-700 transition">
                Shop by Category
            </a>
        </div>
    </section>

    {{-- Categories Section --}}
    <section id="categories" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-bold text-center text-gray-800 mb-12">Shop by Pet</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                {{-- Dog Category --}}
                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition cursor-pointer overflow-hidden">
                    <img src="images/dog.jpg"
                         alt="Dog Category"
                         class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-800">🐶 For Dogs</h4>
                        <p class="text-gray-600 mt-2">Toys, treats, grooming, collars and more.</p>
                        <a href="{{ route('products.dogs', ['parentCategoryId' => 1]) }}" class="text-pink-600 mt-4 inline-block hover:underline">Explore Dog Product</a>
                    </div>
                </div>

                {{-- Cat Category --}}
                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition cursor-pointer overflow-hidden">
                    <img src="https://cdn.pixabay.com/photo/2017/11/09/21/41/cat-2934720_960_720.jpg"
                         alt="Cat Category"
                         class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-800">🐱 For Cats</h4>
                        <p class="text-gray-600 mt-2">Cozy beds, scratching posts, toys, and more.</p>
                       {{-- <a href="{{ route('products.cats') }}" class="text-pink-600 mt-4 inline-block hover:underline">Explore Cat Supplies →</a> --}}
                       <a href="{{ route('products.cats', ['parentCategoryId' => 2]) }}" class="text-pink-600 mt-4 inline-block hover:underline">Explore Cat Product</a>

                    </div>
                </div>

                {{-- Bird Category --}}
                <div class="bg-gray-50 rounded-lg shadow hover:shadow-lg transition cursor-pointer overflow-hidden">
                    <img src="images/bird.jpg"
                         alt="Bird Category"
                         class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h4 class="text-xl font-semibold text-gray-800">🐦 For Birds</h4>
                        <p class="text-gray-600 mt-2">Cages, perches, feeders, and interactive toys.</p>
                         <a href="{{ route('products.birds', ['parentCategoryId' => 3]) }}" class="text-pink-600 mt-4 inline-block hover:underline">Explore Bird Supplies</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    @include('layouts.footer')

</div>
