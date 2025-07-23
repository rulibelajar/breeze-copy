<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    DB::table('timers')->insert([
        'name' => 'Youtube Tutorial',
        'count' => rand(1, 10),
        'last_updated' => now(),
    ]);
})->everyMinute();


Schedule::command('game:advance-day')->everyMinute();
