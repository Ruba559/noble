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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'facebook' => [
        'client_id' => '1525128514591058', 
        'client_secret' => 'f0ff5bfc3924d0bd0698e6ecbcd558ef', 
        'redirect' => 'https://localhost:8000/facebook/callback/'
    ],
    'google' => [
        'client_id' => '976667139775-q3cvuo7tbjd84m5ihbtmfo8jdgo4hl7m.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/callback/google',
      ], 

];
