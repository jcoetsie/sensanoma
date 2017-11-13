<?php

Route::get('/', 'HomeController@index')->name('home');

Route::resource('account', 'AccountController');
Route::resource('area', 'AreaController');
Route::resource('zone', 'ZoneController');

Auth::routes();
