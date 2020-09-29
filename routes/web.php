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
Route::get('/latest/products/', 'Index@recent');
Route::get('product/search/', 'SearchController@index');

/*
 cart route start 
*/
Route::get('/cart/', 'CartController@index')->name('cart.index');
Route::post('/cart/add/', 'CartController@addProduct')->name('cart.store');
Route::post('/cart/update/', 'CartController@updateProduct')->name('cart.update');
Route::post('/cart/remove/', 'CartController@removeProduct')->name('cart.remove');
Route::post('/cart/clear/', 'CartController@cartClear')->name('cart.clear');

Route::get('test/', 'Test@test');
/*
User route
*/
require('users.php');
/*
Admin route
*/
require('admins.php');

/*
Sitemap route
*/
//require('sitemap.php');
Route::get('sitemap.xml', 'Sitemap@sitemap');