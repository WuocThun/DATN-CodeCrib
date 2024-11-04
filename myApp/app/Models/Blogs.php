<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Auth;

class Blogs extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'blogs';
    protected $fillable
        = [
            'title',
            'slug',
            'description',
            'content',
            'image',
            'status',
            'user_id',
        ];

}
