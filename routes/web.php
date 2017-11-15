<?php

Route::get('/', 'HomeController@index')->name('home');

Route::resource('account', 'AccountController');
Route::resource('area', 'AreaController');
Route::resource('zone', 'ZoneController');
Route::resource('sensor_node', 'SensorNodeController');
Route::resource('sensor_node_type', 'SensorNodeTypeController');

Auth::routes();
