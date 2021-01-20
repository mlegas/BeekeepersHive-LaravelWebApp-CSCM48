<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\Tag;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profile.completed', 'verified']);
    }

    public function index()
    {
        return view('post');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'topic' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'size:20480'],
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

        return redirect()->action([HomeController::class, 'index'])->with('status', 'Post successfully submitted!');
    }
}
