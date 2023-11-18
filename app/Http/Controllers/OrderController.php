<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($payment_id)
    {
        $info_payment = Payment::with('order')
        ->where('order_id', $payment_id)->first();

        dd($info_payment);
        return response()->json($info_payment);
    }
}
