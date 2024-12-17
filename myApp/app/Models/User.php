<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'balance',
        'password',
        'code',
        'card_id_number',
        'expire_at',
        'rand_code_user',
        'motel_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function deductBalance($amount)
    {
        $this->balance -= $amount;
        $this->save();
    }
    public function activateVIPStatus()
    {
        $this->is_vip = true;
        $this->save();
    }
    public function genarateCode()
    {
        $this->timestamps = false;
        $this->code       = rand(1000, 9999);
        $this->expire_at  = now()->addMinute(10);
        $this->save();
    }
    public  function restCode()
    {
        $this->timestamps = false;
        $this->code       = null;
        $this->expire_at  = null;
        $this->save();
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function motels_request()
    {
        return $this->belongsToMany(Motel::class, 'motel_user', 'user_id', 'motel_id')
                    ->withTimestamps();
    }

    public function motel()
    {
        return $this->belongsTo(Motel::class, 'motel_id');
    }
    public function roomRequests()
    {
        return $this->hasMany(RoomRequest::class);
    }
    public function motels()
    {
        return $this->belongsToMany(Motel::class, 'room_requests')
                    ->withPivot('status')
                    ->withTimestamps();
    }

}
