<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __invoke(Request $request)
    {
        return City::get();
    }
}
