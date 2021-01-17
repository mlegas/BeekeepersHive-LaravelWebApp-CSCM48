<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $attributes = ['name' => 'John Doe',
                            'email' => 'johndoe@johndoe.com',
                            'location' => 'Nowhere',];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function profilepage()
    {
        return $this->hasOne('\App\Models\ProfilePage');
    }

    // Creates a one to many relationship with Comments.
    public function comments()
    {
        return $this->hasMany('\App\Models\Comment');
    }

    // Creates a one to many relationship with Posts.
    public function posts()
    {
        return $this->hasMany('\App\Models\Post');
    }
}
