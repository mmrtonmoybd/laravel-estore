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
     Route::get('/', 'Admin\Dashboard@index');
     Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
 });
});