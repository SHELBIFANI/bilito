<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function show(Request $request)
    {
        
        
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $number_of_passenger = $request->input('number_of_passenger');
        
        $city_origin = City::where('name', $origin)->first();
        $city_destination = City::where('name', $destination)->first();

        if($city_origin != $city_destination){

            $result = DB::table('flights')
                    ->where('origin_id', $city_origin->id)
                    ->where('destination_id', $city_destination->id)
                    ->where('capacity', '>=', $number_of_passenger)
                    ->get();
    
        }else{
            return 'There is no flight from '. $city_origin .'to' .$city_destination ;
        }

        if($result->isEmpty()){
            
            return 'There is no flight from '.$origin.' to '.$destination;
            
        }else{
            
            return $result;

        }
    }



}
