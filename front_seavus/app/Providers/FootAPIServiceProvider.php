<?php

namespace App\Providers;

use App\Lib\FootAPI;
use Illuminate\Support\ServiceProvider;

class FootAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Lib\FootAPI', function ($app) {
            return new FootAPI();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
