<?php

use AppLogger\Logger\Http\Controllers\LoggerController;

// Route::get('/world', [LoggerController::class, 'helloworld']);

Route::group(['prefix' => 'attendance'], function (){ 

    Route::get('/logs', [LoggerController::class, 'getAllLogs']);

    // // REVIEW - Keď vytváraš nové / upravuješ existujúce položky tak sa na definovanie informácií o položke použije skôr POST typ endpointu, a informácie sú v rámci body, nie ako "/{name}"
    Route::post('/create/{name}', [LoggerController::class, 'createAttendance']);

    Route::get('/logs/{name}', [LoggerController::class, 'getStudent']);

    Route::delete('/delete', [LoggerController::class, 'deleteLogs']);
});