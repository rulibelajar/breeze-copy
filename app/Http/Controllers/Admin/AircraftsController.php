<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Aircraft;

class AircraftsController extends Controller
{
    public function index()
    {
        try {
            $aircrafts = Aircraft::all();

            return Inertia::render('Admin/Aircrafts/Index', [
                'aircrafts' => $aircrafts
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load aircrafts.');
        }
    }
}
