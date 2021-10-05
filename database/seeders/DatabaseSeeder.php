<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'saint-petersburg',
            'moscow',
            'tomsk',
            'paris',
            'berlin',
        ];

        //today
        for ($i = 0; $i < 30; $i++) {
            DB::table('searches')->insert([
                [
                    'id' => Str::uuid(),
                    'city' => $cities[array_rand($cities)],
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ],
            ]);
        }

        //month
        for ($i = 0; $i < 30; $i++) {
            DB::table('searches')->insert([
                [
                    'id' => Str::uuid(),
                    'city' => $cities[array_rand($cities)],
                    "created_at" => Carbon::now()->subDays(30),
                    "updated_at" => Carbon::now()->subDays(30),
                ],
            ]);
        }

        //two month
        for ($i = 0; $i < 30; $i++) {
            DB::table('searches')->insert([
                [
                    'id' => Str::uuid(),
                    'city' => $cities[array_rand($cities)],
                    "created_at" => Carbon::now()->subDays(60),
                    "updated_at" => Carbon::now()->subDays(60),
                ],
            ]);
        }

    }
}
