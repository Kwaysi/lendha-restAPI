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
Route::post('register', 'userController@register');
Route::post('login', 'userController@authenticate');
    
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/category', 'CategoriesController@index');
    Route::get('/category/{id}', 'CategoriesController@getProductsByCategory');
    Route::post('/category/create', 'CategoriesController@create');
    Route::post('/category/update/{id}', 'CategoriesController@update');
    Route::delete('/category/delete/{id}', 'CategoriesController@destroy');

    Route::get('/product', 'ProductController@index');
    Route::post('/product/create', 'ProductController@create');
    Route::post('/product/update/{id}', 'ProductController@update');
    Route::delete('/product/delete/{id}', 'ProductController@destroy');
});