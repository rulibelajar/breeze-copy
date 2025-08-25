<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    //
    protected $fillable = [
        'user_world_id',
        'origin',
        'destination',
    ];

    public function userWorld()
    {
        return $this->belongsTo(UserWorld::class);
    }
}
