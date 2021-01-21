@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">
                    <div>
                        <strong>Profile page of: {{ $profilePa->topic }}</strong>
                    </div>
                    <div>
                        <strong>Posted: {{ $post->created_at->diffForHumans() }} ({{ $post->created_at }})</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div>
                                <strong>Author: <a href="{{ route('profilepages.show', ['profile_page' => $post->profile->profilePage]) }}">{{ $post->profile->name_displayed }}</a></strong>
                            </div>
                            <div>
                                <img class="img-fluid rounded w-50" src="{{ asset('storage/'.$post->profile->avatar) }}"/>
                            </div>
                            <div>
                            <p class="mt-2">Total views: {{ views($post)->count() }}</p>
                            <p>Unique views: {{ views($post)->unique()->count() }}</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <p> {{ $post->content }} </p>

                            @if ($post->image)
                                <img class="img-fluid rounded" src="{{ asset('storage/'.$post->image) }}"/>
                            @endif

                            @if ($post->tags()->get()->isNotEmpty())
                                Tags:
                                @foreach ($post->tags()->get() as $tag)
                                    {{ $tag->name }}
                                @endforeach
                            @endif
                            <div class="pt-4 row">
                                <div class="col">
                                    <form action="{{ route('posts.show', $post) }}" method="get">
                                        <button type="submit" class="btn btn-primary">View the post directly</button>
                                    </form>
                                </div>
                                @can('edit', $post)
                                <div class="col">
                                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary">Edit Post</button>
                                    </form>
                                </div>
                                @endcan
                                @can('delete', $post)
                                <div class="col">
                                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Post</button>
                                    </form>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h4 class="pt-4"> Comments ({{ $post->comments()->count() }}) </h4>
                        @if ($post->comments()->get()->isNotEmpty())
                            @foreach ($post->comments()->get() as $comment)
                                <div class="col-md-4">
                                    <div>
                                        <strong>Author: <a href="{{ route('profilepages.show', ['profile_page' => $comment->profile->profilePage]) }}">{{ $comment->profile->name_displayed }}</a></strong>
                                    </div>
                                    <div>
                                        <img class="img-fluid rounded w-50" src="{{ asset('storage/'.$comment->profile->avatar) }}"/>
                                    </div>
                                    <p>Posted: {{ $comment->created_at->diffForHumans() }} ({{ $comment->created_at }})</p>
                                </div>
                                <div class="col-md-8">
                                    <p> {{ $comment->content }} </p>
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('comments.post.store', ['post' => $post]) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">{{ 'Add a comment' }}</label>

                                <div class="col-md-8">
                                    <textarea rows="3" class="form-control @error('comment') is-invalid @enderror" name="comment" placeholder="Write a comment." required autofocus></textarea>

                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row mb-0 mt-4">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ 'Submit' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
