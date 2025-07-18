<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{

    public function index(): Response
    {
        return inertia('Admin/Index');
    }

    public function dashboard(): Response
    {
        return inertia('Admin/Dashboard');
    }
}
