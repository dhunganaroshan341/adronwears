<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\Setting;
use App\Models\WorkingDay;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

   public function boot(): void
{
    Paginator::useBootstrapFive();

    // Frontend views
    $this->composeFrontendViews([
        'Frontend.Layouts.main',
        'Frontend.Layouts.footer',
        'Frontend.Pages.contact',
        'Frontend-tailwind.Layouts.main',
        'Frontend-tailwind.Layouts.footer',
        'Frontend-tailwind.Pages.contact',
    ]);

    // Backend views
    $this->composeBackendViews([
        'Admin.*',
        'Auth.*',
    ]);
}

    protected function composeFrontendViews(array $views): void
    {
        View::composer($views, function ($view) {

            $setting = Setting::first();

            $services = Service::where('status', 1)
                ->latest()
                ->take(4)
                ->get();

            $view->with('frontendSettings', [
                'setting' => $setting,
                'services' => $services,
                'workdays' => WorkingDay::all(),
            ]);
        });
    }

    protected function composeBackendViews(array $views): void
    {
        View::composer($views, function ($view) {

            $setting = Setting::first();

            $view->with('backendSettings', [
                'id' => $setting?->id,
                'logo' => $setting?->logo,
                'title' => $setting?->title,
            ]);
        });
    }
}
