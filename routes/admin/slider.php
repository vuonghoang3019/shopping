<?php
use Illuminate\Support\Facades\Route;
Route::prefix('sliders')->group(function () {
    Route::get('/', [
        'as' => 'sliders.index',
        'uses' => 'SliderController@index',
        'middleware' => 'can:slider-list'
    ]);
    Route::get('/create', [
        'as' => 'sliders.create',
        'uses' => 'SliderController@create'
    ]);
    Route::post('/store', [
        'as' => 'sliders.store',
        'uses' => 'SliderController@store'
    ]);
    Route::get('/edit/{id}', [
        'as' => 'sliders.edit',
        'uses' => 'SliderController@edit'
    ]);
    Route::post('/update/{id}', [
        'as' => 'sliders.update',
        'uses' => 'SliderController@update'
    ]);
    Route::get('/delete/{id}', [
        'as' => 'sliders.delete',
        'uses' => 'SliderController@delete'
    ]);
});
