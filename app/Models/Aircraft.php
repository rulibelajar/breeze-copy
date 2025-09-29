<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    protected $table = 'aircrafts';
    protected $fillable = [
        'aircraft_name',
        'is_active',
        'manufacturer',
        'capacity',
        'range_km',
    ];
}
