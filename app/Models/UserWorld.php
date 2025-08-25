<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWorld extends Model
{
    protected $fillable = ['user_id', 'world_id', 'money'];

    public function aircrafts()
    {
        return $this->hasMany(Aircraft::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
