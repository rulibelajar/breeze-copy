<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Airline;

class ManageAirlineController extends Controller
{
    //
    public function index($worldId)
    {
        $user = Auth::user();

        $airline = Airline::where('user_id', $user->id)
            ->where('world_id', $worldId)
            ->first();


        if (!$airline || !$airline->is_active) {

            return Inertia::render('ManageAirline/Starting');
        } else {

            return Inertia::render('ManageAirline/Index', [
                'worldId' => $worldId,
                'userId' => $user->id,
                'airline' => $airline
            ]);
        }
    }
}
