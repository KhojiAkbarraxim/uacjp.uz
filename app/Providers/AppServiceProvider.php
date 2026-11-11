<?php

namespace App\Providers;

use Anthropic\Client;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bound rather than constructed inline so tests can swap in a fake
        // without ever reaching the network.
        $this->app->singleton(Client::class, fn () => new Client(
            apiKey: config('services.anthropic.key'),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('site', config('uac.site'));
        View::share('navigation', config('uac.navigation'));
    }
}
