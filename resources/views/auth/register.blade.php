@extends('layouts.app')
@section('content')
<style type="text/css">
    body {
      background:black url('public/stars.jpg');
      animation: stars 205s linear alternate;
  }
  #box {
    background:url('public/earth-2.jpg');
    filter: brightness(100%);
    background-size:cover;
    repeat: no-repeat;
    border-radius:50%;
    width:400px;
    height:400px;
    animation: movimiento 20s linear 0s infinite;
    box-shadow:0 0 25px rgba(99, 74, 74, 0.1),
    -8px -8px 15px #000 inset,
    2px 2px 25px #000 inset,
    -45px -45px 25px RGBA(0,0,0, 0.5) inset, 
    25px 25px 45px RGBA(0,0,0, 0.45) inset;
    margin:6em auto;
    transform:rotateX(6deg) rotateY(6deg) rotateZ(6deg);
}

@keyframes movimiento {
  0% { background-position:0 0 }
  100% { background-position:355px 0 }
}

@keyframes stars {
  0% { background-position:0 0 }
  100% { background-position:0 100% }
}
</style>
<div class="row align-items-center">
    <div class="col-md-6">
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row mb-3">

                    <div class="col-md-6 offset-4 text-end">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="name" class="col-md-2 h4 text-white">{{__('messages.name')}}</label>
                </div>

                <div class="row mb-3">

                    <div class="col-md-6 offset-4 text-end">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="email" class="col-md-2 h4 text-white">{{__('messages.email')}}</label>
                </div>

                <div class="row mb-3">

                    <div class="col-md-6 offset-4 text-end">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <label for="password" class="col-md-2 h4 text-white">{{__('messages.password')}}</label>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-4 text-end">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <label for="password-confirm" class="col-md-2 h4 text-white">{{__('messages.confirm_password')}}</label>
                </div>

                <div class="row mb-0 align-items-center ">
                    <div class="col-md-1 offset-4">
                        <button type="submit" class="btn-yellow fs-4">
                            {{__('messages.register')}}
                        </button>

                    </div>
                    <div class="col-md-2">

                        @if (Route::has('login'))
                        <div class="hidden sm:block">
                            @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                            @else
                            <a href="{{ route('login') }}" class="btn-red fs-4">{{__('messages.login')}}</a>
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6" id="box">
    </div>
</div>
@endsection
