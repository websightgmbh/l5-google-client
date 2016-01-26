<?php

/*
 * This file is part of L5 Google Client
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Websight\L5GoogleClient;

use Google_Client;
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
        $this->registerFactory($this->app);
        $this->registerManager($this->app);
        $this->registerBindings($this->app);
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
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    private function registerFactory($app)
    {
        $app->singleton('google-client.factory', function ($app) {
            return new GoogleClientFactory();
        });
        $app->alias('google-client.factory', GoogleClientFactory::class);
    }

    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    private function registerManager($app)
    {
        $app->singleton('google-client', function ($app) {
            $config = $app['config'];
            $factory = $app['google-client.factory'];

            return new GoogleClientManager($config, $factory);
        });
        $app->alias('google-client', GoogleClientManager::class);
    }

    /**
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    private function registerBindings($app)
    {
        $app->bind('google-client.connection', function ($app) {
            $manager = $app['google-client'];

            return $manager->connection();
        });
        $app->alias('google-client.connection', Google_Client::class);
    }

    /**
     * Get the services provided
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'google-client.factory',
            'google-client',
            'google-client.connection'
        ];
    }

}
