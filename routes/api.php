<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
])->name('api.')->group(function () {
    Route::get('/user', fn () => request()->user());

    Route::get('/users', fn () => response()->json(
        User::query()
            ->whereNot('id', request()->user()->id())
            ->paginate()
            ->appends(request()->query())
    ))->name('users.index');
});
