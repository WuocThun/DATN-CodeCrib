<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'order_payment';
    protected $fillable
        = [
            'amount',
            'description',
            'payment_status',
            'order_code',
            'user_id',
        ];
}
