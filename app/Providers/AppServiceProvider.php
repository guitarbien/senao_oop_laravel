<?php

namespace App\Providers;

use App\Services\ConfigManager;
use App\Services\ScheduleManager;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConfigManager::class, function () {
            return new ConfigManager;
        });

        $this->app->bind(ScheduleManager::class, function () {
            return new ScheduleManager;
        });
    }
}
