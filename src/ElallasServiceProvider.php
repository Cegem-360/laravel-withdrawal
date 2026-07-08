<?php

declare(strict_types=1);

namespace Cegem360\Elallas;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ElallasServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/elallas.php', 'elallas');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'elallas');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'elallas');
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/elallas.php' => $this->app->configPath('elallas.php'),
            ], 'elallas-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'elallas-migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/elallas'),
            ], 'elallas-views');

            $this->publishes([
                __DIR__.'/../lang' => $this->app->langPath('vendor/elallas'),
            ], 'elallas-lang');
        }
    }

    private function registerRoutes(): void
    {
        $config = $this->app['config']->get('elallas.route');

        Route::group([
            'prefix' => $config['prefix'],
            'middleware' => $config['middleware'],
        ], function (): void {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
}
