<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('logout', 'Auth\LogoutController@logout');

Route::group(['prefix' => 'user'], function () {
    Route::post('auth', 'UserController@auth');
    Route::post('check-duplicate', 'UserController@checkDuplicate');
});

Route::resource('user', 'UserController');