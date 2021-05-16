<?php

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin_login');
Route::post('/admin/login', 'Auth\AdminLoginController@login');

// ユーザ登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 商品関連
Route::get('/', 'IndexController')->name('index');
Route::get('/product/{id}', 'General\ProductController')->name('product_detail');

// カート関連
Route::group(['prefix' => 'cart', 'middleware' => ['auth']], function () {
    Route::get('/', 'General\CartController@index')->name('cart_index');
    Route::post('/add_cart', 'General\CartController@addOrEditCart')->name('cart_add_edit');
    Route::post('/edit_cart', 'General\CartController@editCart')->name('cart_edit');
    Route::post('/delete_cart/{id}', 'General\CartController@deleteCartItem')->name('cart_item_delete');
});

// Order関連
Route::group(['middleware' => ['auth']], function () {
    Route::post('/order/create', 'General\OrderController@createOrder')->name('order_create');
});

// 管理側
Route::group(['prefix' => 'admin', 'middleware' => ['auth_admin']], function () {
    Route::get('/', 'Admin\IndexController')->name('admin_index');
    // 商品関連
    Route::prefix('product')->group(function () {
        Route::get('/', 'Admin\ProductController@index')->name('admin_product_index');
        Route::get('/create', 'Admin\ProductController@create')->name('admin_product_create');
        Route::post('/store', 'Admin\ProductController@store')->name('admin_product_store');
        Route::get('/detail/{id}', 'Admin\ProductController@detail')->name('admin_product_detail');
        Route::post('/detail/{id}', 'Admin\ProductController@update')->name('admin_product_detail_update');
        Route::delete('/detail/{id}', 'Admin\ProductController@delete')->name('admin_product_detail_delete');
    });
    // タグ関連
    Route::prefix('tag')->group(function () {
        Route::get('/', 'Admin\TagController@index')->name('admin_tag_index');
        Route::get('/create', 'Admin\TagController@create')->name('admin_tag_create');
        Route::post('/store', 'Admin\TagController@store')->name('admin_tag_store');
        Route::get('/detail/{id}', 'Admin\TagController@detail')->name('admin_tag_detail');
        Route::post('/detail/{id}', 'Admin\TagController@update')->name('admin_tag_detail_update');
        Route::delete('/detail/{id}', 'Admin\TagController@delete')->name('admin_tag_detail_delete');
    });
    // 受注関連
    Route::prefix('order')->group(function () {
        Route::get('/', 'Admin\OrderController@index')->name('admin_order_index');
    });
});
