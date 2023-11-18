<?php


use App\Http\Controllers\FlightController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;


Route::get('/', function () {

    $returnJson = [
        'cities' => City::get()->map->only(['id', 'name']),
        'flights' => Flight::with(['origin' , 'destination'])->inRandomOrder()->limit(5)->get()->map->only(['id', 'destination', 'origin', 'departure', 'arrival',]),
    ];
    return $returnJson;
});


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('flight/order', [PassengerController::class, 'store'])->name('passemger.store');
    Route::get('Flight/order/verify', [PassengerController::class, 'verify'])->name('verify');

    Route::get('flight/order/{payment_id}', [OrderController::class, 'show'])->name('order_show');
});

Route::post('/flight', [FlightController::class, 'show'])->name('flight.show');

require __DIR__.'/auth.php';