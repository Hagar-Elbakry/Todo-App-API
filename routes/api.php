<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::controller(AuthController::class)->group(function () {
    Route::prefix('auth')->as('auth.')->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');

        Route::middleware('auth:api')->group(function () {
            Route::get('/profile', 'profile')->name('profile');
        });
    });
});
