<?php

use App\Models\Team;
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

    Route::get('/teams', fn () => response()->json(
        Team::query()
            ->select(['teams.*'])
            ->leftJoin('team_user', 'teams.id', '=', 'team_user.team_id')
            ->where('teams.user_id', request()->user()->id)
            ->orWhere('team_user.user_id', request()->user()->id)
            ->paginate()
            ->appends(request()->query())
    ))->name('teams.index');
});
