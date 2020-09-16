<?php
Route::group([
'prefix' => 'admins',
], function () {
	Route::view('dashboard', 'admin.index');
});