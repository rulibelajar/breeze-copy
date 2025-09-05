<?php

namespace App\Http\Controllers\Airline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Airline;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AirlineController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'airline_name' => 'required|regex:/^[a-zA-Z\s]+$/|max:20|unique:airlines,airline_name,NULL,id,world_id,' . $request->world_id,
        ], [
            'airline_name.required' => 'Airline name is required.',
            'airline_name.regex' => 'Airline name can only contain letters and spaces.',
            'airline_name.max' => 'Airline name must not exceed 20 characters.',
            'airline_name.unique' => 'Airline name has already been taken in this world.',
        ]);



        $world = Airline::create([
            'user_id' => Auth::user()->id,
            'airline_name' => $request->airline_name,
            'world_id' => $request->world_id
        ]);

        // ⬇️ Redirect balik ke dashboard, bukan JSON
        return redirect()
            ->route('dashboard')
            ->with('success', 'Airline created successfully.');
    }

    public function enter()
    {
        // load data dari model AirlinesWorld1
        $airline = Airline::where('user_id', Auth::user()->id)->first();

        return Inertia::render('Airline/Enter', [
            'airline' => $airline,
        ]);
    }
}
