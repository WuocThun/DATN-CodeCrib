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
        ];
    public function vipPurchases()
    {
        return $this->hasMany(VIPPurchase::class);
    }
    public function hasActiveVIP()
    {
        return $this->vipPurchases()
                    ->where('status', 'active')
                    ->where('end_date', '>=', now())
                    ->exists();
    }
}
