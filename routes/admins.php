<?php

Route::group([
    'prefix' => 'admins',
], function () {
    Route::get('login/', 'App\Http\Controllers\Admin\Auth\LoginController@create')->middleware('guest:admin')->name('admin.login');
    Route::post('login/', 'App\Http\Controllers\Admin\Auth\LoginController@store')->middleware('guest:admin');
    Route::get('password/reset/', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@create')->middleware('guest')->name('admin.reset');
    Route::post('password/reset/email/', 'App\Http\Controllers\Admin\Auth\ForgotPasswordController@store')->middleware('guest')->name('admin.email');

    Route::get('password/reset/{token}/', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@create')->middleware('guest')->name('admin.password.reset');
    Route::post('password/reset/', 'App\Http\Controllers\Admin\Auth\ResetPasswordController@store')->middleware('guest')->name('admin.reset.update');

    //Auth middleware group route
    Route::group(['middleware' => 'adminAuth:admin'], function () {
     
        Route::get('verify-email/', 'App\Http\Controllers\Admin\Auth\EmailVerificationPromptController@__invoke')
        ->name('admin.verification.notice');

        Route::get('verify-email/{id}/{hash}/', 'App\Http\Controllers\Admin\Auth\VerifyEmailController@__invoke')
                ->middleware(['signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

        Route::post('email/verification-notification/', 'App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController@store')
                ->middleware(['throttle:6,1'])
                ->name('admin.verification.resend');
       Route::get('logout/', 'App\Http\Controllers\Admin\Auth\LoginController@destroy')->name('admin.logout');

        Route::group(['middleware' => 'adminVerified'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\Dashboard@index')->name('admin.dashboard');
        
        Route::get('confirm-password/', 'App\Http\Controllers\Admin\Auth\ConfirmablePasswordController@show')
                ->name('admin.password.confirm');

       Route::post('confirm-password/', 'App\Http\Controllers\Admin\Auth\ConfirmablePasswordController@store');
        

        // Product Route
        Route::get('products/', 'App\Http\Controllers\Admin\ProductController@index')->name('admin.product.list');
        Route::get('products/add/', 'App\Http\Controllers\Admin\ProductController@add')->name('admin.product.add');
        Route::post('products/add/', 'App\Http\Controllers\Admin\ProductController@store');
        Route::get('products/update/{id}', 'App\Http\Controllers\Admin\ProductController@showForm')->name('admin.product.update');
        Route::post('products/update/{id}', 'App\Http\Controllers\Admin\ProductController@update');
        Route::get('products/delete/{id}', 'App\Http\Controllers\Admin\ProductController@delete')->middleware('password.confirm:admin.password.confirm')->name('admin.product.delete');
        // Product Route
        // Category Route
        Route::get('categories/', 'App\Http\Controllers\Admin\CategoryController@index')->name('admin.category.list');
        Route::get('categories/add/', 'App\Http\Controllers\Admin\CategoryController@showForm')->name('admin.category.add');
        Route::post('categories/add/', 'App\Http\Controllers\Admin\CategoryController@store');
        Route::get('categories/update/{id}', 'App\Http\Controllers\Admin\CategoryController@updateForm')->name('admin.category.update');
        Route::post('categories/update/{id}', 'App\Http\Controllers\Admin\CategoryController@update');
        Route::get('categories/delete/{id}', 'App\Http\Controllers\Admin\CategoryController@delete')->middleware('password.confirm:admin.password.confirm')->name('admin.category.delete');
        // Category Route
        // Payment Route
        Route::get('payments/', 'App\Http\Controllers\Admin\PaymentController@index')->name('admin.payment.list');
        Route::get('payments/update/{id}', 'App\Http\Controllers\Admin\PaymentController@showForm')->name('admin.payment.update');
        Route::post('payments/update/{id}', 'App\Http\Controllers\Admin\PaymentController@update');
        Route::get('payments/delete/{id}', 'App\Http\Controllers\Admin\PaymentController@delete')->middleware('password.confirm:admin.password.confirm')->name('admin.payment.delete');
        // Payment Route
        // User Route
        Route::get('users/', 'App\Http\Controllers\Admin\UserController@index')->name('admin.user.list');
        Route::get('users/update/{id}', 'App\Http\Controllers\Admin\UserController@showForm')->name('admin.user.update');
        Route::post('users/update/{id}', 'App\Http\Controllers\Admin\UserController@update');
        Route::get('users/delete/{id}', 'App\Http\Controllers\Admin\UserController@delete')->name('admin.user.delete');
        Route::get('users/add/', 'App\Http\Controllers\Admin\UserController@addForm')->name('admin.user.add');
        Route::post('users/add/', 'App\Http\Controllers\Admin\UserController@create');
        // User Route
        // Order Route
        Route::get('orders/', 'App\Http\Controllers\Admin\OrderController@index')->name('admin.order.list');
        Route::get('orders/update/{id}', 'App\Http\Controllers\Admin\OrderController@showForm')->name('admin.order.update');
        Route::post('orders/update/{id}', 'App\Http\Controllers\Admin\OrderController@update');
        Route::get('orders/delete/{id}', 'App\Http\Controllers\Admin\OrderController@delete')->middleware('password.confirm:admin.password.confirm')->name('admin.order.delete');
        // Order Route
        // Comment Route
        Route::get('comments/', 'App\Http\Controllers\Admin\CommentController@index')->name('admin.comment.list');
        Route::get('comments/update/{id}', 'App\Http\Controllers\Admin\CommentController@showForm')->name('admin.comment.update');
        Route::post('comments/update/{id}', 'App\Http\Controllers\App\Http\Controllers\Admin\CommentController@update');
        Route::get('comments/delete/{id}', 'App\Http\Controllers\Admin\CommentController@delete')->name('admin.comment.delete');
        Route::post('comments/add', 'App\Http\Controllers\Admin\CommentController@store')->name('admin.comment.add');
        Route::post('comments/reply/add/', 'App\Http\Controllers\Admin\CommentController@reply')->name('admin.reply.add');
        // Comment Route
        // Profile Route
        Route::get('profile/{id}', 'App\Http\Controllers\Admin\ProfileController@index')->name('admin.profile');
        Route::get('profile/update/{id}', 'App\Http\Controllers\Admin\ProfileController@showForm')->middleware('password.confirm:admin.password.confirm')->name('admin.profile.update');
        Route::post('profile/update/{id}', 'App\Http\Controllers\Admin\ProfileController@update')->middleware('password.confirm:admin.password.confirm');
        // Profile Route
        // Invoice Route
        Route::get('invoice/{id}', 'App\Http\Controllers\Admin\Invoice@stream')->name('admin.invoice.view');
        Route::get('invoice/download/{id}', 'App\Http\Controllers\Admin\Invoice@download')->name('admin.invoice.download');
        // Invoice Route

        //Super Admin Permission

        Route::group(['middleware' => ['can:isAdmin', 'password.confirm:admin.password.confirm']], function () {
            // Admin Route
            Route::get('admins/', 'App\Http\Controllers\Admin\AdminController@index')->name('admin.admin.list');
            Route::get('admins/update/{id}', 'App\Http\Controllers\Admin\AdminController@edit')->name('admin.admin.update');
            Route::post('admins/update/{id}', 'App\Http\Controllers\Admin\AdminController@update');
            Route::get('admins/add/', 'App\Http\Controllers\Admin\AdminController@create')->name('admin.admin.add');
            Route::post('admins/add/', 'App\Http\Controllers\Admin\AdminController@store');
            Route::get('admins/delete/{id}', 'App\Http\Controllers\Admin\AdminController@destroy')->name('admin.admin.delete');
            // Admin Route
            // Settings Route
            Route::get('settings/', 'App\Http\Controllers\Admin\SettingController@index')->name('admin.setting.list');
            Route::post('settings/', 'App\Http\Controllers\Admin\SettingController@update');
            // Settings Route
            // Rating Route
            Route::get('ratings/', 'App\Http\Controllers\Admin\RatingController@index')->name('admin.rating.list');
            Route::get('rating/{id}', 'App\Http\Controllers\Admin\RatingController@delete')->name('admin.rating.delete');
            // Rating Route
            // Page Route
            Route::get('pages/', 'App\Http\Controllers\Admin\PageController@index')->name('admin.page.list');
            Route::get('pages/add/', 'App\Http\Controllers\Admin\PageController@create')->name('admin.page.add');
            Route::post('pages/add/', 'App\Http\Controllers\Admin\PageController@store');
            Route::get('pages/update/{id}', 'App\Http\Controllers\Admin\PageController@edit')->name('admin.page.update');
            Route::post('pages/update/{id}', 'App\Http\Controllers\Admin\PageController@update');
            Route::get('pages/delete/{id}', 'App\Http\Controllers\Admin\PageController@destroy')->name('admin.page.delete');
            // Page Route
            // Optimize Route
            Route::get('optimize/', 'App\Http\Controllers\Admin\OptimizeController@index')->name('admin.optimize.index');
            Route::get('optimize/add/', 'App\Http\Controllers\Admin\OptimizeController@optimize')->name('admin.optimize.add');
            Route::get('optimize/cleared/', 'App\Http\Controllers\Admin\OptimizeController@clearoptimize')->name('admin.optimize.clear');
            // Optimize Route
        });
        // end Super Admin Permission
        });

        
    });
    // end Admin Auth
});
