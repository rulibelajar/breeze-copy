<?php

namespace App\Http\Controllers\Worlds;

use App\Http\Controllers\Controller;
use App\Models\Worlds\UserWorld2;
use Illuminate\Http\Request;

class World2Controller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'airline_name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:20|unique:user_world_2,airline_name',
        ], [
            'airline_name.required' => 'Airline name is required.',
            'airline_name.regex' => 'Airline name can only contain letters, numbers, and spaces.',
            'airline_name.max' => 'Airline name must not exceed 20 characters.',
            'airline_name.unique' => 'Airline name has already been taken, please choose another name.',
        ]);

        $world = UserWorld2::create([
            'user_id' => request()->user()->id,
            'airline_name' => $request->airline_name,
        ]);

        return response()->json($world);
    }
}
