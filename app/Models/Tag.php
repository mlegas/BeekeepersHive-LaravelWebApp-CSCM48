<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $attributes = ['name' => 'Default Tag',];

    // Creates a many to many relationship with Posts.
    public function posts()
    {
        return $this->belongsToMany('\App\Models\Post');
    }
}
