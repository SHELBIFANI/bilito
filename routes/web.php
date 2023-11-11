<?php


use App\Http\Controllers\EditProfileController as ControllersEditProfileController;
use App\Http\Controllers\FlightController;
use App\Models\Flight;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;


Route::get('/', function () {
    //pass the most popular airlines to the view 
    return Flight::inRandomOrder()->limit(5)->get();
});


Route::middleware('auth:sanctum')->group(function(){

    Route::get('/profile/{profile}', [ControllersEditProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{profile}', [ControllersEditProfileController::class, 'update'])->name('profile.update');

    Route::post('/flight', [FlightController::class, 'show'])->name('flight.show');
});

require __DIR__.'/auth.php';