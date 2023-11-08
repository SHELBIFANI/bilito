<?php

namespace Database\Seeders;

use App\Models\Flight as ModelsFlight;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        
        
        foreach(range(1, 120) as $index) {
            $date = Carbon::create(2015, 5, 28, 0, 0, 0);
            
            $Airplan = $plan[array_rand($plan)];
            $fligh_id = rand(1, 18);
            $city_id_origin = rand(1, 44);
            $city_id_destination = rand(1, 44);
            $capacity = rand(100, 500);
            $price = rand(500000, 5000000);
            
            if($city_id_origin == $city_id_destination){
                $city_id_destination = rand(1, 44);         
            }


            ModelsFlight::create([
                'departure'  => $date->addDays(rand(1, 30))->addHours(rand(1,24))->format('Y-m-d H:i:s'),
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
