@extends('layouts.app')

@section('content')
<div class="container">
<form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">
                <div class="row"><h1>Edit Profile</h1></div>
                <div class="form-group row">
                    <label for="code" class="col-md-4 col-form-label">Code</label>

                    <input id="code"
                        type="text"
                        class="form-control @error('code') is-invalid @enderror"
                        name="code"
                        value="{{ old('code') ?? $user->profile->code }}"
                        autocomplete="code" autofocus>

                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group row">
                    <label for="public_data" class="col-md-4 col-form-label">Public Data</label>

                    <textarea
                        class="form-control @error('public_data') is-invalid @enderror"
                        name="public_data"
                        rows="10"
                        autocomplete="public_data" autofocus
                    >{{ old('public_data') ?? $user->profile->public_data }}</textarea>

                    @error('public_data')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group row">
                    <label for="private_data" class="col-md-4 col-form-label">Private Data</label>

                    <textarea
                        class="form-control @error('private_data') is-invalid @enderror"
                        name="private_data"
                        rows="10"
                        autocomplete="private_data" autofocus
                    >{{ old('private_data') ?? $user->profile->private_data }}</textarea>

                    @error('private_data')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-8 offset-2">
            <div class="row pt-5">
                <a href="/profile/{{ $user->id }}" class="btn btn-primary">View Profile</a>
            </div>
            <reset-login user-id="{{ $user->id }}"></reset-login>
        </div>
    </div>

</div>
@endsection
