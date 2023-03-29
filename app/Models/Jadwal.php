<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'keterangan', 'start_time', 'finish_time'
    ];

    public function rUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
