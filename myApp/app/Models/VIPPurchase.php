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
    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
    public function vipPackage()
    {
        return $this->belongsTo(VipPackage::class, 'vip_package_id');
    }
}
