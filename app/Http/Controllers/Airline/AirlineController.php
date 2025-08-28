<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    //
    public function show($world, $airline)
    {
        return "World: $world, Airline: $airline";
    }
}
