<?php

Route::get('/', 'IndexController')->name('index');
Route::get('/product/{id}', 'General\ProductController')->name('product_detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ登録
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

