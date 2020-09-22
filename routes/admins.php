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
	 Route::get('products/delete/{id}', 'Admin\ProductController@delete')->name('admin.product.delete');
	 
	 Route::get('categories', 'Admin\CategoryController@index')->name('admin.category.list');
	 Route::get('categories/add', 'Admin\CategoryController@showForm')->name('admin.category.add');
	 Route::post('categories/add', 'Admin\CategoryController@store');
	 Route::get('categories/update/{id}', 'Admin\CategoryController@updateForm')->name('admin.category.update');
	 Route::post('categories/update/{id}', 'Admin\CategoryController@update');
	 Route::get('categories/delete/{id}', 'Admin\CategoryController@delete')->name('admin.category.delete');
	 
	 Route::get('payments', 'Admin\PaymentController@index')->name('admin.payment.list');
	 Route::get('payments/update/{id}', 'Admin\PaymentController@showForm')->name('admin.payment.update');
	 Route::post('payments/update/{id}', 'Admin\PaymentController@update');
	 Route::get('payments/delete/{id}', 'Admin\PaymentController@delete')->name('admin.payment.delete');
	 
	 Route::get('users', 'Admin\UserController@index')->name('admin.user.list');
	 Route::get('users/update/{id}', 'Admin\UserController@showForm')->name('admin.user.update');
 Route::post('users/update/{id}', 'Admin\UserController@update');
 Route::get('users/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');
 Route::get('users/add', 'Admin\UserController@addForm')->name('admin.user.add');
 Route::post('users/add', 'Admin\UserController@create');
 
 Route::get('orders', 'Admin\OrderController@index')->name('admin.order.list');
 Route::get('orders/update/{id}', 'Admin\OrderController@showForm')->name('admin.order.update');
 Route::post('orders/update/{id}', 'Admin\OrderController@update');
 Route::get('orders/delete/{id}', 'Admin\OrderController@delete')->name('admin.order.delete');
 
 //Super Admin Permission
 
 Route::group(['middleware' => 'can:isAdmin'], function () {
 	
 	
 	Route::get('admins', 'Admin\AdminController@index')->name('admin.admin.list');
 	Route::get('admins/update/{id}', 'Admin\AdminController@edit')->name('admin.admin.update');
 	Route::post('admins/update/{id}', 'Admin\AdminController@update');
 	Route::get('admins/add', 'Admin\AdminController@create')->name('admin.admin.add');
 	Route::post('admins/add', 'Admin\AdminController@store');
 	Route::get('admins/delete/{id}', 'Admin\AdminController@destroy')->name('admin.admin.delete');
 	
 	
 });
 
 
 });
 
 
});