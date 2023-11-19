<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Order;
use App\Models\Passenger;
use App\Models\PassengerOrder;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($order_id)
    {
        $order = Order::query()->where('id', $order_id)->first();
        $flight = Flight::query()->where('id', $order->flight_id)->first();
        $payment = Payment::query()->where('order_id', $order_id)->first();
        $passenger = PassengerOrder::query()->where('order_id', $order_id)->first();
        return response()->json([
            'order' => $order,
            'flight' => $flight,
            'payment' => $payment,
            'passenger' => $passenger,
        ]);
    }
}
