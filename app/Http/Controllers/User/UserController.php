<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;


use App\Models\Airline;




class UserController extends Controller
{
    public function dashboard(): Response|RedirectResponse
    {
        $user = Auth::user();

        $worlds = [];

        // Loop untuk world 1, 2, dan 3
        for ($world_id = 1; $world_id <= 3; $world_id++) {
            // Cek apakah user sudah punya airline di world ini
            $have_airline = Airline::where('user_id', $user->id)
                ->where('world_id', $world_id)
                ->exists();

            // Ambil nama airline user di world ini (jika ada)
            $airline_name = null;
            if ($have_airline) {
                $airline_name = Airline::where('user_id', $user->id)
                    ->where('world_id', $world_id)
                    ->value('airline_name');
            }

            $worlds[] = [
                'id' => $world_id,
                'title' => 'World ' . $world_id,
                'have_airline' => $have_airline,
                'airline_name' => $airline_name
            ];
        }

        return Inertia::render('Dashboard', [
            'user' => $user->id,
            'username' => $user->username,
            'worlds' => $worlds
        ]);
    }


    public function worlds(): Response
    {
        return Inertia::render('User/Index');
    }
}
