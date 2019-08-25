<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('routes')->name('routes.')->group(function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/create', 'RoutesController@create')->name('create');
        Route::post('/', 'RoutesController@store')->name('store');
    });
    Route::get('/{route}', 'RoutesController@show')->name('show');
});
