<?php

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 商品関連
Route::get('/', 'IndexController')->name('index');
Route::get('/product/{id}', 'General\ProductController')->name('product_detail');

// カート関連
Route::get('/cart', 'General\CartController@index')->name('cart_index');
Route::post('/cart/add_cart', 'General\CartController@addOrEditCart')->name('cart_add_edit');
Route::post('/cart/edit_cart', 'General\CartController@editCart')->name('cart_edit');
Route::post('/cart/delete_cart/{id}', 'General\CartController@deleteCartItem')->name('cart_item_delete');

// Order関連
Route::post('/order/create', 'General\OrderController@createOrder')->name('order_create');
