<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $fillable=[
        'SpecialtyName'
    ];
    //relation with istructor
    public function Instructor()
    {
        return $this->hasOne(Instructor::class);
    }
}
