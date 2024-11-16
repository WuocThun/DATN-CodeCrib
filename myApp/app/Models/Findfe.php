<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Findfe extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'findfes';
    protected $fillable
        = [
            'title',
            'price',
            'description',
            'area',
            'contact_name',
            'contact_phone',
            'gender_rental',
            'image_path',
            'image',
        ];

}
