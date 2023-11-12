<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function show(Request $request)
    {
        
        $departure = $request->input('departure');
        $origin = $request->input('origin');
        $destination = $request->input('destination');
        $number_of_passenger = $request->input('number_of_passenger');
        
        if($origin == $destination){
            return response(['massage' => 'The city of origin and destination should not be the same'], 404) ;   
        }
        
        if($request->has('min_time')){
        $result = Flight::
        where('origin_id', $origin)
        ->where('destination_id', $destination)
        //->where('departure', 'like', "%$departure%")
        ->whereDate('departure', '=' ,$departure)
        ->where('capacity', '>=', $number_of_passenger)
        ->whereTime('departure' , '>' , $request->input('min_time'))
        ->whereTime('departure' , '<' , $request->input('max_time'))
        ->get();
        }else{
            $result = Flight::
            where('origin_id', $origin)
            ->where('destination_id', $destination)
            //->where('departure', 'like', "%$departure%")
            ->whereDate('departure', '=' ,$departure)
            ->where('capacity', '>=', $number_of_passenger)
            ->get();
        }
        if($request->input('max_price')){
            $result = $result->where('price', '<=', $request->input('max_price'));
        }
        if($request->input('min_price')){
            $result = $result->where('price', '<=', $request->input('min_price'));
        }

        if($result->isEmpty()){
            return response(['message' => 'No flights found'], 404); 
            
        }

        return response()->json($result);
        //return $request
        //create filter sorting
        //add model Airline in this page
        
    }
}