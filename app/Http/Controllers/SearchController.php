<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function index(Request $request, Container $container)
    {
        $this->validate($request, [
            'city' => 'required|string|max:255',
        ]);

        $city = $request->input('city');

        $result = ['sources' => [], 'avgTempC' => 0, 'avgWindSpeedKmph' => 0];
        foreach ($container->tagged('weatherSources') as $source) {
            $weather = $source->getWeather($city);
            array_push($result['sources'], [
                'name' => $source->getName(),
                'tempC' => $weather->getTempC(),
                'windSpeedKmph' => $weather->getWindSpeedKmph(),
            ]);

            $result['avgTempC'] = $result['avgTempC'] + $weather->getTempC();
            $result['avgWindSpeedKmph'] = $result['avgWindSpeedKmph'] + $weather->getWindSpeedKmph();
        }

        $sourcesAmount = sizeof($result['sources']);
        $result['avgTempC'] = $result['avgTempC'] / $sourcesAmount;
        $result['avgWindSpeedKmph'] = $result['avgWindSpeedKmph'] / $sourcesAmount;

        DB::table('searches')->insert([
            [
                'id' => Str::uuid(),
                'city' => $city,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
        ]);

        return response()->json($result);
    }
}

