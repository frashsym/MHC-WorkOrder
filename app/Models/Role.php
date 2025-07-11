<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['role'];

    /**
     * Relasi dengan model User.
     * Satu role memiliki banyak user.
     */
    public function role()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
