<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        tap(User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]), function (User $user) {
            $user->ownedTeams()->create([
                'user_id' => 1,
                'name' => "Test's Team",
                'personal_team' => true,
            ]);
        });
    }
}
