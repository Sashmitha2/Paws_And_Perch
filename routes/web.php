<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('test',function (){
   // $user = App\Models\User::find(1);
   // return $user;


   //$product = App\Models\Product::find(4);
   //return $product->category;

   $order= App\Models\OrderItem::find(7);
   return $order->order;
});


