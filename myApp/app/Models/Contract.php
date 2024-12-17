<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'contracts';
    protected $fillable = [
        'motel_id',
        'user_id',
        'tenant_name',
        'owner_name',
        'start_date',
        'end_date',
        'contract_image',
        'contract_file',
        'status',
    ];
    public function tenant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function motel()
    {
        return $this->belongsTo(Motel::class, 'motel_id');
    }
}
