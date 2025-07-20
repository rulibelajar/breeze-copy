<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{

    public function index(): Response

    {
        $user = Auth::user();

        return Inertia::render('Admin/Index', [
            'user' => $user,
        ]);
    }

    public function dashboard(): Response
    {
        return Inertia::render('Admin/Profile/Dashboard');
    }
}
