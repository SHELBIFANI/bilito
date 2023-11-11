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
        
        $result = Flight::query()
        ->where('origin_id', $origin)
        ->where('destination_id', $destination)
        //->where('departure', 'like', "%$departure%")
        ->whereDate('departure', '=' ,$departure)
        ->where('capacity', '>=', $number_of_passenger)
        ->get();
        
        if($request->input('price')){
            $result = $result->where('price', '<=', $request->input('price'));
        }

        if($request->has('time')) {
            $time = $request->input('time');
            // $flights = Flight::get();
            // foreach($flights as $flight){
            //     $dateTime = date('H:i:s', strtotime($flight->daparture));
            // }
            // dd($dateTime);
            // $result = $result->whereTime('departure', '=', '23:00:00');
            // $result = $result->whereTime('departure', '=', '23:00:00');
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