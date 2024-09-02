<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'published_at',
        'category',
        'case',
    ];

    //filter by author
    public function scopebyAuthor($query, $author)
    {
        return $query->where('author', $author);
    }
    //filter by category
    public function scopebyCategory($query, $category)
    {
        return $query->where('category', $category);
    }
    //filter by category
    public function scopebyCase($query, $case)
    {
        return $query->where('case', $case);
    }
    
    public function rating()
    {
       
        return $this->hasMany(Rating::class);
       
    
       

    }

}
