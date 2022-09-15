<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Jobs\CreateUser;
use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Fortify\Actions\ConfirmPassword;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Users/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create', [
            'password' => Str::random(),
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $this->dispatchSync(CreateUser::fromRequest($request));

        $request->session()->flash('flash.banner', 'User created successfully.');

        return Inertia::location(route('users.index'));
    }

    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', [
            'data' => $user,
        ]);
    }

    public function destroy(DeleteUserRequest $request, StatefulGuard $guard, User $user): SymfonyResponse
    {
        $confirmed = app(ConfirmPassword::class)(
            $guard,
            $request->user(),
            $request->password()
        );

        if (! $confirmed) {
            throw ValidationException::withMessages([
                'password' => __('The password is incorrect.'),
            ]);
        }

        app(DeletesUsers::class)->delete($user);

        $request->session()->flash('flash.banner', 'User successfully deleted.');

        return Inertia::location(route('users.index'));
    }
}
