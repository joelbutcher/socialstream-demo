<?php

namespace App\Actions\Socialstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use JoelButcher\Socialstream\Contracts\CreatesConnectedAccounts;
use JoelButcher\Socialstream\Contracts\CreatesUserFromProvider;
use JoelButcher\Socialstream\Socialstream;
use Laravel\Jetstream\Jetstream;
use Laravel\Socialite\Contracts\User as ProviderUser;

class CreateUserFromProvider implements CreatesUserFromProvider
{
    /**
     * The creates connected accounts instance.
     *
     * @var \JoelButcher\Socialstream\Contracts\CreatesConnectedAccounts
     */
    public $createsConnectedAccounts;

    /**
     * Create a new action instance.
     *
     * @param  \JoelButcher\Socialstream\Contracts\CreatesConnectedAccounts  $createsConnectedAccounts
     */
    public function __construct(CreatesConnectedAccounts $createsConnectedAccounts)
    {
        $this->createsConnectedAccounts = $createsConnectedAccounts;
    }

    /**
     * Create a new user from a social provider user.
     *
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $providerUser
     * @return \App\Models\User
     */
    public function create(string $provider, ProviderUser $providerUser)
    {
        return DB::transaction(function () use ($provider, $providerUser) {
            return tap(User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
            ]), function (User $user) use ($provider, $providerUser) {
                $user->markEmailAsVerified();

                if (Socialstream::hasProviderAvatarsFeature() && Jetstream::managesProfilePhotos() && $providerUser->getAvatar()) {
                    $user->setProfilePhotoFromUrl($providerUser->getAvatar());
                }

                $user->switchConnectedAccount(
                    $this->createsConnectedAccounts->create($user, $provider, $providerUser)
                );

                $user->switchTeam(
                    $this->createTeam($user)
                );
            });
        });
    }

    protected function createTeam(User $user): Team
    {
        return tap(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]), fn (Team $team) => $user->ownedTeams()->save($team));
    }
}
