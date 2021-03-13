<?php
use Illuminate\Support\Facades\Route;
Route::prefix('permissions')->group(function () {
    Route::get('/', [
        'as' => 'permissions.index',
        'uses' => 'AdminPermissionController@index'
    ]);
    Route::get('/create', [
        'as' => 'permissions.create',
        'uses' => 'AdminPermissionController@create'
    ]);
    Route::post('/store', [
        'as' => 'permissions.store',
        'uses' => 'AdminPermissionController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'permissions.edit',
        'uses' => 'AdminPermissionController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'permissions.update',
        'uses' => 'AdminPermissionController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'permissions.delete',
        'uses' => 'AdminPermissionController@delete'
    ]);
});
