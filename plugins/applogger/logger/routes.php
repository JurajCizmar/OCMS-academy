<?php

use AppLogger\Logger\Http\Controllers\LoggerController;

Route::group([
    'prefix' => 'attendance'
], function () {
    Route::get('/logs', [LoggerController::class, 'getAllLogs'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');

    Route::post('/create', [LoggerController::class, 'createAttendance'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');

    Route::get('/logs/{name}', [LoggerController::class, 'getStudent'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');

    Route::delete('/delete', [LoggerController::class, 'deleteLogs'])
        ->middleware('AppUser\User\Http\Middleware\UserMiddleware');
});