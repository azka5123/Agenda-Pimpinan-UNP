<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

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
