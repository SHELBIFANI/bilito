<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function show(Request $request)
    {
        
        
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $number_of_passenger = $request->input('number_of_passenger');
        
        if($origin == $destination){
            return response(['massage' => 'The city of origin and destination should not be the same'], 404) ;   
        }
        
        $result = Flight::query()
        ->where('origin_id', $origin)
        ->where('destination_id', $destination)
        ->where('capacity', '>=', $number_of_passenger)
        ->get();
        
        if($result->isEmpty()){
            return response(['message' => 'No flights found'], 404); 
            
        }
        return $result;
    }
}