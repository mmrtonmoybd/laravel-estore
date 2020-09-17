<?php
Route::group([
'prefix' => 'admins',
], function () {
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
 Route::post('login', 'Admin\LoginController@login');
 
 //Auth middleware group route
 Route::group(['middleware' => 'adminAuth:admin'], function () {
     Route::get('/', 'Admin\Dashboard@index');
     Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
 });
});