<?php


use App\Http\Controllers\EditProfileController as ControllersEditProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


Route::middleware('auth')->group(function(){
    Route::resource('profile', ControllersEditProfileController::class)->except('index', 'create', 'store', 'show')->parameters([
        'profile' => 'user'
    ]);
});

require __DIR__.'/auth.php';