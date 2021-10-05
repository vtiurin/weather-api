<?php

namespace App\Services;

use App\Interfaces\WeatherCheckerInterface;
use App\Models\Weather;

class OpenMeteoWeatherCheckerAdapter implements WeatherCheckerInterface
{

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'open-meteo.com';
    }

    /**
     * @param string $city
     * @return Weather with dummy data
     */
    public function getWeather(string $city): Weather
    {
        // dummy data
        $dimensions = [
            'tempC' => 42,
            'windSpeedKmph' => 42,
        ];

        return new Weather($dimensions);
    }
}
