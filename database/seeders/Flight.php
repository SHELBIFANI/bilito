<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\City;
use App\Models\Flight as ModelsFlight;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Flight extends Seeder
{

    public function run(): void
    {
        $plan = [
            'boeing747',
            'boeing777',
            'boeing720',
            'boeing707',
            'airbus a230',
            'airbus a380',
            'airbus a350',
            'airbus a310',
            'airbus a319',
        ];


        foreach (range(1, 12000) as $index) {
            $date = now();

            $Airplan = $plan[array_rand($plan)];
            $fligh_id = Airline::inRandomOrder()->first()->id;

            $city_id_origin = City::inRandomOrder()->first()->id;
            $city_id_destination = City::where('id', '!=', $city_id_origin)->inRandomOrder()->first()->id;

            $capacity = rand(100, 500);
            $price = rand(500000, 5000000);


            ModelsFlight::create([
                'departure'  => $date->addDays(rand(0, 10))->addHours(rand(1, 24))->format('Y-m-d H:i:s'),
                'arrival'  => $date->addHours(rand(1, 24))->format('Y-m-d H:i:s'),
                'airline_id' => $fligh_id,
                'origin_id' => $city_id_origin,
                'destination_id' => $city_id_destination,
                'capacity' =>  $capacity,
                'price' =>  $price,
                'plane' => $Airplan,


            ]);
        };
    }
}
