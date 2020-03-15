<?php

Route::get('courses', 'API\EndpointsController@courses');
Route::get('contents/{categoryId}', 'API\EndpointsController@contents');