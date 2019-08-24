<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('routes')->name('routes.')->group(function () {
    Route::get('/{route}', 'RoutesController@show')->name('show');
});
