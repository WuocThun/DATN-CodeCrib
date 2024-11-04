<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsClassification extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'rooms_classification';
    protected $fillable
        = [
            'room_id',
            'name',
            'description',
            'slug',
        ];
}
