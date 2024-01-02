@extends('layouts.app')
@section('content')
<div class="row login">
    <div class="col-md-12 d-flex flex-column justify-content-center align-items-center bg-login">
        <a class="navbar-brand mb-5" href="{{ url('/') }}">
            <img src="{{asset('geo-logo1.png')}}">
        </a>
        <form method="POST" action="{{ route('login') }}" >
            @csrf
            <div class="row">
                {{-- <label for="email" class="col-md-2 col-form-label text-md-end">{{ __('Email') }}</label> --}}

                <div class="col-md-12 mb-3">
                    <input id="email" placeholder="E-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{-- <label for="password" class="col-md-2 col-form-label text-md-end">{{ __('Password') }}</label> --}}
                <div class="col-md-12">
                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">



            </div>

            {{--                         <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div> --}}

            <div class="row mb-0">
                <div class="col-12">
                    <button type="submit" class="btn btn-login">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" text-sm btn btn-reg">Register</a>
                    @endif

                    {{--                                 @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif --}}
                </div>
            </div>
        </form>
    </div>
<!--     <div class="col-md-6 d-flex justify-content-center align-items-center bg-about">
        <h1>Hello</h1>
    </div>    -->
</div>

</div>
@endsection
