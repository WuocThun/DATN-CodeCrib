<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motel extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $table = 'motel';

    protected $fillable
        = [
            'user_id',
            'slug',
            'name',
            'money',
            'province',
            'district',
            'full_address',
            'default_electric',
            'default_water',
            'money_water',
            'money_electric',
            'money_wifi',
            'money_another',
            'money_date',
            'kind_motel',
            'status',
            'password',
            'total_member',
        ];
//    public function roomRequests()
//    {
//        return $this->belongsToMany(User::class, 'room_requests')
//                    ->withPivot('status')
//                    ->withTimestamps(); // Include pivot fields like 'status' and timestamps
//    }

    public function users()
    {
        return $this->hasMany(User::class, 'motel_id');
    }
    public function usersRequest()
    {
        return $this->belongsToMany(User::class, 'room_requests', 'motel_id', 'user_id')
                    ->withTimestamps();
    }
public function getInvoicesBy($id)
{
    $motelId = $id;
    $getInvoices = Invoice::where('motel_id', $motelId)->get();
    return $getInvoices;
}
        public function roomRequests()
    {
        return $this->hasMany(RoomRequest::class);
    }


    public function contracts()
    {
        return $this->hasMany(Contract::class, 'motel_id');
    }


    public function tenants()
    {
        return $this->hasManyThrough(
            User::class,          // Model bạn muốn lấy
            Contract::class,      // Model trung gian
            'motel_id',           // Khóa ngoại trong bảng `contracts`
            'id',                 // Khóa chính trong bảng `users`
            'id',                 // Khóa chính trong bảng `motels`
            'user_id'             // Khóa ngoại trong bảng `contracts`
        );
    }
//    public function invoices()
//    {
//        return $this->hasMany(Invoice::class, 'motel_id');
//    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}
