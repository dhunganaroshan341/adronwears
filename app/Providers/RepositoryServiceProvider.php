<?php

namespace App\Providers;

use Domain\Cart\Contracts\CartRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Cart\SessionCartRepository;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(
            CartRepositoryInterface::class,
            SessionCartRepository::class
        );
    }
}
