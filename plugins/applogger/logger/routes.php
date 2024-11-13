<?php

use AppLogger\Logger\Http\Controllers\LoggerController;
use AppUser\User\Http\Middleware\UserMiddleware;

Route::group([
    'prefix' => 'attendance',
    'middleware' => UserMiddleware::class
], function () {
    Route::get('/logs', [LoggerController::class, 'getAllLogs']);

    Route::post('/create', [LoggerController::class, 'createAttendance']);

    Route::get('/logs/{name}', [LoggerController::class, 'getStudent']);

    Route::delete('/delete', [LoggerController::class, 'deleteLogs']);
});