<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Livewire\ReviewComponent;
use App\Livewire\HomePage;
use App\Livewire\DogProducts;
use App\Livewire\CatProducts;
use App\Livewire\BirdProducts;
use App\Livewire\AdminProductManager;
use App\Livewire\Admin\Orders;
use App\Http\Controllers\Auth\OTPController;

Route::get('/', function () {
    return view('auth.select-role');
}); 

Route::get('test',function (){
   

   $order= App\Models\OrderItem::find(7);
   return $order->order;
});

Route::get('/api/products', [ProductController::class, 'index']);


Route::get('/login', function () {
    return view('auth.login'); // or your login Blade file
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/home', HomePage::class)->name('home');
// });

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/home', HomePage::class)->name('home');
});


Route::middleware('auth:admin')->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});

//Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'store']);
//});



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::get('/select-role', function () {
    return view('auth.select-role');
});


 

Route::get('/products/dogs/{parentCategoryId}', DogProducts::class)->name('products.dogs');
//Route::get('/products/cats', CatProducts::class)->name('products.cats');

Route::get('/products/cats/{parentCategoryId}', CatProducts::class)->name('products.cats');

Route::get('/products/birds/{parentCategoryId}', BirdProducts::class)->name('products.birds');

Route::get('/cart', \App\Livewire\CartPage::class)->name('cart.index');



Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/products', AdminProductManager::class)->name('admin.products');
});

Route::middleware(['auth'])->group(function(){

    Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');

    Route::get('/checkout', [PaymentController::class, 'showCheckoutForm'])->name('checkout');
    Route::post('/checkout', [PaymentController::class, 'placeOrder'])->name('checkout.placeOrder');
});


Route::get('/my-orders', [OrderController::class, 'viewOrders'])->name('orders.index');



//Route::get('/product/{productId}/reviews', ReviewComponent::class)->name('product.reviews');

//Route::get('/reviews/{productId}', ReviewComponent::class)->name('reviews');

Route::get('/reviews', ReviewComponent::class)->name('reviews');

// Route::get('/test-mongo-connection', function () {
//     $review = Review::create([
//         'user_id' => 99,
//         'rating' => 5,
//         'comment' => 'Test review from Laravel app',
//         'image' => null,
//     ]);

//     return 'Saved review with ID: ' . $review->_id;
// });

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/orders', Orders::class)->name('admin.orders');
});


Route::get('/verify-otp', [AuthController::class, 'showOtpForm'])->name('otp.verify');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('otp.check');
