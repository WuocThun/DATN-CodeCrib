<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $table = 'reviews';

    protected $fillable = [
        'user_id', 'name', 'email', 'rating', 'comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
