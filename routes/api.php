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

Route::group(['middleware' => ['api'], 'prefix' => 'v1'], function () {

    // Sign up route
    Route::post('auth/signup', 'AuthController@signUp');

    // Sign in route
    Route::post('auth/signin', 'AuthController@signIn');



    // Route group for the APIs which needs authentication
    Route::group(['middleware' => 'jwt.auth'], function () {

    });

});