<?php

Route::apiResource('/courses', 'Backend\CoursesController', ['as' => 'admin']);
Route::get('/categories/create', 'Backend\CategoriesController@create');
Route::apiResource('/categories', 'Backend\CategoriesController', ['as' => 'admin']);
Route::get('/contents/create', 'Backend\ContentsController@create');
Route::apiResource('/contents', 'Backend\ContentsController', ['as' => 'admin']);
