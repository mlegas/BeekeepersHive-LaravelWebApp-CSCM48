<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function storePost(Request $request, Post $post)
    {
        $this->validate($request, [
            'comment' => ['required', 'string', 'max:1500'],
        ]);

        $comment = new Comment;
        $comment->profile_id = Auth::user()->profile->id;
        $comment->commentable_id = $post->id;
        $comment->commentable_type = \App\Models\Post::class;
        $comment->content = $request->comment;
        $comment->save();

        return back()->with('status', 'Comment successfully submitted!');
    }
}
