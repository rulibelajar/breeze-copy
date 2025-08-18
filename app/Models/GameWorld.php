<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameWorld extends Model
{
    //
    protected $fillable = [
        'name',
        'day_game',
        'next_day_change',
    ];
}
