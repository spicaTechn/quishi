<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook'=>[
        'client_id'     => '329306574325808',
        'client_secret' => 'a5f990aaaf80ab9134b40f01a968553d',
        'redirect'      =>'https://beta.quishi.com/auth/facebook/callback' 
    ],
    'google'  => [
        'client_id'     =>'449673564716-vg56ts63lu999do665e9skb1die7hehl.apps.googleusercontent.com' ,
        'client_secret' =>'WNE5IJcBWltrVbfdFHWNpx6T' ,
        'redirect'      =>'https://beta.quishi.com/auth/google/callback'
    ]

];
