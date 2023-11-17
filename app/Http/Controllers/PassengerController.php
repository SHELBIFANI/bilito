<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassengersRequest;
use App\Models\Order;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PassengerController extends Controller
{

    public function store(StorePassengersRequest $request)
    {

        $user_id = $request->user()->id;
        $passengers = [];

        foreach ($request->input('passengers') as $passenger) {
            $passengers[] = Passenger::create([
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
        ]);

        foreach ($passengers as $passenger) {

            $order->passengers()->attach($passenger);
        }

        $invoice = (new Invoice)->amount($order->total);

        return Payment::callbackUrl(url('verify'))
            ->purchase($invoice, function ($driver, $transactionId) use ($request, $order) {
                $order->update(['gateway_ref' => $transactionId]);
            })->pay()->render();
    }

    public function verify(Request $request)
    {
        try{
            $order = Order::where('gateway_ref', $request->input('Authority'))->firstOrFail();
            $receipt = Payment::amount($order->total)
                ->transactionId($order->gateway_ref)
                ->verify();

            $order->payment()->create([
                'total' => $request->total,
                'gateway' => $receipt->getDriver(),
                'tracking_code' => $receipt->getReferenceId(),
            ]);
        }
        catch (InvalidPaymentException $exception) {
            // return error view
            echo $exception->getMessage();
        }
    }
}
