<?php

use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::get('/', [
        'as'   => 'user.index',
        'uses' => 'User\UserController@index',
    ]);

});
