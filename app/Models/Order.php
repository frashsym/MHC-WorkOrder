<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Priority;
use App\Models\Category;
use App\Models\Progress;
use App\Models\Item;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'title',
        'letter_number',
        'department_id',
        'category_id',
        'item_id',
        'pic',
        'reporter',
        'description',
        'create_date',
        'create_time',
        'started_at',
        'paused_at',
        'resume_at',
        'total_duration',
        'progress_id',
        'priority_id',
        'start_date',
        'due_date',
    ];

    protected static function booted()
    {
        static::created(function ($order) {
            // Jika belum ada letter_number, generate otomatis
            if (!$order->letter_number) {
                $order->update([
                    'letter_number' => 'ORD-' . str_pad($order->id, 5, '0', STR_PAD_LEFT),
                ]);
            }
        });
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function picUser()
    {
        return $this->belongsTo(User::class, 'pic');
    }

    public function reporterUser()
    {
        return $this->belongsTo(User::class, 'reporter');
    }

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'progress_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id');
    }

    public function manyPics()
    {
        return $this->belongsToMany(User::class, 'order_user', 'order_id', 'user_id');
    }

}
