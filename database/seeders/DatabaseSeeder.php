<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Worlds\UserWorld1;
use App\Models\Worlds\UserWorld2;
use App\Models\Worlds\UserWorld3;

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
