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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');

//registration is not allowed
//Route::post('register', 'API\UserController@register');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'API\UserController@details');
    Route::get('users', 'API\UserController@index');
    Route::post('users', 'API\UserController@store');
    Route::get('users/{user}', 'API\UserController@view');
    Route::post('users/{user}', 'API\UserController@update');
    Route::delete('users/{user}', 'API\UserController@delete');


    Route::apiResource('photos', 'API\PhotoController');
});
