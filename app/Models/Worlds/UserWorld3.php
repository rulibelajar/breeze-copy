<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Model;

class UserWorld3 extends Model
{
    //

    protected $table = 'user_world_3';
    protected $fillable = [
        'user_id',
        'airline_name',
        'day_game',
        'next_day_change',
    ];
}
