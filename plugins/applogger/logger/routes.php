<?php

use AppLogger\Logger\Controllers\Attendance;

Route::get('/world', [Attendance::class, 'helloworld']);

Route::get('/attendance/logs', [Attendance::class, 'getAllLogs']);

Route::get('/attendance/create/{name}', [Attendance::class, 'createAttendance']);

Route::get('/attendance/logs/{name}', [Attendance::class, 'getStudent']);

Route::get('/attendance/delete', [Attendance::class, 'deleteLogs']);