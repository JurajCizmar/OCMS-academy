<?php

use AppUser\User\Http\Controllers\UserController;

// REVIEW - Tip - Do group() vieš okrem 'prefix' dať ako parameter aj 'middleware', čo vlastne použije middleware pre všetky routes v groupe, to len aby si to nemusel opakovať
// REVIEW - Nikdy nepoužívaj classes takto 'AppUser\User\Http\Middleware\UserMiddleware' :D, ak sa to dá tak treba importovať pomocou use AppUser\User\Http\Middleware\UserMiddleware;

Route::group([
    'prefix' => 'user'
], function () {
    Route::post('/register', [UserController::class, 'registerNewUser']);

    Route::get('/users', [UserController::class, 'getAllUsers'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');

    Route::post('/login', [UserController::class, 'login']);

    // REVIEW - Tento unprotected endpoint by mohol znamenať že niekto by mohol odhlásiť iného usera ak vie jeho username :DD, usera treba vždy získať podľa tokenu ktorý príde
    Route::post('/logout', [UserController::class, 'logout']);

    Route::delete('/delete', [UserController::class, 'deleteUsers'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');
});