<?php

namespace App\Providers;

use App\Models\Kontak;
use Illuminate\Support\Facades\View;
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
        View::composer(['landing-page.footer', 'landing-page.nav', 'landing-page.hero-section'], function ($view) {
            $view->with('kontak', Kontak::data());
        });
    }
}
