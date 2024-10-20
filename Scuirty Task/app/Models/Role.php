<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'Permission_Role');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
