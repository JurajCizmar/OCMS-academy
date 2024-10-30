<?php

use AppLogger\Logger\Controllers\Attendance;

// REVIEW - Tip - môžeš si pozrieť ako sa používa v Laravel "group()", budeš tak mať prehladnejšie routes
Route::get('/world', [Attendance::class, 'helloworld']);

Route::get('/attendance/logs', [Attendance::class, 'getAllLogs']);

// REVIEW - Keď vytváraš nové / upravuješ existujúce položky tak sa na definovanie informácií o položke použije skôr POST typ endpointu, a informácie sú v rámci body, nie ako "/{name}"
Route::get('/attendance/create/{name}', [Attendance::class, 'createAttendance']);

Route::get('/attendance/logs/{name}', [Attendance::class, 'getStudent']);

// REVIEW - Tu by sa podobne hodil skôr DELETE endpoint typ
Route::get('/attendance/delete', [Attendance::class, 'deleteLogs']);