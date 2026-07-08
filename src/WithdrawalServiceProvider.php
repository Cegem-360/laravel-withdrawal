<?php

declare(strict_types=1);

namespace Cegem360\Withdrawal;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WithdrawalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/withdrawal.php', 'withdrawal');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'withdrawal');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'withdrawal');
        $this->registerRoutes();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/withdrawal.php' => $this->app->configPath('withdrawal.php'),
            ], 'withdrawal-config');

            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'withdrawal-migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/withdrawal'),
            ], 'withdrawal-views');

            $this->publishes([
                __DIR__.'/../lang' => $this->app->langPath('vendor/withdrawal'),
            ], 'withdrawal-lang');
        }
    }

    private function registerRoutes(): void
    {
        $config = $this->app['config']->get('withdrawal.route');

        // Guard against an empty/misconfigured prefix: the package routes are
        // declared at "/", so without a prefix they would hijack the host app
        // root. Fall back to the default prefix instead of grabbing "/".
        $prefix = trim((string) ($config['prefix'] ?? ''), '/');
        if ($prefix === '') {
            $prefix = 'elallasi-nyilatkozat';
        }

        Route::group([
            'prefix' => $prefix,
            'middleware' => $config['middleware'] ?? ['web'],
        ], function (): void {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }
}
