<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDependencies extends Model
{
    use HasFactory;
    protected $fillable=[
        'task_id',
    'task_depend_on'
];
    public function dependenciestask()
    {
        return $this->belongsTo(Task::class);
    }
    public function dependentstask()
    {
        return $this->belongsTo(Task::class);
    }
}
