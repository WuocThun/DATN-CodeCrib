<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VIPPackage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vip_packages';
    protected $fillable = ['name', 'price', 'duration_days', 'boosted_views'];

}
