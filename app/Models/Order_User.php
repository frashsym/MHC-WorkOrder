<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_User extends Model
{
    use HasFactory;

    protected $table = 'order_user'; // pastikan sesuai sama nama tabel di DB

    protected $fillable = [
        'order_id',
        'user_id',
    ];

    // Relasi ke Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
