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

Route::get('/', 'Index@index');
Route::get('/product/{id}', 'ProductSingle@index');
Route::get('/category/{id}', 'CategoryProducts@index');
Route::get('/latest/products', 'Index@recent');

/*
 cart route start 
*/
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart/add', 'CartController@addProduct')->name('cart.store');
Route::post('/cart/update', 'CartController@updateProduct')->name('cart.update');
Route::post('/cart/remove', 'CartController@removeProduct')->name('cart.remove');
Route::post('/cart/clear', 'CartController@cartClear')->name('cart.clear');
/*
 cart route end
*/

//Route::get('/')

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');