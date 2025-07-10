<?php

namespace App\Models;
use App\Models\Department;
use App\Models\Priority;
use App\Models\Category;
use App\Models\Progress;
use App\Models\Item;
use App\Models\User;
use App\Models\Pic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'department_id',
        'category_id',
        'item_id',
        'pic_id',
        'reporter',
        'title',
        'description',
        'photo',
        'date',
        'time',
        'progress_id',
        'priority_id',
    ];

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

    public function pic()
    {
        return $this->belongsTo(Pic::class, 'pic_id');
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
}
