<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    use HasFactory;

    public $timestamps = false;
    protected $table = 'comments';
    protected $fillable
        = [
            'user_id',
            'motel_id',
            'room_id',
            'content',
            'content',
            'rating',
        ];
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
