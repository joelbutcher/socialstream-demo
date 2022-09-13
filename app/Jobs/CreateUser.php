<?php

namespace App\Jobs;

use App\Http\Requests\CreateUserRequest;
use App\Models\Team;
use App\Models\User;
use App\Notifications\SendPasswordNotification;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    use Dispatchable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password,
    ) {
        //
    }

    public static function fromRequest(CreateUserRequest $request): self
    {
        return new self(
            $request->firstName(),
            $request->lastName(),
            $request->email(),
            $request->password(),
        );
    }

    public function handle(): void
    {
        tap(User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]), function (User $user) {
            $this->createTeam($user);
            $user->notify(new SendPasswordNotification($this->password));
        });
    }

    private function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => "{$user->first_name}'s Team",
            'personal_team' => true,
        ]));
    }
}
