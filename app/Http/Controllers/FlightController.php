<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlightResource;
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

        if ($origin == $destination) {
            return response(['massage' => 'The city of origin and destination should not be the same'], 404);
        }


        // dd($request);
        $result = Flight::query()
            ->where('origin_id', $origin)
            ->where('destination_id', $destination)
            ->whereDate('departure', '=', $departure)
            ->where('capacity', '>=', $number_of_passenger)
            ->when($request->input('start_price'), function ($query) use ($request) {
                return $query->where('price', '>=', $request->input('start_price'));
            })
            ->when($request->input('end_price'), function ($query) use ($request) {
                return $query->where('price', '<=', $request->input('end_price'));
            })
            ->when($request->input('start_time'), function ($query) use ($request) {
                return $query->whereTime('departure', '>=', $request->input('start_time'));
            })
            ->when($request->input('end_time'), function ($query) use ($request) {
                return $query->whereTime('departure', '<=', $request->input('end_time'));
            })
            ->when($request->input('airline_id'), function ($query) use ($request) {
                return $query->where('airline_id', '=', $request->input('airline_id'));
            })
            ->when($request->input('sort'), function ($query) use ($request){
                match ($request->input('sort')) {
                    'cheapest' => $query->orderBy('price', 'asc'),
                    'earliest' => $query->orderBy('departure', 'asc'),
                    'expensive' => $query->orderBy('price', 'desc'),
                };
            })
            ->get();


        if ($result->isEmpty()) {
            return response(['message' => 'No flights found'], 404);
        }

        return FlightResource::collection($result);
       
    }

}