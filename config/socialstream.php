<?php

use JoelButcher\Socialstream\Features;
use JoelButcher\Socialstream\Providers;

return [
    'middleware' => ['web'],
    'prompt' => 'Or Login Via',
    'providers' => [
        // Providers::bitbucket(),
        // Providers::facebook(),
        Providers::github(),
        // Providers::gitlab(),
        // Providers::google(),
        // Providers::linkedin(),
        // Providers::linkedinOpenId(),
        // Providers::slack(),
        // Providers::twitterOAuth1(),
        // Providers::twitterOAuth2(),
    ],
    'features' => [
        Features::createAccountOnFirstLogin(),
        Features::loginOnRegistration(),
        Features::providerAvatars(),
        Features::rememberSession(),
        Features::providerAvatars(),
        Features::refreshOAuthTokens(),
    ],
];
