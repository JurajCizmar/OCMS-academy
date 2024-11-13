<?php

use AppUser\User\Http\Controllers\UserController;
use AppUser\User\Http\Middleware\UserMiddleware;

// REVIEW - Tip - Do group() vieš okrem 'prefix' dať ako parameter aj 'middleware',
//čo vlastne použije middleware pre všetky routes v groupe, to len aby si to nemusel opakovať


Route::group([
    'prefix' => 'user'
], function () {
    Route::post('/register', [UserController::class, 'registerNewUser']);

    Route::post('/login', [UserController::class, 'login']);


    Route::get('/users', [UserController::class, 'getAllUsers'])
        ->middleware(UserMiddleware::class);

    Route::post('/logout', [UserController::class, 'logout'])
        ->middleware(UserMiddleware::class);

    Route::delete('/delete', [UserController::class, 'deleteUsers'])
        ->middleware(UserMiddleware::class);
});