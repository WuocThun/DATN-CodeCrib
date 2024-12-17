<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VIPPackage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vip_packages';
    protected $fillable = ['name', 'price', 'duration_days', 'boosted_views','tier'];
//    public function packages()
//    {
//        return $this->belongsToMany(VipPackage::class, 'vip_package_benefits', 'vip_benefit_id', 'vip_package_id');
//    }
    public function benefits()
    {
        return $this->belongsToMany(VIPBenefits::class, 'vip_package_benefit', 'vip_package_id', 'vip_benefit_id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class, 'vip_package_id');
    }

    public function getDisplayStyles()
    {
        return [
            'color' => $this->font_color,
            'fontWeight' => $this->font_weight,
            'textTransform' => $this->text_transform,
            'fontSize'=> $this->font_size,
        ];
    }
}
