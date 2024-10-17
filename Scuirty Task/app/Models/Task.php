<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable=[

        'title',
    'description',
    'type',
    'status',
    'priority',
    'due_date',
    'assigned_to',
];
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
