<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'payment_gateway' => [
        'my_fatoorah' => [
            'payment_mode' => env('MY_FATOORAH_MODE','test_mode'),
            'test_mode' => [
                'API_KEY' => env('MY_FATOORAH_API_KEY',null),
                'API_KEY_RECURRING' => env('MY_FATOORAH_API_KEY_RECURRING'),
            ],
            'live_mode' => [
                'API_KEY' => env('MY_FATOORAH_API_KEY'),
                'API_KEY_RECURRING' => env('MY_FATOORAH_API_KEY_RECURRING'),
            ],
        ]
    ]
];
