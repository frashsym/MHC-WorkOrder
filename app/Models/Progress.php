<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progresses';

    protected $fillable = ['status'];

        public function orders()
    {
        return $this->hasMany(Order::class, 'progress_id');
    }
}
