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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Optimize queries globally
        \Illuminate\Database\Eloquent\Model::preventLazyLoading(!app()->isProduction());

        // Prod caching bootstrap
        if (app()->isProduction()) {
            $this->app->booted(function () {
                \Illuminate\Support\Facades\Artisan::call('route:cache');
                \Illuminate\Support\Facades\Artisan::call('config:cache');
            });
        }

        // Global stats cache - disabled in boot to speed Railway build (use controllers)
        // if (extension_loaded('redis')) {
        //     try {
        //         \Cache::rememberForever('app_stats', function () {
        //             return [
        //                 'total_users' => \App\Models\User::count(),
        //                 'total_rooms' => \App\Models\CompanyRoom::count(),
        //                 'total_cars' => \App\Models\CompanyCar::count(),
        //                 'total_absences' => \App\Models\Absence::count(),
        //                 'pending_purchases' => \App\Models\PurchaseRequest::where('status', 'pendiente')->count(),
        //             ];
        //         });
        //     } catch (\Exception $e) {}
        // }
    }
}
