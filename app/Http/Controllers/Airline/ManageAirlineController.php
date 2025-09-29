<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Airline;
use App\Models\Aircraft;
use App\Models\Airport;


class ManageAirlineController extends Controller
{
    //
    public function index($worldId)
    {
        $user = Auth::user();

        $airline = Airline::where('user_id', $user->id)
            ->where('world_id', $worldId)
            ->first();

        $aircrafts = Aircraft::all();
        $airports = Airport::all();


        if (!$airline || !$airline->is_active) {

            return Inertia::render('ManageAirline/Starting', [
                'aircrafts' => $aircrafts,
                'airports' => $airports,
                'worldId' => $worldId
            ]);
        } else {

            return Inertia::render('ManageAirline/Index', [
                'worldId' => $worldId,
                'userId' => $user->id,
                'airline' => $airline
            ]);
        }
    }

    public function start(Request $request, $worldId)
    {
        $request->validate([
            'aircraft' => 'required|exists:aircrafts,id',
            'airport'  => 'required|exists:airports,id',

        ]);

        $user = Auth::user();


        $airline = Airline::updateOrCreate(
            [
                'user_id' => $user->id,
                'world_id' => $worldId,
            ],
            [
                'is_active'            => true,
                'starting_aircraft_id' => $request->aircraft,
                'starting_airport_id'  => $request->airport,
            ]
        );

        // target saya 'is_active' => true "tercapai"
        return redirect()->route('manage-airline.index', ['worldId' => $request->worldId])
            ->with('success', 'Airline berhasil dimulai!');
    }
}
