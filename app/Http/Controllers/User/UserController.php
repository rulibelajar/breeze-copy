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

class UserController extends Controller
{
    public function dashboard(): Response|RedirectResponse
    {
        $user = Auth::user();

        $airline = AirlinesWorld1::where('user_id', $user->id)->first();
        $have_airline = $airline ? true : false;

        //utk mengecek apakah user sudah punya airlines di Model UserWorld1



        return Inertia::render('Dashboard', [
            'user' => $user->id,
            'username' => $user->username,
            'title' => 'User Game Worlds',
            'have_airline' => $have_airline

        ]);
    }

    public function worlds(): Response
    {
        return Inertia::render('User/Index');
    }
}
