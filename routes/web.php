<?php

Auth::routes(['verify' => true]);

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('activities')->name('activities.')->group(function () {
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('/create', 'ActivitiesController@create')->name('create');
        Route::post('/', 'ActivitiesController@store')->name('store');
    });
    Route::get('/{activity}', 'ActivitiesController@show')->name('show');
});
