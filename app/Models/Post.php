<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $attributes = ['content' => 'Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit.',
                            'topic' => 'Lorem ipsum';

    // Creates a polymorphic one to many relationship with Comments.
    public function comments()
    {
        return $this->morphMany('\App\Models\Comment', 'commentable');
    }

    // Creates a many to many relationship with Tags.
    public function tags()
    {
        return $this->belongsToMany('\App\Models\Tag');
    }

    // Creates a one to many relationship with Users.
    public function profile()
    {
        return $this->belongsTo('\App\Models\Profile');
    }
}
