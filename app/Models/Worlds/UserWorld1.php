<?php

namespace App\Models\Worlds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserWorld1 extends Model
{
    //
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'user_world_1';
    protected $fillable = [
        'user_id',
        'airline_name',
        'day_game',
        'next_day_change',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
