<?php

namespace App\Providers;

use App\Models\HomepageMedia;
use App\Models\HomepageSetting;
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
        View::composer('*', function ($view) {
            $view->with('settings', HomepageSetting::first());
            $view->with('homepageMedia', HomepageMedia::where('is_active', true)->orderBy('sort_order')->get()->keyBy('key'));
        });
    }
}
