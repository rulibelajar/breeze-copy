<?php

namespace App\Http\Controllers\Worlds;

use App\Http\Controllers\Controller;
use App\Models\Worlds\UserWorld3;
use Illuminate\Http\Request;

class World3Controller extends Controller
{
    public function store(Request $request)
    {
        $world = UserWorld3::create([
            'user_id' => request()->user()->id,
            'airline_name' => $request->airline_name,
        ]);

        return response()->json($world);
    }
}
