<?php
use Illuminate\Support\Facades\Route;
Route::prefix('products')->group(function () {
    Route::get('/', [
        'as' => 'products.index',
        'uses' => 'AdminProductController@index',
        'middleware' => 'can:product-list',
    ]);
    Route::get('/create', [
        'as' => 'products.create',
        'uses' => 'AdminProductController@create'
    ]);
    Route::post('/store', [
        'as' => 'products.store',
        'uses' => 'AdminProductController@store'
    ]);
    Route::get('/edit/{id}',[
        'as' => 'products.edit',
        'uses' => 'AdminProductController@edit',
        'middleware' => 'can:product-edit,id'
    ]);
    Route::post('/update/{id}',[
        'as' => 'products.update',
        'uses' => 'AdminProductController@update'
    ]);
    Route::get('/delete/{id}',[
        'as' => 'products.delete',
        'uses' => 'AdminProductController@delete'
    ]);
    Route::get('/action/{id}',[
        'as' => 'products.action',
        'uses' => 'AdminProductController@action'
    ]);
});
