<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomVipBenefit extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'room_vip_benefits';
    protected $fillable = ['rooms_id','vip_benefit_id','enabled'];
    public function rooms()
    {
        return $this->belongsToMany(Rooms::class, 'room_vip_benefits');
    }
}
