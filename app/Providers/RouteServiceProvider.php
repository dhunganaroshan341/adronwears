<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const ADMIN_DASH = '/admin/dashboard';
    public const INDEX = '/';

    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            // API routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Breeze auth routes


            // Public web routes
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            // Admin routes (authenticated)
            Route::middleware(['web', 'admin'])
                ->prefix('admin')->name('admin.')
                ->group(base_path('routes/admin.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip()
            );
        });
    }
}
