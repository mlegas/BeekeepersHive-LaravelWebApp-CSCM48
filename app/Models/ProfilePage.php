<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePage extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo('\App\Models\Profile');
    }

    public function comments()
    {
        return $this->morphMany('\App\Comment', 'commentable');
    }
}
