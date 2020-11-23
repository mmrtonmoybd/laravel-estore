<?php

Route::group([
    'prefix' => 'users',
], function () {
    Route::get('login/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login/', 'Auth\LoginController@login');

    Route::get('register/', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register/', 'Auth\RegisterController@register');

    Route::post('logout/', 'Auth\LoginController@logout')->name('logout');

    Route::get('password/reset/', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email/', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset/', 'Auth\ResetPasswordController@reset')->name('password.update');

    Route::get('password/confirm/', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm/', 'Auth\ConfirmPasswordController@confirm');

    Route::get('email/verify/', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend/', 'Auth\VerificationController@resend')->name('verification.resend');

    Route::get('profile/{id}', 'UserProfile@index');

    Route::group([
        'middleware' => 'auth',
    ], function () {
        Route::get('profile/update/{id}', 'UserProfile@showInForm')->name('profile.update');
        Route::post('profile/update/{id}', 'UserProfile@update');

        Route::post('comment/', 'CommentController@store')->name('user.comment');
        Route::post('reply/', 'CommentController@reply')->name('user.reply');

        Route::get('comment/edit/{id}', 'CommentController@comedit')->name('com.edit');
        Route::post('comment/edit/{id}', 'CommentController@comeditp');
        Route::get('comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

        Route::get('orders/', 'OrderInfo@index');

        Route::get('checkout/', 'Checkout@index')->name('checkout');
        Route::post('checkout/', 'Checkout@checkout');

        Route::get('orders/{id}', 'OrderInfo@orders')->name('users.order');

        Route::post('rating/', 'RatingController@store')->name('rating');
    });
});
