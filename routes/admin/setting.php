<?php
use Illuminate\Support\Facades\Route;
Route::prefix('settings')->group(function () {
    Route::get('/', [
        'as' => 'settings.index',
        'uses' => 'SettingController@index',
        'middleware' => 'can:setting-list'
    ]);
    Route::get('/create', [
        'as' => 'settings.create',
        'uses' => 'SettingController@create',
        'middleware' => 'can:setting-add'
    ]);
    Route::post('/store', [
        'as' => 'settings.store',
        'uses' => 'SettingController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'settings.edit',
        'uses' => 'SettingController@edit',
        'middleware' => 'can:setting-edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'settings.update',
        'uses' => 'SettingController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'settings.delete',
        'uses' => 'SettingController@delete',
        'middleware' => 'can:setting-delete'
    ]);

});
