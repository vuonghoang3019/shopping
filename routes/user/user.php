<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [
        'as'   => 'user.index',
        'uses' => 'User\UserController@index',
    ]);
    Route::get('change-language/{language}', 'User\UserController@changeLanguage')->name('change-language');

});
