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

        User::factory()->create([
            'name' => 'Ruli User',
            'username' => 'user',
            'email' => 'user@example.com',
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
