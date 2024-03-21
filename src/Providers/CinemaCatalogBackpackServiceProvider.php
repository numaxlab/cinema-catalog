<?php

namespace NumaxLab\CinemaCatalogBackpack\Providers;

use Illuminate\Support\ServiceProvider;
use NumaxLab\CinemaCatalogBackpack\Commands\AddMenuItems;
use NumaxLab\CinemaCatalogBackpack\Commands\Install;

class CinemaCatalogBackpackServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('cinema-catalog-backpack.php'),
            __DIR__ . '/../../lang' => $this->app->langPath('vendor/cinema-catalog-backpack'),
        ]);

        $this->loadRoutesFrom(__DIR__ . '/../../routes/cinema-catalog-backpack.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'cinema-catalog-backpack');

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
            'cinema-catalog-backpack'
        );
    }


}
