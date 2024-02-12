<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production' || env('ENABLE_HTTPS_SUPPORT', false) === true) {
            $this->app['request']->server->set('HTTPS','on');

            URL::forceScheme('https');
        }
    }
}
