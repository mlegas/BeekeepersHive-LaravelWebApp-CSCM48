<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\ProfilePage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->action([PostController::class, 'index'])->with('status', 'Comment successfully deleted!');
    }

    public function editPost(Comment $comment, Post $post)
    {
        $this->authorize('edit', $comment);

        return view('comments.editPost', [
            'comment' => $comment,
            'post' => $post
        ]);
    }

    public function editProfilePage(Comment $comment, ProfilePage $profile_page)
    {
        $this->authorize('edit', $comment);

        return view('comments.editProfilePage', [
            'comment' => $comment,
            'profile_page' => $profile_page
        ]);
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

    public function storeProfilePage(Request $request, ProfilePage $profile_page)
    {
        $this->validate($request, [
            'comment' => ['required', 'string', 'max:1500'],
        ]);

        $comment = new Comment;
        $comment->profile_id = Auth::user()->profile->id;
        $comment->commentable_id = $profile_page->id;
        $comment->commentable_type = \App\Models\ProfilePage::class;
        $comment->content = $request->comment;
        $comment->save();

        return back()->with('status', 'Comment successfully submitted!');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'content' => ['required', 'string', 'max:1500'],
        ]);

        $comment->profile_id = Auth::user()->profile->id;
        $comment->content = $request->content;

        $this->authorize('edit', $comment);
        $comment->save();

        return back()->with('status', 'Comment successfully edited!');
    }
}
