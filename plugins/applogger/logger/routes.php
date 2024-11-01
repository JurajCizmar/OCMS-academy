<?php

use AppLogger\Logger\Http\Controllers\LoggerController;

Route::group([
    'prefix' => 'attendance'
], function () {
    Route::get('/logs', [LoggerController::class, 'getAllLogs']);

    Route::post('/create', [LoggerController::class, 'createAttendance']);

    Route::get('/logs/{name}', [LoggerController::class, 'getStudent']);

    Route::delete('/delete', [LoggerController::class, 'deleteLogs']);
});