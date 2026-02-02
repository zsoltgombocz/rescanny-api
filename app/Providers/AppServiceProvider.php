<?php

namespace App\Providers;

use App\Domains\Localization\SupportedLocalesRepository;
use App\Middlewares\TranslateableThrottleRequests;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SupportedLocalesRepository::class, SupportedLocalesRepository::class);
        $this->app->bind(ThrottleRequests::class, TranslateableThrottleRequests::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
