<?php

use Illuminate\Support\Facades\Route;

Route::get(
    config('gate.auth_callback_uri', 'auth/callback'),
    config('gate.auth_callback_controller', 'App\Http\Controllers\Auth\LoginController') . '@handleProviderCallback'
);
