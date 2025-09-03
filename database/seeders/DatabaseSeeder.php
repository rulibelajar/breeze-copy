<?php

namespace Database\Seeders;

use App\Models\GameWorld;
use App\Models\Route;
use App\Models\User;
use App\Models\UserWorld;
use App\Models\Aircraft;
use App\Models\Worlds\UserWorld1;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(100)->create();

        {
            $users = [
                [
                    'name' => 'Alice',
                    'username' => 'alice',
                    'email' => 'alice@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Bob',
                    'username' => 'bob',
                    'email' => 'bob@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'User One',
                    'username' => 'user',
                    'email' => 'user@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Admin One',
                    'username' => 'admin',
                    'role' => 'admin',
                    'email' => 'admin@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Ricardo Simatupang',
                    'username' => 'ricardo',
                    'role' => 'user',
                    'email' => 'ricardo@example.com',
                    'password' => Hash::make('password'),
                ],



            ];

            // masukkan semua users ke database
            foreach ($users as $user) {
                User::create($user);
            }
        }
    }
}
