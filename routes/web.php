<?php

Route::prefix('routes')->name('routes.')->group(function() {
    Route::get('/{route}', 'RoutesController@show');
});

