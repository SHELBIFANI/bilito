<?php


use App\Http\Controllers\FlightController;
use App\Http\Controllers\ProfileController;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;


Route::get('/', function () {
    //pass the most popular airlines to the view 
    return Flight::inRandomOrder()->limit(5)->get();
});


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
});

Route::post('/flight', [FlightController::class, 'show'])->name('flight.show');

require __DIR__.'/auth.php';