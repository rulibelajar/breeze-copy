<?php

namespace Database\Seeders;

use App\Models\GameWorld;
use App\Models\Route;
use App\Models\User;
use App\Models\UserWorld;
use App\Models\Aircraft;
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
            ];

            GameWorld::create([
                'name' => 'Game World 1',
                'game_day' => 1,
                'game_date' => '1970-01-01'
            ]);

            GameWorld::create([
                'name' => 'Game World 2',
                'game_day' => 1,
                'game_date' => '1990-01-01'
            ]);

            GameWorld::create([
                'name' => 'Game World 3',
                'game_day' => 1,
                'game_date' => '2000-01-01'
            ]);


            Aircraft::create([
                'name' => 'Boeing 777-200ER',
                'family' => 'Boeing 777',
                'manufacturer' => 'Boeing',
                'speed' => 800,
                'capacity' => 300,
                'price' => 10000000
            ]);

            Aircraft::create([
                'name' => 'Boeing 737 MAX 8',
                'family' => 'Boeing 737',
                'manufacturer' => 'Boeing',
                'speed' => 840,
                'capacity' => 210,
                'price' => 12000000
            ]);

            Aircraft::create([
                'name' => 'Airbus A320neo',
                'family' => 'Airbus A320',
                'manufacturer' => 'Airbus',
                'speed' => 830,
                'capacity' => 180,
                'price' => 11000000
            ]);

            Aircraft::create([
                'name' => 'Airbus A350-900',
                'family' => 'Airbus A350',
                'manufacturer' => 'Airbus',
                'speed' => 910,
                'capacity' => 350,
                'price' => 15000000
            ]);

            Aircraft::create([
                'name' => 'Airbus A380-800',
                'family' => 'Airbus A380',
                'manufacturer' => 'Airbus',
                'speed' => 1020,
                'capacity' => 555,
                'price' => 20000000
            ]);

            Aircraft::create([
                'name' => 'Embraer E190-E2',
                'family' => 'E-Jet E2',
                'manufacturer' => 'Embraer',
                'speed' => 870,
                'capacity' => 114,
                'price' => 7000000
            ]);

            Aircraft::create([
                'name' => 'Embraer E175',
                'family' => 'E-Jet',
                'manufacturer' => 'Embraer',
                'speed' => 890,
                'capacity' => 88,
                'price' => 6000000
            ]);

            Aircraft::create([
                'name' => 'McDonnell Douglas DC-10',
                'family' => 'DC-10',
                'manufacturer' => 'McDonnell Douglas',
                'speed' => 875,
                'capacity' => 270,
                'price' => 5000000
            ]);

            Aircraft::create([
                'name' => 'McDonnell Douglas MD-11',
                'family' => 'MD-11',
                'manufacturer' => 'McDonnell Douglas',
                'speed' => 895,
                'capacity' => 293,
                'price' => 5500000
            ]);

            Aircraft::create([
                'name' => 'Boeing 787-9 Dreamliner',
                'family' => 'Boeing 787',
                'manufacturer' => 'Boeing',
                'speed' => 913,
                'capacity' => 296,
                'price' => 14500000
            ]);



            foreach ($users as $userData) {
                $user = User::create($userData);

                // setiap user join ke semua world
                foreach (GameWorld::all() as $world) {
                    $userWorld = UserWorld::create([
                        'user_id' => $user->id,
                        'world_id' => $world->id,
                        'money' => 8500000,
                    ]);


                    // bikin beberapa route
                    Route::create([
                        'user_world_id' => $userWorld->id,
                        'origin' => 'Jakarta',
                        'destination' => 'Singapore',
                    ]);

                    Route::create([
                        'user_world_id' => $userWorld->id,
                        'origin' => 'Bali',
                        'destination' => 'Tokyo',
                    ]);
                }
            }
        }
    }
}
