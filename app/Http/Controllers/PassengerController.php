<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassengersRequest;
use App\Models\Order;
use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{

    public function store(StorePassengersRequest $request)
    {
        
        $user_id = $request->user()->id;
        foreach ($request->input('passengers') as $passenger) {
            $passengers = Passenger::create([
                'name' => $passenger['name'],
                'lastname' => $passenger['lastname'],
                'gender' => $passenger['gender'],
                'national_code' => $passenger['national_code'],
                'birthdate' => $passenger['birthdate'],
                'user_id' => $user_id,
            ]);
        }
        $order = Order::create([
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id' => $user_id,
            'flight_id' => $request->flight_id,
            'total' => $request->total,
        ]);

        // foreach($request->input('passengers') as $passenger){

        //     $order->passengers()->attach($passenger, ['order_id' => $order->id], ['passenger_id' => $passengers->id]);
        // }
    }
}
