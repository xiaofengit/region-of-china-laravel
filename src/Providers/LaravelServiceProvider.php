<?php
namespace Xiaofengit\RegionOfChina\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application service.
     * 
     * @return voild
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations')
        ], 'region-of-china-migrations');

        $this->publishes([
            __DIR__ . '/../../database/seeders' => database_path('seeders')
        ], 'region-of-china-seeders');

        $this->publishes([
            __DIR__ . '/../Models' => app_path('Models')
        ]);
    }
}