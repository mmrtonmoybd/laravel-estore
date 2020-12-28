<?php

Route::group([
    'prefix' => 'users',
], function () {
    /*
    Route::get('login/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login/', 'App\Http\Controllers\Auth\LoginController@login');

    Route::get('register/', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register/', 'App\Http\Controllers\Auth\RegisterController@register');

    Route::post('logout/', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

    Route::get('password/reset/', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email/', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset/', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

    Route::get('password/confirm/', 'App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm/', 'App\Http\Controllers\Auth\ConfirmPasswordController@confirm');

    Route::get('email/verify/', 'App\Http\Controllers\Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend/', 'App\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend');

    */

    require __DIR__.'/auth.php';

    Route::get('profile/{id}', 'App\Http\Controllers\UserProfile@index');

    Route::group([
        'middleware' => ['auth', 'verified'],
    ], function () {
        Route::get('profile/update/{id}', 'App\Http\Controllers\UserProfile@showInForm')->name('profile.update');
        Route::post('profile/update/{id}', 'App\Http\Controllers\UserProfile@update');

        Route::post('comment/', 'App\Http\Controllers\CommentController@store')->name('user.comment');
        Route::post('reply/', 'App\Http\Controllers\CommentController@reply')->name('user.reply');

        Route::get('comment/edit/{id}', 'App\Http\Controllers\CommentController@comedit')->name('com.edit');
        Route::post('comment/edit/{id}', 'App\Http\Controllers\CommentController@comeditp');
        Route::get('comment/delete/{id}', 'App\Http\Controllers\CommentController@delete')->name('comment.delete');

        Route::get('orders/', 'App\Http\Controllers\OrderInfo@index');

        Route::get('checkout/', 'App\Http\Controllers\Checkout@index')->middleware('throttle:3,1')->name('checkout');
        Route::post('checkout/', 'App\Http\Controllers\Checkout@checkout')->middleware('throttle:3,1');

        Route::get('orders/{id}', 'App\Http\Controllers\OrderInfo@orders')->name('users.order');

        Route::post('rating/', 'App\Http\Controllers\RatingController@store')->name('rating');
    });
});
