<?php

use AppLogger\Logger\Http\Controllers\LoggerController;

// REVIEW - Tu platí to isté čo som písal v appuser routes.php
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