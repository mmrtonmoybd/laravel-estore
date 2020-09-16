<?php
Route::group([
'prefix' => 'admins',
], function () {
	Route::view('/', 'admin.index');
	Route::view('login', 'admin.auth.login');
});