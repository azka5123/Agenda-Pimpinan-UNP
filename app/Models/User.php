<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

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
