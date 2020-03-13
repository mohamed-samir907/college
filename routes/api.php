<?php

Route::prefix('oauth')->group(function() {

    # Authentication Routes
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    
});

Route::middleware('auth:api')->group(function() {

    Route::prefix('oauth')->group(function() {
        Route::post('logout', 'Auth\LoginController@logout');
        Route::get('me', 'Auth\LoginController@user');
    });

    Route::middleware('must_pay')->group(function () {
        // 
    });
});