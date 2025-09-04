<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

use App\Models\Worlds\UserWorld1;
use App\Models\Worlds\UserWorld2;
use App\Models\Worlds\UserWorld3;

class UserController extends Controller
{
    public function dashboard(): Response|RedirectResponse
    {
        $user = Auth::user();
        return Inertia::render('Dashboard', [
            'user' => $user->id,
            'username' => $user->username,
            'title' => 'User Game Worlds',

        ]);
    }

    public function worlds(): Response
    {
        return Inertia::render('User/Index');
    }
}
