<?php

namespace Websight\L5GoogleClient;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class GoogleApiClientServiceProvider
 *
 * @author Cedric Ziel <ziel@websight.de>
 * @package Websight\L5GoogleClient
 */
class GoogleApiClientServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/google-client.php');
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('google-client.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('google-client');
        }
        $this->mergeConfigFrom($source, 'google-client');
    }

    /**
     * Get the services provided
     *
     * @return array
     */
    public function provides()
    {
        return [
            'google-client'
        ];
    }
}
