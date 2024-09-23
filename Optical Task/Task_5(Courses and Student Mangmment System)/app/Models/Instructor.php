<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'experience',
        'specialty'
    ];
    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty');
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function scopeBycourses($query)
    {
        return $query->whereHas('courses');
    }
    public function scopeWithoutcourses($query)
    {
        return $query->whereDoesntHave('courses');
    }
    public function students()
    {
        return $this->hasManyThrough(Student::class, Course::class, 'instructor_id', 'id', 'id', 'id');
    }

}
