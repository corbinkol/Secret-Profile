@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <h1>{{ $user->name }}'s Profile</h1>

        @can('update', $user->profile)
            <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
        @endcan
    </div>
    <hr />
    <div class="mb-5">
        <h2>Public Information</h2>
        {{ $user->profile->public_data }}
    </div>
    <div>
        <h2>Private Information</h2>
        @if ($access_blocked === FALSE)
            <form action="/profile/{{ $user->id }}" method="post" class="mb-5">
                @csrf
                @method('PATCH')
                <label>Enter the code to see user's secret message <br /><input class="form-control {{ $login_attempts != 0 ? 'is-invalid' : '' }}" type="text" name="visitor_code" id="visitor_code" />
                @if($login_attempts != 0)
                    <div class="invalid-feedback">
                        {{$login_attempts}} login attempts left.
                    </div>
                @endif
                </label>
                <br />
                <input type="submit" value="Enter" />
            </form>
        @else
            <p class="text-danger">Login attempts have been exceeded</p>
        @endif
        @if ($access_granted)
            {{ $user->profile->private_data }}
        @endif
    </div>
</div>
@endsection
