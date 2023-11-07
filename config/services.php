<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'envoyer' => [
        'heartbeats' => [
            'refresh-database' => env('ENVOYER_HB_REFRESH_DATABASE')
        ],
    ],

    'bitbucket' => [
        'client_id' => env('BITBUCKET_CLIENT_ID'),
        'client_secret' => env('BITBUCKET_CLIENT_SECRET'),
        'redirect' => env('BITBUCKET_REDIRECT_URL'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URL'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_REDIRECT_URL'),
    ],

    'gitlab' => [
        'client_id' => env('GITLAB_CLIENT_ID'),
        'client_secret' => env('GITLAB_CLIENT_SECRET'),
        'redirect' => env('GITLAB_REDIRECT_URL'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL'),
    ],

    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_REDIRECT_URL'),
    ],

    'linkedin-openid' => [
        'client_id' => env('LINKEDIN_OPENID_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_OPENID_CLIENT_SECRET'),
        'redirect' => env('LINKEDIN_OPENID_REDIRECT_URL'),
    ],

    'slack' => [
        'client_id' => env('SLACK_CLIENT_ID'),
        'client_secret' => env('SLACK_CLIENT_SECRET'),
        'redirect' => env('SLACK_REDIRECT_URL'),
        'webhook' => env('SLACK_WEBHOOK'),
        'scopes' => [
            'identity.avatar', 'identity.basic', 'identity.email',
            'identity.team', 'openid', 'identify',
            'chat.write'
        ],
    ],

    'twitter' => [
        'client_id' => env('TWITTER_OAUTH1_CONSUMER_KEY'),
        'client_secret' => env('TWITTER_OAUTH1_CONSUMER_SECRET'),
        'redirect' => env('TWITTER_OAUTH1_REDIRECT_URL'),
    ],

    'twitter-oauth-2' => [
        'client_id' => env('TWITTER_OAUTH2_CLIENT_ID'),
        'client_secret' => env('TWITTER_OAUTH2_CLIENT_SECRET'),
        'redirect' => env('TWITTER_OAUTH2_REDIRECT_URL'),
    ],

    'apple' => [
        'team_id' => env('APPLE_TEAM_ID'),
        'key_id' => env('APPLE_KEY_ID'),
        'private_key' => env('APPLE_PRIVATE_KEY'),
        'client_id' => env('APPLE_CLIENT_ID'),
        'client_secret' => null,
        'redirect' => env('APPLE_REDIRECT_URL'),
    ],
];
