<?php

namespace App\Console;

use Illuminate\Support\Facades\Log;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\AdvanceGameDay::class,
        \App\Console\Commands\IncrementTimerCount::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Jalankan advance game day setiap 1 menit
        $schedule->command('game:advance-day')
            ->everyMinute()

            ->runInBackground();

        $schedule->command('timer:increment')
            ->everyMinute()
            ->before(function () {
                Log::info('[SCHEDULER] Before timer:increment');
            })
            ->after(function () {
                Log::info('[SCHEDULER] After timer:increment');
            });
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
