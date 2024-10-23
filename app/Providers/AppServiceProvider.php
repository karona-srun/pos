<?php

namespace App\Providers;

use App\Models\SiteSettings;
use Carbon\Carbon;
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
        $site = SiteSettings::first();
        $dateFormat = $site->date_format === "dmY" ? "d-m-Y" : "m-d-Y";
        $timeFormat = $site->time_format === '12' ? " h:i A" : " H:i";
        Carbon::setLocale($site->timezone);
        Carbon::setToStringFormat($dateFormat.$timeFormat);
        View::share('site',$site);
    }
}
