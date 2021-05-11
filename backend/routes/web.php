<?php

Route::get('/', 'IndexController')->name('index');
Route::get('/product/{id}', 'General\ProductController')->name('product_detail');
