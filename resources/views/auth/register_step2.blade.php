@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register Step 2 (Optional fields)') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.step2') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 text-gray-600 dark:text-gray-400 text-sm-left">
                            The following fields are optional and allow you to describe yourself a bit more. If you do not wish to specify any of these, just click the "Finish Registration" button down below.
                        </div>

                        <div class="form-group row">
                            <label for="name_displayed" class="col-md-4 col-form-label text-md-right">{{ __('Name to be displayed') }}</label>

                            <div class="col-md-6">
                                <input id="name_displayed" type="text" class="form-control @error('name_displayed') is-invalid @enderror" name="name_displayed" value="{{ old('name_displayed') }}" autocomplete="name_displayed" autofocus>

                                <div class="mt-1 mb-1 text-gray-600 dark:text-gray-400 text-sm">
                                    If you do not set a display name, your username will be used instead.
                                </div>

                                @error('name_displayed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="location" type="location" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}">

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="biography" class="col-md-4 col-form-label text-md-right">{{ __('Biography') }}</label>

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
                            <label for="biography" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" name="avatar">

                                <div class="clearfix">
                                    <img src="{{asset('/storage/avatars/defaultAvatar.jpg')}}" alt="Default avatar" width="200" class="pt-4">
                                        <p> If you choose to not upload your own avatar, the default one will be used, shown above. </p>
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
                                    {{ __('Finish Registration') }}
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
