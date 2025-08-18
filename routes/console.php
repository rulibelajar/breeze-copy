<?php

use App\Models\GameWorld;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');




//Schedule::command('game:advance-day')->everyMinute();

Schedule::call(function () {
    GameWorld::query()->increment('day_game');
    //Buatkan untk column 'next_day_change' now ditambah 20 menit
    GameWorld::query()->update(['next_day_change' => Carbon::now()->addMinutes(10)]);
})->everyTenMinutes();
