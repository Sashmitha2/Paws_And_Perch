<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}); 

Route::get('test',function (){
    $user = App\Models\User::find(1);
    return $user;
});
