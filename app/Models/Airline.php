<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class airline extends Model
{
    //
    //
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'airlines';
    protected $fillable = [
        'user_id',
        'airline_name',
        'world_id',
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
