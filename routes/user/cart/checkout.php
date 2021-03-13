<?php
use Illuminate\Support\Facades\Route;
Route::get('/checkout','User\Checkout@checkout')->name('checkout');
Route::post('/store','User\Checkout@store')->name('storeCart');
