<?php

namespace App\Providers;

use App\Models\LegalPage;
use App\Models\Setting;
use App\Models\SocialLink;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

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
        RedirectIfAuthenticated::redirectUsing(function () {
            return route('dashboard');
        });

        $routePrefix = config('vars.admin_route_prefix');
        $settings = Setting::first();
        $siteName = $settings ? $settings->site_name : env('APP_NAME');
        $socialLinks = SocialLink::all();
        $legalPages = LegalPage::all();

        Facades\View::share('site_settings', $settings);
        Facades\View::share('site_name', $siteName);
        Facades\View::share('route_prefix', $routePrefix);
        Facades\View::share('social_links', $socialLinks);
        Facades\View::share('legal_pages', $legalPages);

        Facades\View::composer('*', function (View $view) use ($siteName, $routePrefix) {
            $pageName = Str::ucfirst(str_replace($routePrefix, '', Facades\Route::currentRouteName()));
            $pageTitle = $pageName . ' | ' . $siteName;
            $view->with('page_title', $pageTitle)->with('page_name', $pageName);
        });
    }
}
