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

// User access control routes
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::post('create', 'ProductController@create');
    Route::get('/', 'ProductController@index');
    Route::get('/{id}', 'ProductController@getProductsByCategory');
    Route::post('update', 'ProductController@update');
    Route::delete('delete/{id}', 'ProductController@destroy');

Route::middleware('auth:api')->get('/products', function (Request $request) {
    return $request->user();
    // Product routes
    Route::post('create', 'ProductController@create');
    Route::get('/', 'ProductController@index');
    Route::post('update', 'ProductController@update');
    Route::delete('delete', 'ProductController@destroy');
});
