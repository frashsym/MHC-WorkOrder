<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'role_id',
        'email',
        'department_id',
        'password',
    ];

    // Cara menguhubungkan dengan model Role dan Department
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function picOrders()
    {
        return $this->hasMany(Order::class, 'pic');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'reporter');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
}
