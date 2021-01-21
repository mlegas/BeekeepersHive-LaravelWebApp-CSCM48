<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->action([PostController::class, 'index'])->with('status', 'Post successfully deleted!');
    }

    public function edit(Post $post)
    {
        $this->authorize('edit', $post);

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(5);

        foreach($posts as $post)
        {
            views($post)->cooldown(10)->record();
        }

        return view('posts.posts', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        views($post)->cooldown(10)->record();

        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'topic' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image'],
            'tags' => ['nullable', 'string', 'max:100'],
        ]);

        $post = new Post;
        $post->topic = $request->topic;
        $post->content = $request->content;

        if ($request->hasFile('image'))
        {
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        else
        {
            $post->image = null;
        }

        $post->profile_id = Auth::user()->profile->id;
        $post->save();

        if ($request->has('tags') && !empty($request->input('tags')))
        {
            $tagNames = explode(',', $request->get('tags'));

            foreach ($tagNames as $tagName)
            {
                $tagName = strtolower($tagName);
                $tagName = str_replace(' ', '', $tagName);

                $tag = Tag::firstOrCreate([
                    'name' => $tagName
                ]);

                if ($tag)
                {
                    $tag->post_id = $post->id;
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }

        return redirect()->action([PostController::class, 'index'])->with('status', 'Post successfully submitted!');
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'topic' => ['nullable', 'string', 'max:100'],
            'content' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'image'],
            'tags' => ['nullable', 'string', 'max:100'],
        ]);

        $post->topic = $request->topic;
        $post->content = $request->content;

        if ($request->has('topic') && !empty($request->input('topic')))
        {
            $post->topic = $request->topic;
        }

        if ($request->has('content') && !empty($request->input('content')))
        {
            $post->content = $request->content;
        }

        if ($request->hasFile('image'))
        {
            $path = $request->file('image')->store('images', 'public');
            $post->image = $path;
        }

        if ($request->has('tags') && !empty($request->input('tags')))
        {
            $tagNames = explode(',', $request->get('tags'));

            foreach ($tagNames as $tagName)
            {
                $tagName = strtolower($tagName);
                $tagName = str_replace(' ', '', $tagName);

                $tag = Tag::firstOrCreate([
                    'name' => $tagName
                ]);

                if ($tag)
                {
                    $tag->post_id = $post->id;
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }

        $post->profile_id = Auth::user()->profile->id;
        $this->authorize('edit', $post);
        $post->save();

        return redirect()->action([PostController::class, 'index'])->with('status', 'Post successfully edited!');
    }
}
