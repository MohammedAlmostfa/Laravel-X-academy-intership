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
    ];
    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructors_courses', 'course_id', 'instructor_id');
    }
    public function scopeByInstructors($query)
    {
        return $query->whereHas('instructors');
    }

    public function scopeWithoutInstructors($query)
    {
        return $query->whereDoesntHave('instructors');
    }

}
