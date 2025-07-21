<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\World;
use Illuminate\Support\Facades\Log;

class AdvanceGameDay extends Command
{
    protected $signature = 'game:advance-day';
    protected $description = 'Advance game day for all active worlds';

    public function handle(): int
    {
        $worlds = World::where('is_active', true)->get();

        foreach ($worlds as $world) {
            if ($world->shouldAdvanceDay()) {
                $oldDay = $world->day_game;
                $world->advanceDay();

                $this->info("World '{$world->name}' advanced from day {$oldDay} to day {$world->day_game}");
                Log::info("World {$world->id} advanced from day {$oldDay} to day {$world->day_game}");

                // Broadcast event untuk update real-time (opsional)
                // broadcast(new GameDayAdvanced($world));
            }
        }

        return self::SUCCESS;
    }
}
