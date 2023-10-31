@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-8 offset-3" style="margin-top:180px; ">
            <form method="POST" action="{{ route('login') }}" >
                @csrf
                <div class="row mb-3">
                    {{-- <label for="email" style="color: #6411a5;font-weight: bold;font-weight: bold;" class="col-md-2 col-form-label text-md-end">{{ __('Email') }}</label> --}}

                    <div class="col-md-6">
                        <input id="email" placeholder="E-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    {{-- <label for="password" style="color: #6411a5;font-weight: bold;font-weight: bold;" class="col-md-2 col-form-label text-md-end">{{ __('Password') }}</label> --}}

                    <div class="col-md-6">
                        <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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
                            <div class="col-4 offset-2">
                                <button type="submit" class="btn btn-primary px-5">
                                    {{ __('Login') }}
                                </button>

{{--                                 @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endsection
