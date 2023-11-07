<?php

namespace App\Actions\Socialstream;

use App\Services\Apple\AppleToken;
use JoelButcher\Socialstream\Contracts\ResolvesSocialiteUsers;
use JoelButcher\Socialstream\Socialstream;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;

class ResolveSocialiteUser implements ResolvesSocialiteUsers
{
    public function __construct(
        private readonly AppleToken $appleToken
    ) {
        //
    }

    /**
     * Resolve the user for a given provider.
     */
    public function resolve(string $provider): User
    {
        config()->set('services.apple.client_secret', $this->appleToken->generate());

        $user = Socialite::driver($provider)->user();

        if (Socialstream::generatesMissingEmails()) {
            $user->email = $user->getEmail() ?? ("{$user->id}@{$provider}".config('app.domain'));
        }

        config()->set('services.apple.client_secret', null);

        return $user;
    }
}
