<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/products', 'TestController@getProducts')->name('get.products');
Route::get('/products/{product_id}', 'TestController@getProduct')->where('product_id', '[0-9_\-]+')->name('get.product');
Route::post('/products', 'TestController@add')->name('add.product');
Route::put('/products/{product_id}', 'TestController@edit')->where('product_id', '[0-9_\-]+')->name('edit.product');
Route::delete('/products/{product_id}', 'TestController@delete')->where('product_id', '[0-9_\-]+')->name('delete.product');

