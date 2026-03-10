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

        $this->composeFrontendViews([
            'frontend.layout.main',
            'frontend.layout.footer',
            'frontend.contact',
        ]);

        $this->composeFrontendViews([
            'frontend-tailwind.layout.main',
            'frontend-tailwind.layout.footer',
            'frontend-tailwind.contact',
        ]);

        Paginator::useBootstrapFive();
    }

    protected function composeFrontendViews(array $views): void
    {
        View::composer($views, function ($view) {
            $setting = Setting::first();
            $services = Service::where('status', 1)->latest()->take(4)->get();

            $view->with([
                'id' => $setting->id ?? null,
                'logo' => $setting->logo ?? '',
                'title' => $setting->title ?? '',
                'contact' => $setting->contact ?? '',
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
                'twitter' => $setting->twitter_url ?? '',
                'instagram' => $setting->instagram_url ?? '',
                'github' => $setting->github_url ?? '',
                'workdays' => WorkingDay::all(),
                'services' => $services,
            ]);
        });
    }
}
