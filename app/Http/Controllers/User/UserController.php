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
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Buat array worlds dengan struktur yang konsisten
            $worlds = [];

            // World 1
            $world1 = UserWorld1::where('user_id', $user->id)->first();
            $worlds[] = [
                'id' => 1,
                'name' => 'Game World 1',
                'game_day' => $world1->game_day ?? 1,
                'game_date' => $world1->game_date ?? now()->format('Y-m-d'),
                'airline_name' => $world1->airline_name ?? null,
                'exists' => !is_null($world1)
            ];

            // World 2
            $world2 = UserWorld2::where('user_id', $user->id)->first();
            $worlds[] = [
                'id' => 2,
                'name' => 'Game World 2',
                'game_day' => $world2->game_day ?? 1,
                'game_date' => $world2->game_date ?? now()->format('Y-m-d'),
                'airline_name' => $world2->airline_name ?? null,
                'exists' => !is_null($world2)
            ];

            // World 3
            $world3 = UserWorld3::where('user_id', $user->id)->first();
            $worlds[] = [
                'id' => 3,
                'name' => 'Game World 3',
                'game_day' => $world3->game_day ?? 1,
                'game_date' => $world3->game_date ?? now()->format('Y-m-d'),
                'airline_name' => $world3->airline_name ?? null,
                'exists' => !is_null($world3)
            ];

            return Inertia::render('Dashboard', [
                'user' => $user->id,
                'username' => $user->username,
                'title' => 'User Game Worlds',
                'worlds' => $worlds,
            ]);
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Failed to load game worlds.');
        }
    }

    public function worlds(): Response
    {
        return Inertia::render('User/Index');
    }
}
