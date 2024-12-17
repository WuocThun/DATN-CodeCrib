<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'utilities';
    protected $fillable = ['name', 'description', 'icon'];
    public function rooms()
    {
        return $this->belongsToMany(Rooms::class, 'room_utilities', 'utility_id', 'room_id');
    }
}
