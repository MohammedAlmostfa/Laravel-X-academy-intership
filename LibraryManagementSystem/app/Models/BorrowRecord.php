<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowrecord extends Model
{
    use HasFactory;
    protected $fillable = [
    'book_id',
    'user_id',
    'borrowed_at',
    'due_date',
    'returned_at',
    ];

}
