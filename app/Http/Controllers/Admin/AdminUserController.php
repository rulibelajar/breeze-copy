<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    // menampilkan semua users
    public function index()
    {
        // tampilkan semua users
        $users = User::paginate(10);

        return Inertia::render('Admin/User', [
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
