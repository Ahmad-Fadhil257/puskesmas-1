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
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.custom');

        // Bagikan data $appSetting dan $navLayanans ke semua view secara global
        View::composer('*', function ($view) {
            $setting = null;
            $navLayanans = collect();
            try {
                if (Schema::hasTable('app_settings')) {
                    $setting = AppSetting::getSettings();
                }
                if (Schema::hasTable('layanans')) {
                    $navLayanans = \App\Models\Layanan::where('is_active', true)->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
                }
            } catch (\Throwable $e) {
                // Ignore during migrations or build
            }
            $view->with('appSetting', $setting)
                 ->with('navLayanans', $navLayanans);
        });
    }
}
