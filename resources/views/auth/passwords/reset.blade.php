@extends('layouts.app')

@section('content')

    <div class="container" id="container">

        <div class="form-container sign-in-container">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <h1>Reset Password</h1>


                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror



                <!-- Password -->
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror


                <!-- Confirm Password -->
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">


                <button>Reset Password</button>
            </form>

        </div>


        <div class="overlay-container">
            <div class="overlay">
                {{--<div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>--}}
                <div class="overlay-panel overlay-right">
                    {{--<h1>Hello, Friend!</h1>--}}
                    {{--<p>Enter your Email details and start journey with us</p>--}}
                    {{--<button class="ghost" id="signUp">Sign Up</button>--}}

                    <img class="side_image" src="{{asset('marketing-4646598_1280.png')}}" alt="IFM Center">
                </div>
            </div>
        </div>
    </div>

@endsection
