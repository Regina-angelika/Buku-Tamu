<?php

namespace Bageur\BukuTamu;

use Illuminate\Support\ServiceProvider;

class BukuTamuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // include __DIR__.'/routes/web.php';
        $this->app->make('Bageur\BukuTamu\BukuTamuController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migration');
    }
}
