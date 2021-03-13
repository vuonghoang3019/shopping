<?php
use Illuminate\Support\Facades\Route;
Route::prefix('roles')->group(function () {
    Route::get('/', [
        'as' => 'roles.index',
        'uses' => 'AdminRoleController@index'
    ]);
    Route::get('/create', [
        'as' => 'roles.create',
        'uses' => 'AdminRoleController@create'
    ]);
    Route::post('/store', [
        'as' => 'roles.store',
        'uses' => 'AdminRoleController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'roles.edit',
        'uses' => 'AdminRoleController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'roles.update',
        'uses' => 'AdminRoleController@update'
    ]);
});
