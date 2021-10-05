<?php

namespace App\Services;

use GuzzleHttp;
use App\Interfaces\WeatherCheckerInterface;
use App\Models\Weather;

class WttrInWeatherCheckerAdapter implements WeatherCheckerInterface
{
    public function getName(): string
    {
        return 'wttr.in';
    }

    public function getWeather($city): Weather
    {
        $client = new GuzzleHttp\Client();
        try {
            $body = $client->request("GET", "wttr.in/{$city}?format=j1", ['headers' => ['Accept-Encoding' => 'gzip']])->getBody();
        } catch (GuzzleHttp\Exception\GuzzleException $e) {
        }
        $response = json_decode($body, true);

        $dimensions = [
            'tempC' => $response['current_condition'][0]['temp_C'],
            'windSpeedKmph' => $response['current_condition'][0]['windspeedKmph'],
        ];

        return new Weather($dimensions);
    }
}
