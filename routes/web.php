<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'User\HomeController@index')->name('home');
Route::get('/loginUser', 'User\HomeController@loginUser')->name('loginUser');
Route::post('/register', 'User\HomeController@register')->name('register');
Route::post('/postLogin', 'User\HomeController@postLogin')->name('postLogin');
Route::post('/productHaveSeen', 'User\HomeController@productHaveSeen')->name('productHaveSeen');
Route::get('/logout', 'User\HomeController@logout')->name('logout');
Route::get('/category/{slug}/{id}', [
    'as'   => 'category.product',
    'uses' => 'User\UserCategory@index'
]);

Route::prefix('admin')->group(function () {
    Route::get('/', [
        'as'   => 'admin.login',
        'uses' => 'AdminController@loginAdmin'
    ]);
    Route::post('/', [
        'as'   => 'admin.post-login',
        'uses' => 'AdminController@postloginAdmin'
    ]);
    Route::get('/logout', [
        'as'   => 'logout',
        'uses' => 'AdminController@logout'
    ]);
    Route::get('/dashboard', [
        'as'   => 'index',
        'uses' => 'AdminController@index'
    ]);

    // PHAN NANG CAO CUC MANH
    //test permission
    Route::prefix('module_detail')->group(function () {
        Route::get('/create', [
            'as'   => 'module_detail.create',
            'uses' => 'AdminModuleDetailController@create'
        ]);
        Route::post('/store', [
            'as'   => 'module_detail.store',
            'uses' => 'AdminModuleDetailController@store'
        ]);
    });

    //test module_role
    Route::prefix('module_role')->group(function () {
        Route::get('/', [
            'as'   => 'module_role.index',
            'uses' => 'AdminModuleRoleTestController@index'
        ]);
        Route::get('/create', [
            'as'   => 'module_role.create',
            'uses' => 'AdminModuleRoleTestController@create'
        ]);
        Route::post('/store', [
            'as'   => 'module_role.store',
            'uses' => 'AdminModuleRoleTestController@store'
        ]);
        Route::get('/edit/{id}', [
            'as'   => 'module_role.edit',
            'uses' => 'AdminModuleRoleTestController@edit'
        ]);
        Route::post('/update/{id}', [
            'as'   => 'module_role.update',
            'uses' => 'AdminModuleRoleTestController@update'
        ]);
    });

    // TEST USER_MODULE
    Route::prefix('user_module')->group(function () {
        Route::get('/', [
            'as'   => 'user_module.index',
            'uses' => 'AdminControllerUserModule@index'
        ]);
        Route::get('/create', [
            'as'   => 'user_module.create',
            'uses' => 'AdminControllerUserModule@create'
        ]);
        Route::post('/store', [
            'as'   => 'user_module.store',
            'uses' => 'AdminControllerUserModule@store'
        ]);
    });
});

//test auth login
Route::prefix('authenticate')->middleware('CheckLoginAdmin')->group( function () {
    Route::get('/login', 'AdminControllerTest@getLogin')->name('admin.login');
    Route::post('/login', 'AdminControllerTest@postLogin');
});





