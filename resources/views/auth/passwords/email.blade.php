@extends('layouts.app')

@section('content')

    <div class="container" id="container">

        <div class="form-container sign-in-container">

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <h1>Reset Password Link</h1>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <!-- Email -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror




                @if (Route::has('login'))
                    <a class="link" href="{{ route('login') }}">Sign in</a>
                @endif



                <button>Send Reset Link</button>
            </form>

        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <img class="side_image" src="{{asset('marketing-4646598_1280.png')}}" alt="IFM Center">
                </div>
            </div>
        </div>
    </div>

@endsection
