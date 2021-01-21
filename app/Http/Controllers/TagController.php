<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts;

        foreach($posts as $post)
        {
            views($post)->cooldown(10)->record();
        }

        return view('tags.show', [
            'posts' => $posts,
            'tag' => $tag,
        ]);
    }
}
