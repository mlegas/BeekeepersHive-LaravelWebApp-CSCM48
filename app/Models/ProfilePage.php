<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class ProfilePage extends Model implements Viewable
{
    use HasFactory, InteractsWithViews;

    public function profile()
    {
        return $this->belongsTo('\App\Models\Profile');
    }

    public function comments()
    {
        return $this->morphMany('\App\Models\Comment', 'commentable');
    }
}
