<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeatherSeeder extends Seeder
{
    /**
     * Testing weather data from https://api.meteo.lt/.
     *
     * @return void
     */
    public function run()
    {

        $weather = array(
            'clear', 'isolated-clouds ',
            'scattered-clouds', 'overcast',
            'light-rain', 'moderate-rain',
            'heavy-rain', 'sleet',
            'light-snow', 'moderate-snow',
            'heavy-snow', 'fog', 'na'
        );

        $data = [count($weather)];
        for ($i=0; $i < count($weather); $i++) {
                $data[$i] = [
                    'weather' => $weather[$i],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
        }

        DB::table('weather')->insert($data);
    }
}
