<?php

namespace App\Interfaces;

use App\Models\Weather;

interface WeatherCheckerInterface
{
    public function getName(): string;

    public function getWeather(string $city): Weather;
}
