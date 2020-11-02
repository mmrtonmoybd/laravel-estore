<?php

Route::group([
    'prefix' => 'admins',
], function () {
    Route::get('login/', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login/', 'Admin\LoginController@login');
    Route::get('password/reset/', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.reset');
    Route::post('password/reset/email/', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.email');

    Route::get('password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset/', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');

    //Auth middleware group route
    Route::group(['middleware' => 'adminAuth:admin'], function () {
        Route::get('/', 'Admin\Dashboard@index')->name('admin.dashboard');

        Route::get('logout/', 'Admin\LoginController@logout')->name('admin.logout');

        // Product Route
        Route::get('products/', 'Admin\ProductController@index')->name('admin.product.list');
        Route::get('products/add/', 'Admin\ProductController@add')->name('admin.product.add');
        Route::post('products/add/', 'Admin\ProductController@store');
        Route::get('products/update/{id}', 'Admin\ProductController@showForm')->name('admin.product.update');
        Route::post('products/update/{id}', 'Admin\ProductController@update');
        Route::get('products/delete/{id}', 'Admin\ProductController@delete')->name('admin.product.delete');
        // Product Route
        // Category Route
        Route::get('categories/', 'Admin\CategoryController@index')->name('admin.category.list');
        Route::get('categories/add/', 'Admin\CategoryController@showForm')->name('admin.category.add');
        Route::post('categories/add/', 'Admin\CategoryController@store');
        Route::get('categories/update/{id}', 'Admin\CategoryController@updateForm')->name('admin.category.update');
        Route::post('categories/update/{id}', 'Admin\CategoryController@update');
        Route::get('categories/delete/{id}', 'Admin\CategoryController@delete')->name('admin.category.delete');
        // Category Route
        // Payment Route
        Route::get('payments/', 'Admin\PaymentController@index')->name('admin.payment.list');
        Route::get('payments/update/{id}', 'Admin\PaymentController@showForm')->name('admin.payment.update');
        Route::post('payments/update/{id}', 'Admin\PaymentController@update');
        Route::get('payments/delete/{id}', 'Admin\PaymentController@delete')->name('admin.payment.delete');
        // Payment Route
        // User Route
        Route::get('users/', 'Admin\UserController@index')->name('admin.user.list');
        Route::get('users/update/{id}', 'Admin\UserController@showForm')->name('admin.user.update');
        Route::post('users/update/{id}', 'Admin\UserController@update');
        Route::get('users/delete/{id}', 'Admin\UserController@delete')->name('admin.user.delete');
        Route::get('users/add/', 'Admin\UserController@addForm')->name('admin.user.add');
        Route::post('users/add/', 'Admin\UserController@create');
        // User Route
        // Order Route
        Route::get('orders/', 'Admin\OrderController@index')->name('admin.order.list');
        Route::get('orders/update/{id}', 'Admin\OrderController@showForm')->name('admin.order.update');
        Route::post('orders/update/{id}', 'Admin\OrderController@update');
        Route::get('orders/delete/{id}', 'Admin\OrderController@delete')->name('admin.order.delete');
        // Order Route
        // Comment Route
        Route::get('comments/', 'Admin\CommentController@index')->name('admin.comment.list');
        Route::get('comments/update/{id}', 'Admin\CommentController@showForm')->name('admin.comment.update');
        Route::post('comments/update/{id}', 'Admin\CommentController@update');
        Route::get('comments/delete/{id}', 'Admin\CommentController@delete')->name('admin.comment.delete');
        Route::post('comments/add', 'Admin\CommentController@store')->name('admin.comment.add');
        Route::post('comments/reply/add/', 'Admin\CommentController@reply')->name('admin.reply.add');
        // Comment Route
        // Profile Route
        Route::get('profile/{id}', 'Admin\ProfileController@index')->name('admin.profile');
        Route::get('profile/update/{id}', 'Admin\ProfileController@showForm')->name('admin.profile.update');
        Route::post('profile/update/{id}', 'Admin\ProfileController@update');
        // Profile Route
        // Invoice Route
        Route::get('invoice/{id}', 'Admin\Invoice@stream')->name('admin.invoice.view');
        Route::get('invoice/download/{id}', 'Admin\Invoice@download')->name('admin.invoice.download');
        // Invoice Route

        //Super Admin Permission

        Route::group(['middleware' => 'can:isAdmin'], function () {
            // Admin Route
            Route::get('admins/', 'Admin\AdminController@index')->name('admin.admin.list');
            Route::get('admins/update/{id}', 'Admin\AdminController@edit')->name('admin.admin.update');
            Route::post('admins/update/{id}', 'Admin\AdminController@update');
            Route::get('admins/add/', 'Admin\AdminController@create')->name('admin.admin.add');
            Route::post('admins/add/', 'Admin\AdminController@store');
            Route::get('admins/delete/{id}', 'Admin\AdminController@destroy')->name('admin.admin.delete');
            // Admin Route
            // Settings Route
            Route::get('settings/', 'Admin\SettingController@index')->name('admin.setting.list');
            Route::post('settings/', 'Admin\SettingController@update');
            // Settings Route
            // Rating Route
            Route::get('ratings/', 'Admin\RatingController@index')->name('admin.rating.list');
            Route::get('rating/{id}', 'Admin\RatingController@delete')->name('admin.rating.delete');
            // Rating Route
            // Page Route
            Route::get('pages/', 'Admin\PageController@index')->name('admin.page.list');
            Route::get('pages/add/', 'Admin\PageController@create')->name('admin.page.add');
            Route::post('pages/add/', 'Admin\PageController@store');
            Route::get('pages/update/{id}', 'Admin\PageController@edit')->name('admin.page.update');
            Route::post('pages/update/{id}', 'Admin\PageController@update');
            Route::get('pages/delete/{id}', 'Admin\PageController@destroy')->name('admin.page.delete');
            // Page Route
            // Optimize Route
            Route::get('optimize/', 'Admin\OptimizeController@index')->name('admin.optimize.index');
            Route::get('optimize/add/', 'Admin\OptimizeController@optimize')->name('admin.optimize.add');
            Route::get('optimize/cleared/', 'Admin\OptimizeController@clearoptimize')->name('admin.optimize.clear');
            // Optimize Route
        });
        // end Super Admin Permission
    });
    // end Admin Auth
});
