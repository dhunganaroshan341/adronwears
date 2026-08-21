<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Shipping Requests
        |--------------------------------------------------------------------------
        | 5 requests per IP every 10 minutes.
        */
        RateLimiter::for('shipping-requests', function (Request $request) {
            return Limit::perMinutes(10, 5)
                ->by($request->ip());
        });

        /*
        |--------------------------------------------------------------------------
        | Contact Form
        |--------------------------------------------------------------------------
        | 5 requests per IP every 10 minutes.
        */
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perMinutes(10, 5)
                ->by($request->ip());
        });

        /*
        |--------------------------------------------------------------------------
        | reCAPTCHA Verification
        |--------------------------------------------------------------------------
        | 10 requests per IP every 5 minutes.
        */
        RateLimiter::for('recaptcha', function (Request $request) {
            return Limit::perMinutes(5, 10)
                ->by($request->ip());
        });
    }
}
