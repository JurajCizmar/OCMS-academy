<?php

use AppUser\User\Http\Controllers\UserController;

Route::group([
    'prefix' => 'user'
], function () {
    Route::post('/register', [UserController::class, 'registerNewUser']);

    Route::get('/users', [UserController::class, 'getAllUsers'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');

    Route::post('/login', [UserController::class, 'login']);

    Route::post('/logout', [UserController::class, 'logout']);

    Route::delete('/delete', [UserController::class, 'deleteUsers'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');
});