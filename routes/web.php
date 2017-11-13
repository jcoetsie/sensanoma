<?php

Route::get('/', 'HomeController@index')->name('home');

Route::resource('account', 'AccountController');

Auth::routes();
