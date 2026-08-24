<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\Kontak;
use Illuminate\Support\Facades\Schema;
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
        // Bagikan data $appSetting ke semua view secara global
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('app_settings')) {
                    $setting = AppSetting::getSettings();
                    $view->with('appSetting', $setting);
                }
            } catch (\Throwable $e) {
                // Ignore during migrations or build
            }
        });

        // Bagikan data $kontak ke view landing page
        View::composer(['landing-page.footer', 'landing-page.nav', 'landing-page.hero-section'], function ($view) {
            $view->with('kontak', Kontak::data());
        });
    }
}
