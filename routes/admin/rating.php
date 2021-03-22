<?php
use Illuminate\Support\Facades\Route;
Route::prefix('rating')->group(function () {
    Route::get('/', [
        'as' => 'rating.index',
        'uses' => 'AdminRatingController@index',
    ]);
});
