<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        tap(User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'role' => UserRoleEnum::Admin,
        ]), function (User $user) {
            $user->ownedTeams()->create([
                'user_id' => 1,
                'name' => "Test's Team",
                'personal_team' => true,
            ]);
        });
    }
}
