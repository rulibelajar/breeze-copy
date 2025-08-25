<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    //
    protected $fillable = [
        'name',
        'family',
        'manufacturer',
        'speed',
        'capacity',
        'price'
    ];

    protected $table = 'aircrafts';

    public function userWorld()
    {
        return $this->belongsTo(UserWorld::class);
    }
}
