<?php

use Illuminate\Support\Facades\Route;

Route::prefix('orders')->group(function () {
    Route::get('/',[
        'as' => 'order.index',
        'uses' => 'AdminOrderController@index',
        'middleware' => 'can:order-list'
    ]);
    Route::get('/viewDetail/{id}',[
        'as' => 'order.viewDetail',
        'uses' => 'AdminOrderController@viewDetail',
        'middleware' => 'can:order-viewDetail'
    ]);
    Route::get('/actionOrder/{id}',[
        'as' => 'order.actionOrder',
        'uses' => 'AdminOrderController@actionOrder',
        'middleware' => 'can:order-actionOrder'
    ]);
    Route::get('/delete/{id}',[
        'as' => 'order.delete',
        'uses' => 'AdminOrderController@delete',
        'middleware' => 'can:order-delete'
    ]);
});
