<?php

namespace App\Http\Controllers\AirlinesWorlds;

use App\Http\Controllers\Controller;
use App\Models\AirlinesWorlds\AirlinesWorld1;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Inertia\Inertia;



class AirlinesWorld1Controller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'airline_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:20|unique:airlines,airline_name,NULL,id,world_id,' . $request->world_id,
            'world_id' => 'required|in:1,2,3',
        ], [
            'airline_name.required' => 'Airline name is required.',
            'airline_name.regex' => 'Airline name can only contain letters, numbers, and spaces.',
            'airline_name.max' => 'Airline name must not exceed 20 characters.',
            'airline_name.unique' => 'Airline name has already been taken, please choose another name.',
            'world_id.required' => 'World is required.',
            'world_id.in' => 'Invalid world selected.',
        ]);

        $world = AirlinesWorld1::create([
            'user_id' => Auth::user()->id,
            'airline_name' => $request->airline_name,
        ]);

        // ⬇️ Redirect balik ke dashboard, bukan JSON
        return redirect()
            ->route('dashboard')
            ->with('success', 'Airline created successfully.');
    }

    public function enter()
    {
        // load data dari model AirlinesWorld1
        $airline = AirlinesWorld1::where('user_id', Auth::user()->id)->first();

        return Inertia::render('Airline/Enter', [
            'airline' => $airline,
        ]);
    }
}
