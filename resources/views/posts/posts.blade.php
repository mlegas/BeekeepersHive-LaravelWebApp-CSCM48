@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Homepage' }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p> Welcome to the homepage of Beekeepers Hive. You can access the newest posts by scrolling down the page. </p>
                </div>
            </div>
        </div>
        @if ($posts->count())
            @foreach ($posts as $post)
                <div class="col-md-8 pt-4">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <strong>Topic: {{ $post->topic }}</strong>
                            </div>
                            <div>
                                <strong>Posted: {{ $post->created_at->diffForHumans() }} ({{ $post->created_at }})</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    {{-- // ADD A LINK TO AUTHOR AFTER IMPLEMENTING PROFILE PAGE FIX  --}}
                                    <p>Author: {{ $post->profile->name_displayed }} </p>
                                    <img class="img-fluid rounded w-50" src="{{ asset('storage/'.$post->profile->avatar) }}"/>
                                    <p class="mt-2">Total views: {{ views($post)->count() }}</p>
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
                                                <button type="submit" class="btn btn-primary"> View the post directly </button>
                                            </form>
                                        </div>
                                        @can('edit', $post)
                                        {{-- // FIX MAKE EDIT BY VUE --}}
                                        <div class="col">
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-secondary"> Edit Post </button>
                                            </form>
                                        </div>
                                        @endcan
                                        @can('delete', $post)
                                        <div class="col">
                                            <form action="{{ route('posts.destroy', $post) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"> Delete Post </button>
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
                                            <strong>Author: {{ $comment->profile->name_displayed }}</strong>
                                            <img class="img-fluid rounded w-50" src="{{ asset('storage/'.$comment->profile->avatar) }}"/>
                                            <p>Posted: {{ $comment->created_at->diffForHumans() }} ({{ $comment->created_at }})</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p> {{ $comment->content }} </p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="pt-4 d-flex justify-content-center align-items-center">
                {{ $posts->links() }}
            </div>
        @else
        <p> No posts have been found! Something has gone terribly wrong in the world. </p>
        @endif
    </div>
</div>
@endsection
