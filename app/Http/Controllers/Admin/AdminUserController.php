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

    public function ban(Request $request, User $user)
    {
        $validate = $request->validate([
            'banned' => 'required|boolean',
        ]);

        $user->banned = $validate['banned'];
        $user->save();

        return back()->with('success', 'User successfully banned');
    }
}
