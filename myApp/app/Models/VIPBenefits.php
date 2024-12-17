<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VIPBenefits extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vip_benefits';
    protected $fillable = ['vip_package_id','style','name'];

    public function rooms()
    {
        return $this->belongsToMany(Rooms::class, 'room_vip_benefits');
    }
    public function packages()
    {
        return $this->belongsToMany(VIPPackage::class, 'vip_package_benefit', 'vip_benefit_id', 'vip_package_id');
    }
}
