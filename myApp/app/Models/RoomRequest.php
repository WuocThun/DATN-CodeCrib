<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'motel_id', 'status'];

    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với nhà trọ
    public function motel()
    {
        return $this->belongsTo(Motel::class);
    }
}
