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
'Result',

    ];
    protected $casts = [
'Task_name'=>'string',
'Description'=>'string',
'Status'=>'string',

'User_id'=>'integer',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeByTask($query, $data)
    {
        if ($data === null) {
            return $query->select(['id', 'Task_name', 'Description', 'Due_time'])
                         ->where('Status', null)
                         ->get();
        } elseif ($data === 'finished') {
            return $query->select(['id', 'Task_name', 'Description', 'Due_time', 'result'])
                         ->where('Status', 'finished')
                         ->get();
        }
    }
}
