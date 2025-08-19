<?php

use App\Models\GameWorld;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    Log::info('=== Game World Update Started ===');

    try {
        $worlds = GameWorld::all();
        Log::info('Found ' . $worlds->count() . ' game worlds');

        foreach ($worlds as $world) {
            Log::info('Updating world ID: ' . $world->id);

            // tambah 1 hari pada game_date
            $world->game_date = Carbon::parse($world->game_date)->addDay();

            // tambah 1 hari pada day_game
            $world->game_day++;

            // update next_day_change = sekarang + 10 menit
            $world->next_day_change = Carbon::now()->addMinutes(10);

            $world->save();

            Log::info('World ID ' . $world->id . ' updated successfully');
        }

        Log::info('=== Game World Update Completed ===');
    } catch (\Exception $e) {
        Log::error('Game World Update Error: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
    }
})->everyTenMinutes();
