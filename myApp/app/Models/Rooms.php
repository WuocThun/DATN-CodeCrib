<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $table = 'rooms';
    protected $fillable
        = [
            'user_id',
            'title',
            'slug',
            'status',
            'full_address',
            'description',
            'price',
            'rooms_class_id',
            'gender_rental',
            'area',
            'image',
            'video',
            'video_url',
            'vip_package_id',
            'phone_number',
            'vip_status',
        ];
    public function comments()
    {
        return $this->hasMany(Comment::class, 'room_id');
    }

    public function vipPurchases()
    {
        return $this->hasMany(VIPPurchase::class, 'room_id');
    }
    public function hasActiveVIP()
    {
        return $this->vipPurchases()
                    ->where('status', 'active')
                    ->where('end_date', '>=', now())
                    ->exists();
    }

    public function updateVIPStatus($vipPackageId)
    {
        $this->vip_package_id = $vipPackageId;
        $this->vip_status = 1; // Trạng thái kích hoạt VIP
        $this->save();
    }
    public function assignVIPBenefit($benefit)
    {
        $this->vipBenefits()->create([
            'vip_benefit_id' => $benefit->id,
            'enabled' => true,
        ]);
    }
    public function vipPackage()
    {
        return $this->belongsTo(VipPackage::class, 'vip_package_id');
    }
    public function vipBenefits()
    {
        return $this->belongsToMany(VipBenefits::class, 'room_vip_benefits')->withPivot('enabled');
    }
    public function deactivateVip()
    {
        $this->vip_status = 0;  // Đặt lại trạng thái VIP của phòng về 0 (thường)
        $this->vip_package_id = 1; // Đặt lại gói VIP của phòng về gói mặc định
        $this->save();
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    // Model Room
    public function utilities()
    {
        return $this->belongsToMany(Utility::class, 'room_utilities', 'room_id', 'utility_id');
    }

}
