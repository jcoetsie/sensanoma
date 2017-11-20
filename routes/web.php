<?php

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:admin'], function() {
        Route::resource('account', 'AccountController')->except('index', 'show');
        Route::resource('area', 'AreaController')->except('index', 'show');
        Route::resource('zone', 'ZoneController')->except('index', 'show');
        Route::resource('sensor_node', 'SensorNodeController')->except('index', 'show');
    });

    Route::group(['middleware' => 'role:viewer|admin'], function() {
        Route::resource('account', 'AccountController')->only('index', 'show');
        Route::resource('area', 'AreaController')->only('index', 'show');
        Route::resource('zone', 'ZoneController')->only('index', 'show');
        Route::resource('sensor_node', 'SensorNodeController')->only('index', 'show');
    });

});

Auth::routes();
