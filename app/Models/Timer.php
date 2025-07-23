<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    //
    protected $fillable = ['name', 'count', 'last_updated'];
    public $timestamps = true;
}
