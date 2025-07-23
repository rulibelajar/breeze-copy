<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Timer;
use Carbon\Carbon;

class IncrementTimerCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment count every minute and store current timestamp';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $timers = Timer::all();

        foreach ($timers as $timer) {
            $timer->count += 1;
            $timer->last_updated = Carbon::now();
            $timer->save();

            $this->info("✅ '{$timer->name}' count incremented to {$timer->count}");
        }

        return self::SUCCESS;
    }
}
