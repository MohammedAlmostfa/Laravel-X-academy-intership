<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use NunoMaduro\Collision\Adapters\Laravel\Inspector;

class Course extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'start_date',
        'description',
        'instructor_id',

    ];
    public function instructors()
    {
        return $this->belongsTo(Instructor::class);
    }
    //public function scopeByInstructors($query)
    //{
    ///    return $query->whereHas('instructors');
    //}

    //   public function scopeWithoutInstructors($query)
    // {
    //return $query->whereDoesntHave('instructors');
    //   }

    public function Students()
    {
        return $this->belongsToMany(Student::class);
    }
}
