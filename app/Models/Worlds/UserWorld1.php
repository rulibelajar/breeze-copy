<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Model;

class UserWorld1 extends Model
{
    //

    protected $table = 'user_world_1';
    protected $fillable = [
        'user_id',
        'airline_name',
        'day_game',
        'next_day_change',
    ];
}
