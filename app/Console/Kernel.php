<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\AdvanceGameDay::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Jalankan advance game day setiap 20 menit
        $schedule->command('game:advance-day')
            ->everyMinutes()
            ->withoutOverlapping()
            ->runInBackground();
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
