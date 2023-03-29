<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Jadwal extends Model
{
<<<<<<< HEAD
    use HasFactory;

    protected $fillable = [
        'user_id', 'keterangan', 'start_time', 'finish_time'
    ];

=======
    use HasFactory, HasApiTokens;
    protected $fillable = [
        'user_id', 'keterangan', 'start_time', 'finish_time'
    ];
>>>>>>> 064776835ff978095c690bec468f8eb4951219a4
    public function rUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
