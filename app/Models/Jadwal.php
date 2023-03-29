<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Jadwal extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id', 'keterangan', 'start_time', 'finish_time'
    ];

    protected $table = 'jadwals';

    protected $guarded = [
        'id'
    ];
    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
