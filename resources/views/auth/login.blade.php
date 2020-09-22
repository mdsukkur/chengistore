<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>M/S. CHENGI STORE</title>
    <link rel="icon" href="{{asset('ifm.png')}}" type="image/gif" sizes="32x32">
    <link rel="stylesheet" type="text/css" href="{{asset('authenticate/css/style.css')}}">
    {{--<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">--}}
    <script src="{{asset('authenticate/js/a81368914c.js')}}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<img class="wave" src="{{asset('authenticate/img/wave.svg')}}" alt="Wave">
<div class="container">
    <div class="img">
        <img src="{{asset('authenticate/img/bg.svg')}}" alt="Background">
    </div>
    <div class="login-content">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <img src="{{asset('authenticate/img/avatar.svg')}}" alt="Profile">

            <h2 class="title">Welcome</h2>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Email Address</h5>

                    <input type="hidden" name="loginform" value="1">

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="@if(old('loginform')) {{ old('email') }}@endif"
                           required autocomplete="email" autofocus>
                </div>
            </div>

            {{-- Email Error --}}
            @if(old('loginform'))
                @error('email')
                <span class="invalid-feedback" role="alert" style="color: red">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            @endif


            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" required autocomplete="current-password">
                </div>
            </div>

            @if(old('loginform'))
                @error('password')
                <span class="invalid-feedback" role="alert" style="color: red">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            @endif

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            @endif

            <input type="submit" class="btn" value="Login">
        </form>
    </div>
</div>
<script type="text/javascript" src="{{asset('authenticate/js/main.js')}}"></script>
</body>
</html>
