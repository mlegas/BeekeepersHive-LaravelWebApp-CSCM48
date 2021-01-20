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
                <div>
                    {{ $post->profile->name_displayed }} {{ $post->created_at }} {{ $post->topic }} {{ $post->content }} <img src="{{ '/storage/'. $post->profile->avatar }}"/>
                </div>
            @endforeach
        @else
        <p> There are no posts </p>
        @endif
    </div>
</div>
@endsection
