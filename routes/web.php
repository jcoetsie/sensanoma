<?php

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:admin'], function() {
        Route::resource('account', 'AccountController');
        Route::resource('area', 'AreaController');
        Route::resource('zone', 'ZoneController');
        Route::resource('sensor_node', 'SensorNodeController');
        Route::delete('user/account/{user}', 'UserController@destroy')->name('user.destroy');
        Route::delete('user/{user}', 'UserController@viewerDestroy')->name('viewer.destroy');
    });

    Route::get('user', 'UserController@profile')->name('user.profile');
    Route::put('user' , 'UserController@update')->name('user.profile.update');
});

Auth::routes();

