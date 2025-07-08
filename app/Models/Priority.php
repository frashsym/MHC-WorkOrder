<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';

    protected $fillable = ['priority'];

        public function orders()
    {
        return $this->hasMany(Order::class, 'priority_id');
    }
}
