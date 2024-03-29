@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Change your post' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="topic" class="col-md-4 col-form-label text-md-right">{{ 'Topic' }}</label>

                            <div class="col-md-6">
                                <textarea rows="3" class="form-control @error('topic') is-invalid @enderror" name="topic" placeholder="Write a new topic. Leave this field blank to use the old one." autofocus>{{ old('topic') }}</textarea>

                                @error('topic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ 'Content' }}</label>

                            <div class="col-md-6">
                                <textarea rows="10" class="form-control @error('content') is-invalid @enderror" name="content" placeholder="Write new content for this post. Leave this field blank to use the old one.">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ 'Tags' }}</label>

                            <div class="col-md-6">
                                <textarea rows="3" class="form-control @error('tags') is-invalid @enderror" name="tags" placeholder="Here you can specify tags if your post relates to any specific topics. Separate them by using commas, not spaces. In case of multiple words, use dashes.">{{ old('tags') }}</textarea>

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ 'Image' }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Submit post' }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
