<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LecloudServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('LecloudService', function () {
            return new \App\Services\Lecloud();
        });
    }
}
