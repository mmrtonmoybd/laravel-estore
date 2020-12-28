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
Route::group(['middleware' => 'HtmlMinifire'], function () {
    Route::get('/', 'App\Http\Controllers\Index@index');
    Route::get('/product/{id}', 'App\Http\Controllers\ProductSingle@index');
    Route::get('/category/{id}', 'App\Http\Controllers\CategoryProducts@index');
    Route::get('/all/products/', 'App\Http\Controllers\Index@recent');
    Route::get('product/search/', 'App\Http\Controllers\SearchController@index');

    // cart route start
    Route::get('/cart/', 'App\Http\Controllers\CartController@index')->name('cart.index');
    Route::post('/cart/add/', 'App\Http\Controllers\CartController@addProduct')->name('cart.store');
    Route::post('/cart/update/', 'App\Http\Controllers\CartController@updateProduct')->name('cart.update');
    Route::post('/cart/remove/', 'App\Http\Controllers\CartController@removeProduct')->name('cart.remove');
    Route::post('/cart/clear/', 'App\Http\Controllers\CartController@cartClear')->name('cart.clear');

    // page route
    Route::get('page/{id}', 'App\Http\Controllers\Admin\PageController@show')->name('page.show');

    Route::get('test/', 'App\Http\Controllers\Test@test');
    // User route
    require 'users.php';
    // Admin route
    require 'admins.php';
});
// Sitemap route
Route::get('sitemap.xml', 'App\Http\Controllers\Sitemap@sitemap');