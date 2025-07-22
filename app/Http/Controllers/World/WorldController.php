<?php

namespace App\Http\Controllers\World;

use App\Http\Controllers\Controller;
use App\Models\World;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class WorldController extends Controller
{
    public function index(): Response
    {
        $worlds = World::where('is_active', true)->get()->map(function ($world) {
            return [
                'id' => $world->id,
                'name' => $world->name,
                'day_game' => $world->day_game,
                'fantasy_date' => $world->getFantasyDate(),
                'progress' => $world->getGameProgress(),
                'is_completed' => $world->isGameCompleted(),
                'last_day_change' => $world->last_day_change,
                'next_day_change' => $world->next_day_change,
            ];
        });

        return Inertia::render('World/WorldIndex', [
            'worlds' => $worlds
        ]);
    }

    public function show(World $world): Response
    {
        return Inertia::render('World/WorldShow', [
            'world' => [
                'id' => $world->id,
                'name' => $world->name,
                'day_game' => $world->day_game,
                'fantasy_date' => $world->getFantasyDate(),
                'progress' => $world->getGameProgress(),
                'is_completed' => $world->isGameCompleted(),
                'last_day_change' => $world->last_day_change,
                'next_day_change' => $world->next_day_change,
            ]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $world = World::create([
            'name' => $validated['name'],
            'day_game' => 1,
            'last_day_change' => now(),
            'next_day_change' => now()->addMinutes(20),
            'is_active' => true
        ]);

        return redirect()->route('admin.worlds.show', $world);
    }

    public function reset(World $world)
    {
        $world->resetWorld();

        return redirect()->back()->with('success', 'World has been reset to day 1');
    }

    // API endpoint untuk mendapatkan data real-time
    public function getWorldData(World $world)
    {
        return response()->json([
            'id' => $world->id,
            'name' => $world->name,
            'day_game' => $world->day_game,
            'fantasy_date' => $world->getFantasyDate(),
            'progress' => $world->getGameProgress(),
            'is_completed' => $world->isGameCompleted(),
            'last_day_change' => $world->last_day_change,
            'next_day_change' => $world->next_day_change,
        ]);
    }
}
