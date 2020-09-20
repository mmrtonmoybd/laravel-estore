<?php
Route::group([
'prefix' => 'admins',
], function () {
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
 Route::post('login', 'Admin\LoginController@login');
 Route::get('password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.reset');
 Route::post('password/reset/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.email');
 
 Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
      Route::post('password/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
 
 //Auth middleware group route
 Route::group(['middleware' => 'adminAuth:admin'], function () {
     Route::get('/', 'Admin\Dashboard@index')->name('admin.dashboard');
     
     Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
     
     Route::get('products', 'Admin\ProductController@index')->name('admin.product.list');
	 Route::get('products/add', 'Admin\ProductController@add')->name('admin.product.add');
	 Route::post('products/add', 'Admin\ProductController@store');
	 
	 Route::get('products/update/{id}', 'Admin\ProductController@showForm')->name('admin.product.update');
	 Route::post('products/update/{id}', 'Admin\ProductController@update');
 });
});