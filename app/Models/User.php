<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use rakeshthapac\LaraTime\Traits\LaraTimeable;
use Thomasjohnkane\Snooze\Traits\SnoozeNotifiable;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, SnoozeNotifiable, LaraTimeable;

    protected $table = 'users';



    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'nama', 'jabatan', 'email', 'password', 'token'
    ];
    /**
     * Get all of the rJadwal for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rJadwal(): HasMany
    {
        return $this->hasMany(Jadwal::class);
    }
}
