<?php

namespace NumaxLab\CinemaCatalog\Providers;

use Illuminate\Support\ServiceProvider;
use NumaxLab\CinemaCatalog\Commands\Install;

class CinemaCatalogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('backpack/cinema-catalog.php'),
            __DIR__ . '/../../lang' => $this->app->langPath('vendor/cinema-catalog'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../../routes/cinema-catalog.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'cinema-catalog');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'cinema-catalog'
        );
    }
}
