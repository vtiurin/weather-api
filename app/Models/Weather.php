<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected string $tempC;
    protected string $windSpeedKmph;

    /**
     * @param array $dimensions
     */
    public function __construct($dimensions)
    {
        $this->tempC = $dimensions['tempC'];
        $this->windSpeedKmph = $dimensions['windSpeedKmph'];
    }

    /**
     * @return string
     */
    public function getTempC(): string
    {
        return $this->tempC;
    }

    /**
     * @return string
     */
    public function getWindSpeedKmph(): string
    {
        return $this->windSpeedKmph;
    }
}
