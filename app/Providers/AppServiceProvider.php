<?php

namespace App\Providers;

use App\Interfaces\WeatherCheckerInterface;
use App\Services\OpenMeteoWeatherCheckerAdapter;
use App\Services\WttrInWeatherCheckerAdapter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WeatherCheckerInterface::class, WttrInWeatherCheckerAdapter::class);
        $this->app->bind(WeatherCheckerInterface::class, OpenMeteoWeatherCheckerAdapter::class);
        $this->app->tag([WttrInWeatherCheckerAdapter::class, OpenMeteoWeatherCheckerAdapter::class], 'weatherSources');
    }
}
