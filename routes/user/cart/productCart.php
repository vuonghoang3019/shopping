<?php
use Illuminate\Support\Facades\Route;
Route::get('/product','User\UserProductController@index');
Route::get('/product/AddToCart/{id}','User\UserProductController@addToCart')->name('addToCart');
Route::get('/product/showCart','User\UserProductController@showCart')->name('showCart');
//update card
Route::get('/product/updateCart','User\UserProductController@updateCart')->name('updateCart');
//delete cart
Route::get('/product/deleteCart','User\UserProductController@deleteCart')->name('deleteCart');
// product Detail
Route::get('/product/productDetail/{id}','User\UserProductController@productDetail')->name('productDetail');
Route::get('/product/AddToCartProductDetail/{id}','User\UserProductController@AddToCartProductDetail')->name('AddToCartProductDetail');
// rating
Route::post('/product/productDetail/rating/{id}','User\UserRatingController@saveRating')->name('productRating');

