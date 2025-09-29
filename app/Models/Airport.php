<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    //
    protected $table = 'airports';

    protected $fillable = [
        'iata_code',
        'icao_code',
        'name',
        'city',
        'country',
        'latitude',
        'longitude',
    ];
}
