<?php

namespace App\Providers;

use App\Device;
use App\Incident;
use App\Observers\DeviceObserver;
use App\Observers\IncidentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Device::observe(DeviceObserver::class);
        Incident::observe(IncidentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
