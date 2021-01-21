@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ 'Change your comment' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comments.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">{{ 'Content' }}</label>

                            <div class="col-md-6">
                                <textarea rows="10" class="form-control @error('content') is-invalid @enderror" name="content" placeholder={{  "Write new content for this comment. Leave this field blank to use the old one." }}>{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Submit comment' }}
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
