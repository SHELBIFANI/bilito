<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Flight;
use App\Models\Order;
use App\Models\Passenger;
use App\Models\PassengerOrder;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        $order->load([
            'flight',
            'user',
            'passengers',
            'payments',
        ]);

        return OrderResource::make($order);
        // return response()->json([
        //     'order' => $order,
        //     'flight' => $flight,
        //     'payment' => $payment,
        //     'passenger' => $passenger_order  ,
        // ]);
    }
}
