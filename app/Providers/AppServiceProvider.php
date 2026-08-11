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

        // FRONTEND COMPOSER (your existing system kept)
        $this->composeFrontendViews([
            'Frontend.Layouts.main',
            'Frontend.layout.footer',
            'Frontend.contact',
        ]);

        $this->composeFrontendViews([
            'Frontend-tailwind.layout.main',
            'Frontend-tailwind.layout.footer',
            'Frontend-tailwind.contact',
        ]);

        // BACKEND COMPOSER (FIXED - now added properly)
        $this->composeBackendViews([
            'Admin.layout.master',
            'Auth.login',
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

            $view->with([
                'id' => $setting->id ?? null,
                'logo' => $setting->logo ?? '',
                'title' => $setting->title ?? '',
                'contact' => $setting->contact ?? '',
                'contact1' => $setting->contact1 ?? '',
                'contact2' => $setting->contact2 ?? '',
                'phone3' => $setting->phone3 ?? '',
                'phone4' => $setting->phone4 ?? '',
                'landline1' => $setting->landline1 ?? '',
                'landline2' => $setting->landline2 ?? '',
                'email' => $setting->email ?? '',
                'email2' => $setting->email2 ?? '',
                'address' => $setting->address ?? '',
                'address2' => $setting->address2 ?? '',
                'description' => $setting->description ?? '',
                'work_description' => $setting->work_description ?? '',
                'welcome_description' => $setting->welcome_description ?? '',
                'about_description' => $setting->about_description ?? '',
                'welcome_image' => $setting->welcome_image ?? '',
                'about_image' => $setting->about_image ?? '',
                'office_hours' => $setting->office_hours ?? '',
                'facebook' => $setting->facebook_url ?? '',
                'tiktok' => $setting->tiktok_url ?? '',
                'twitter' => $setting->twitter_url ?? '',
                'instagram' => $setting->instagram_url ?? '',
                'github' => $setting->github_url ?? '',
                'workdays' => WorkingDay::all(),
                'services' => $services,
            ]);
        });
    }

    // ✅ THIS WAS MISSING BEFORE (THIS FIXES YOUR BACKEND)
    protected function composeBackendViews(array $views): void
    {
        View::composer($views, function ($view) {

            $setting = Setting::first();

            $view->with([
                'id' => $setting->id ?? null,
                'logo' => $setting->logo ?? '',
                'title' => $setting->title ?? '',
            ]);
        });
    }
}
