<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VIPPurchase extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vip_purchases';
    protected $fillable = ['room_id', 'user_id', 'vip_package_id', 'start_date', 'end_date', 'status'];

}
