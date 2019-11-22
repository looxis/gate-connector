<?php

namespace Looxis\Gate;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;


class GateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'gate');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'gate');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/gate.php' => config_path('gate.php'),
            ], 'gate-config');


            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/gate'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/gate'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/gate'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/gate.php', 'gate');
        // Register the main class to use with the facade

        $this->app->resolving(Factory::class, function ($socialite) {
            $socialite->extend(
                'gate',
                function ($app) use ($socialite) {
                    $config = config_path('gate.php');
                    return $socialite->buildProvider(GateProvider::class, $config);
                }
            );
        });
    }
}
