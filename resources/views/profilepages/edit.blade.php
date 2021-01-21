@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset 2">
            <div class="card">
                <div class="card-header">{{ 'Edit your profile' }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profilepages.update', $profile_page) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3 text-sm-left">
                            You can change your profile details here to let other beekeepers know a little more about yourself.
                        </div>

                        <div class="form-group row">
                            <label for="name_displayed" class="col-md-4 col-form-label text-md-right">{{ 'Name to be displayed' }}</label>

                            <div class="col-md-6">
                                <input id="name_displayed" type="text" class="form-control @error('name_displayed') is-invalid @enderror" name="name_displayed" placeholder={{ $profile_page->profile->name_displayed }} value="{{ old('name_displayed') }}" autocomplete="name_displayed" autofocus>

                                @error('name_displayed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ 'Location' }}</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}">

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="biography" class="col-md-4 col-form-label text-md-right">{{ 'Biography' }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('biography') is-invalid @enderror" name="biography">{{ old('biography') }}</textarea>

                                @error('biography')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ 'Avatar' }}</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" name="avatar">

                                <div class="clearfix">
                                    <img src="{{ asset('storage/'.$profile_page->profile->avatar) }}" alt="Your avatar" width="200" class="pt-4">
                                        <div class="mt-1 mb-1 text-sm">
                                            Your current avatar is shown above.
                                        </div>
                                </div>

                                @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Finish updating your profile' }}
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
