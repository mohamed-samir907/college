<?php

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::prefix('admin')->group(function () {
        # Logout Route
        Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');

        # Home Routes
        Route::get('/home', 'HomeController@index')->name('admin.home');

        Route::get('/{any}', 'HomeController@index')->where('any', '.*');
    });
});
