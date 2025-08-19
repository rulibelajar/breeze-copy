<?php

namespace Database\Seeders;

use App\Models\GameWorld;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\World;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();

        User::factory()->create([
            'name' => 'Ricardo Simatupang',
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);
        // demgam ada

        World::create([
            'name' => 'Azeroth',
            'day_game' => 1,
            'last_day_change' => Carbon::now()->subMinutes(2),
            'next_day_change' => Carbon::now()->subSeconds(30),
            'is_active' => true
        ]);

        World::create([
            'name' => 'Middle Earth',
            'day_game' => 5,
            'last_day_change' => Carbon::now()->subMinutes(2),
            'next_day_change' => Carbon::now()->subSeconds(10),
            'is_active' => true

        ]);

        World::create([
            'name' => 'Westeros',
            'day_game' => 10,
            'last_day_change' => Carbon::now()->subMinutes(2),
            'next_day_change' => Carbon::now()->subSeconds(5),
            'is_active' => true
        ]);

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
    }
}
