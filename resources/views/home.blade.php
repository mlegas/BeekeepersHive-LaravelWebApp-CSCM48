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
                <div class="col-md-8 pt-5">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <strong>Topic: {{ $post->topic }}</strong>
                            </div>
                            <div>
                                <strong>Posted at: {{ $post->created_at }}</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p>Author: {{ $post->profile->name_displayed }} </p>
                                    <img class="img-fluid rounded w-50" src="{{ 'storage/'. $post->profile->avatar }}"/>
                                </div>
                                <div class="col-md-8">
                                    <p> {{ $post->content }} </p>

                                    @if ($post->image)
                                        <img class="img-fluid rounded" src="{{ 'storage/'. $post->image }}"/>
                                    @endif

                                    @if ($post->tags()->get()->isNotEmpty())
                                        Tags:
                                        @foreach ($post->tags()->get() as $tag)
                                            {{ $tag->name }}
                                        @endforeach
                                    @endif

                                    <p class="float-right"> Comments (0) </p>
                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <p> No posts have been found! Something has gone terribly wrong in the world. </p>
        @endif
    </div>
</div>
@endsection
