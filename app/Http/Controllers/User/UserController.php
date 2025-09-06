<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

use App\Models\AirlinesWorlds\AirlinesWorld1;
use App\Models\AirlinesWorlds\AirlinesWorld2;
use App\Models\AirlinesWorlds\AirlinesWorld3;

use App\Models\Airline;

class UserController extends Controller
{
    public function dashboard(): Response|RedirectResponse
    {
        $world_id = 2;

        $user = Auth::user();

        // cek apakah user ini sudah punya airline di world tsb
        $have_airline = Airline::where('user_id', $user->id)->where('world_id', $world_id)->exists();

        // mengambil hanya airlines name dari airlines di world tsb
        $airline_name = Airline::where('world_id', $world_id)->value('airline_name');




        return Inertia::render('Dashboard', [
            'user' => $user->id,
            'username' => $user->username,
            'title' => 'World ' . $world_id,
            'airline_name' => $airline_name,
            'have_airline' => $have_airline

        ]);
    }

    public function worlds(): Response
    {
        return Inertia::render('User/Index');
    }
}
