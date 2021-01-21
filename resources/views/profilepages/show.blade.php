@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">
                    <div>
                        <strong>Profile page of {{ $profile_page->profile->name_displayed }}</strong>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div>
                                <strong>Name: {{ $profile_page->profile->name_displayed }} </strong>
                            </div>
                            <div>
                                <img class="img-fluid rounded w-50" src="{{ asset('storage/'.$profile_page->profile->avatar) }}"/>
                            </div>
                            <div>
                            <p class="mt-2">Total views of profile: {{ views($profile_page)->count() }}</p>
                            <p>Unique views of profile: {{ views($profile_page)->unique()->count() }}</p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div>
                                <strong> Bio: </strong> {{ $profile_page->biography }}
                            </div>
                            <div>
                                <strong> Location: </strong> {{ $profile_page->profile->location }}
                            </div>
                            <div class="pt-4 row">
                                @can('edit', $profile_page)
                                <div class="col">
                                    <form action="{{ route('profilepages.edit', $profile_page) }}" method="get">
                                        <button type="submit" class="btn btn-secondary">Edit Profile</button>
                                    </form>
                                </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h4 class="pt-4"> Comments ({{ $profile_page->comments()->count() }}) </h4>
                        @if ($profile_page->comments()->get()->isNotEmpty())
                            @foreach ($profile_page->comments()->get() as $comment)
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
                                    <div class="pt-4 row">
                                        @can('edit', $comment)
                                        <div class="col">
                                            <form action="{{ route('comments.profilepage.edit', $comment, $profile_page) }}" method="get">
                                                <button type="submit" class="btn btn-secondary">Edit Comment</button>
                                            </form>
                                        </div>
                                        @endcan
                                        @can('delete', $comment)
                                        <div class="col">
                                            <form action="{{ route('comments.destroy', $comment) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete Comment</button>
                                            </form>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <form method="POST" action="{{ route('comments.profilepage.store', ['profile_page' => $profile_page]) }}">
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
