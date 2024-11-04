<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'room_image';
    protected $fillable
        = [
            'room_id',
            'image',
        ];
}
