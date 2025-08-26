<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Models\GameWorld;
use Inertia\Inertia;
use App\Http\Controllers\Controller;

class AdminGameWorldController extends Controller
{
    //

    public function index()
    {
        try {
            $worlds = GameWorld::all();

            $nextDayChange = GameWorld::first()->next_day_change ?? null;

            return Inertia::render('GameWorld/Index', [
                'title' => 'All Game Worlds',
                'worlds' => $worlds
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load game worlds.');
        }
    }
}
