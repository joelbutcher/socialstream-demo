<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
])->name('api.')->group(function () {
    Route::get('/user', fn () => request()->user());
});
