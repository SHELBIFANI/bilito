<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CityController;
use App\Models\City;
use App\Models\Flight;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {

    $returnJson = [
        'cities' => City::get()->map->only(['id', 'name']),
        'flights' => Flight::with(['origin', 'destination'])->inRandomOrder()->limit(5)->get()->map->only(['id', 'destination', 'origin', 'departure', 'arrival',]),
    ];
    return $returnJson;
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/user_orders', [ProfileController::class, 'orders'])->name('profile.orders');

    Route::post('flight/order', [PassengerController::class, 'store'])->name('passemger.store');
    Route::get('Flight/order/verify', [PassengerController::class, 'verify'])->name('verify');

    Route::get('flight/order/{order}', [OrderController::class, 'show'])->name('order_show');
});

Route::get('cities', CityController::class);

Route::post('/flight', [FlightController::class, 'search'])->name('flight.show');

Route::get('flight/{flight}', [FlightController::class, 'show']);

Route::get('weekly-prices', [FlightController::class, 'weekly']);

require __DIR__ . '/auth.php';
