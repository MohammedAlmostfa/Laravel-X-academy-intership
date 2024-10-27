<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable=[
'Task_name',
'Description',
'Status',
'Due_time',
'User_id',

    ];
    protected $casts = [
'Task_name'=>'string',
'Description'=>'string',
'Status'=>'string',
'Due_time'=>'time',
'User_id'=>'integer',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
