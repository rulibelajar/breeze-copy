<?php

namespace App\Models\AirlinesWorlds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AirlinesWorld2 extends Model
{
    //
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'airlines_world_2';
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
