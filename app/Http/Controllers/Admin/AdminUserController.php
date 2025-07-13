<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    // menampilkan semua users
    public function index()
    {
        // tampilkan semua users
        $users = User::all();
        return inertia('Admin/User', [
            'users' => $users,
        ]);
    }
}
