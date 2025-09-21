<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AuthController;
use App\Livewire\HomePage;
use App\Livewire\DogProducts;
use App\Livewire\CatProducts;

Route::get('/', function () {
    return view('auth.select-role');
}); 

Route::get('test',function (){
   // $user = App\Models\User::find(1);
   // return $user;


   //$product = App\Models\Product::find(4);
   //return $product->category;

   $order= App\Models\OrderItem::find(7);
   return $order->order;
});



// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/home', function () {
//         return view('home-page');
//     })->name('home');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', HomePage::class)->name('home');
});

Route::middleware('auth')->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'store']);
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::get('/select-role', function () {
    return view('auth.select-role');
});


 

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/home', HomePage::class)->name('home');
// });

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/orders', OrderController::class)->name('orders');
// });

//Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');

// Route::get('/products', function () {
//     return view('products.index');
// })->name('products.browse');

// routes/web.php



//Route::get('/products', ProductBrowse::class)->name('products.browse');

Route::get('/products/dogs', DogProducts::class)->name('products.dogs');
//Route::get('/products/cats', CatProducts::class)->name('products.cats');

Route::get('/products/cats/{parentCategoryId}', CatProducts::class)->name('products.cats');

Route::get('/cart', \App\Livewire\CartPage::class)->name('cart.index');
