<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'department_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

        public function orders()
    {
        return $this->hasMany(Order::class, 'category_id');
    }
}
