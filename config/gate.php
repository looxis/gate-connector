<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'enabled'                   => env('GATE_ENABLED', true),
    'url'                       => env('GATE_URL'),
    'client_id'                 => env('GATE_CLIENT_ID'),
    'client_secret'             => env('GATE_CLIENT_SECRET'),
    'redirect'                  => env('GATE_REDIRECT_URL',  env('APP_URL') . '/auth/callback'),
    'authorize_url'             => env('GATE_AUTHORIZE_URL',  env('GATE_URL') . '/oauth/authorize'),
    'token_url'                 => env('GATE_TOKEN_URL', env('GATE_URL') . '/oauth/token'),
    'user_url'                  => env('GATE_USER_URL', env('GATE_URL') . '/api/user'),
    'auth_callback_uri'         => env('GATE_AUTH_CALLBACK_URI', 'auth/callback'),
    'auth_callback_controller'  => env('GATE_AUTH_CALLBACK_CONTROLLER', 'App\Http\Controllers\Auth\LoginController'),
];
