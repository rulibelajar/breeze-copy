<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('Admin/Index');
    }

    public function dashboard(): Response
    {
        return Inertia::render('Admin/Profile/Dashboard');
    }
}
