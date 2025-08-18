<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Carbon\Carbon;

/**
 * @property Carbon $next_day_change
 * @property Carbon $last_day_change
 */

/**
 * @property int $id
 * @property string $name
 * @property int $day_game
 * @property \Carbon\Carbon|null $last_day_change
 * @property \Carbon\Carbon|null $next_day_change
 * @property bool $is_active
 */

class World extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'day_game',
        'last_day_change',
        'next_day_change',
        'is_active'
    ];

    protected $casts = [
        'last_day_change' => 'datetime',
        'next_day_change' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Advance ke hari berikutnya
    public function advanceDay(): void
    {
        if ($this->day_game < 90) {
            $this->day_game++;
            $this->last_day_change = Carbon::now();
            $this->next_day_change = Carbon::now()->addMinutes(20); // Ubah ke 20 menit
            $this->save();
        }
    }

    // Cek apakah sudah waktunya ganti hari
    public function shouldAdvanceDay(): bool
    {
        return $this->is_active &&
            $this->day_game < 90 &&
            Carbon::now()->gte($this->next_day_change);
    }

    // Dapatkan tanggal fantasy berdasarkan day_game
    public function getFantasyDate(): array
    {
        $startDate = Carbon::create(2024, 1, 1); // Tanggal mulai fantasy
        $fantasyDate = $startDate->addDays($this->day_game - 1);

        return [
            'day' => $fantasyDate->format('d'),
            'month' => $fantasyDate->format('F'),
            'year' => $fantasyDate->format('Y'),
            'day_name' => $fantasyDate->format('l'),
            'formatted' => $fantasyDate->format('l, d F Y'),
            'day_game' => $this->day_game,
            'remaining_days' => 90 - $this->day_game,
            'next_change_in_seconds' => $this->next_day_change->diffInSeconds(Carbon::now())
        ];
    }

    // Dapatkan progress game dalam persen
    public function getGameProgress(): float
    {
        return ($this->day_game / 90) * 100;
    }

    // Cek apakah game sudah selesai
    public function isGameCompleted(): bool
    {
        return $this->day_game >= 90;
    }

    // Reset world ke hari 1
    public function resetWorld(): void
    {
        $this->day_game = 1;
        $this->last_day_change = Carbon::now();
        $this->next_day_change = Carbon::now()->addMinutes(20); // Ubah ke 20 menit
        $this->is_active = true;
        $this->save();
    }
}
