<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api')->prefix('v1')->group(function () {
    // Public
    Route::post('/login', 'AuthController@login')->name('api.auth.login.post');
    Route::get('/login', 'AuthController@noLogged')->name('login');

    // Private
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::get('/gif/search', 'GiphyController@search')->name('api.giphy.search');
    });
});
