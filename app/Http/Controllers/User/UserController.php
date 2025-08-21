<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\GameWorld;

class UserController extends Controller
{
    public function index()
    {
        try {
            $worlds = GameWorld::all();

            $nextDayChange = GameWorld::first()->next_day_change ?? null;

            return Inertia::render('User/Index', [
                'title' => 'All Game Worlds',
                'worlds' => $worlds
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load game worlds.');
        }
    }
}
