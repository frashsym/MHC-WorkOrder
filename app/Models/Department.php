<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ['name'];

    /**
     * Relasi dengan model User.
     * Satu department memiliki banyak user.
     */
    public function user()
    {
        return $this->hasMany(User::class, 'department_id');
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'department_id');
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'department_id');
    }

}
