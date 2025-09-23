<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ManageAirlineController extends Controller
{
    //
    public function index($worldId)
    {
        $user = Auth::user();

        return Inertia::render('ManageAirline/Index', [
            'worldId' => $worldId,
            'userId' => $user->id
        ]);
    }
}
