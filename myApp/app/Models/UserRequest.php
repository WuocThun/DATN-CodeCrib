<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;
    protected $table = 'user_requests';
    public $timestamps = false;

    protected $fillable
        = [
            'user_id',
            'motel_id',
            'title',
            'status',
            'image',
            'description',
        ];
    public function motel()
    {
        return $this->belongsTo(Motel::class, 'motel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
