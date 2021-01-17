<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $attributes = ['content' => 'Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit.',];

    // Creates a polymorphic relationship to use with Posts and ProfilePages.
    public function commentable()
    {
        return $this->morphTo();
    }

    // Creates a one to many relationship with Users.
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
}
