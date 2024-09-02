@extends('layouts.app')
@section('content')

<style type="text/css">
    body {
        background: black url('public/stars.jpg');
        animation: stars 405s linear alternate;
        height: 100%;

    }

    #earth {
        background: url('public/earth-2.jpg');
        filter: brightness(100%);
        background-size: cover;
        repeat: no-repeat;
        border-radius: 50%;
        width: 400px;
        height: 400px;
        animation: movimiento 60s linear 0s infinite;
        box-shadow: 0 0 25px rgba(99, 74, 74, 0.1),
            -8px -8px 15px #000 inset,
            2px 2px 25px #000 inset,
            -45px -45px 25px RGBA(0, 0, 0, 0.5) inset,
            25px 25px 45px RGBA(0, 0, 0, 0.45) inset;
        margin: 6em auto;
        transform: rotateX(6deg) rotateY(6deg) rotateZ(6deg);
    }

    @keyframes movimiento {
        0% {
            background-position: 0 0
        }

        100% {
            background-position: 355px 0
        }
    }

    @keyframes stars {
        0% {
            background-position: 0 0
        }

        100% {
            background-position: 0 100%
        }
    }

    .main {
        display: flex;
        align-items: center;
        height: 100vh;
    }

    @media only screen and (min-width: 768px) {
        .logo {
            width: 200px !important;
        }

        #earth {
            width: 300px;
            height: 300px;
        }
    }

    @media only screen and (max-width: 768px) {
        .logo {
            width: 200px !important;
        }

        #earth {
            display: none;
        }
    }

    
    @media only screen and (max-width: 425px) {
        .logo {
            width: 150px !important;
        }

        #earth {
            display: none;
        }
    }
</style>

<div class="row main">
    <div class="col-md-4 col-sm-8 col-8 offset-2 offset-sm-2">
        <a class="navbar-brand mb-5" href="{{ url('/') }}">
            <img src="{{asset('./public/transparent-logo.png')}}" class="logo">
        </a>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">

                <div class="col-md-12 mb-3">
                    <input id="email" placeholder="{{__('messages.email')}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <!-- <label for="password" class="col-md-2 col-form-label text-md-end">{{ __('Password') }}</label> -->
                <div class="col-md-12">
                    <input id="password" placeholder="{{__('messages.password')}}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <!-- <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-12"> -->
            <button type="submit" class="btn btn-login">
                {{__('messages.login')}}
            </button>

            <!-- @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" text-sm btn btn-reg">{{__('messages.register')}}</a>
                    @endif

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </div> -->
        </form>
    </div>
    <div class="col-md-4 offset-1" id="earth"></div>
</div>

</div>
</div>

</div>
@endsection