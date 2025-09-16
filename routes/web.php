<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;


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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'store']);
});

Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::get('/select-role', function () {
    return view('auth.select-role');
});

