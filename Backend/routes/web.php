<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/version', function () {
    return response()->json(['Laravel' => app()->version()]);
});

require __DIR__.'/auth.php';
