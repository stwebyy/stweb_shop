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

Route::group(['prefix' => 'admin', 'middleware' => ['auth_admin']], function () {
    Route::get('/', 'Admin\IndexController')->name('admin_index');
    Route::prefix('product')->group(function () {
        Route::get('/', 'Admin\ProductController@index')->name('admin_product_index');
        Route::get('/detail/{id}', 'Admin\ProductController@detail')->name('admin_product_detail');    
    });
});