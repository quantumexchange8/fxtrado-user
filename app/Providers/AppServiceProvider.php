<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

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
        $locale = Session::get('locale', 'en'); // Default to 'en' if not set
        App::setLocale($locale);

        if (App::environment('production')) {
            resolve(\Illuminate\Routing\UrlGenerator::class)->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
