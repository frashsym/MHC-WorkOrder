<?php

namespace App\Models;
use App\Models\Device;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'department_id',
        'category_id',
        'object_id',
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

    public function object()
    {
        return $this->belongsTo(Device::class, 'object_id');
    }

    public function pic()
    {
        return $this->belongsTo(Pic::class, 'pic_id');
    }

    public function reporter()
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
