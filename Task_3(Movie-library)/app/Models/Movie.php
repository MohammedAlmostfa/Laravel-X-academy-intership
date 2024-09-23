<?php

// Movie.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'description'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


    // Filter by genre
    public function scopeByGenre($query, $genre)
    {
        return $query->where('genre', $genre);
    }

    // Filter by director
    public function scopeByDirector($query, $director)
    {
        return $query->where('director', $director);
    }
}
