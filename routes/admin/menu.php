<?php
use Illuminate\Support\Facades\Route;
Route::prefix('menus')->group(function () {
    Route::get('/', [
        'as' => 'menus.index',
        'uses' => 'MenuController@index',
        'middleware' => 'can:menu-list',
    ]);
    Route::get('/create', [
        'as' => 'menus.create',
        'uses' => 'MenuController@create',
        'middleware' => 'can:menu-add'
    ]);
    Route::post('/store', [
        'as' => 'menus.store',
        'uses' => 'MenuController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'menus.edit',
        'uses' => 'MenuController@edit',
        'middleware' => 'can:menu-edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'menus.update',
        'uses' => 'MenuController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'menus.delete',
        'uses' => 'MenuController@delete',
        'middleware' => 'can:menu-delete'
    ]);

});
