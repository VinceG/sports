<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function () {
    Route::post('login', 'AuthController@login');
});

Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

    Route::group(['prefix' => 'team'], function() {
        Route::post('/', 'TeamController@create');
        Route::put('/{team}', 'TeamController@update');
        Route::get('/', 'TeamController@list');
        Route::get('/{id}', 'TeamController@view');
    });

    Route::group(['prefix' => 'player'], function() {
        Route::post('/', 'PlayerController@create');
        Route::put('/{player}', 'PlayerController@update');
        Route::get('/', 'PlayerController@list');
        Route::get('/{id}', 'PlayerController@view');
    });
});
