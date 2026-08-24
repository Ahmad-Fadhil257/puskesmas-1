<?php

namespace App\Providers;

use App\Models\AppSetting;
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
            $setting = null;
            try {
                if (Schema::hasTable('app_settings')) {
                    $setting = AppSetting::getSettings();
                }
            } catch (\Throwable $e) {
                // Ignore during migrations or build
            }
            $view->with('appSetting', $setting);
        });
    }
}
