@extends('layouts.app')

@section('content')
    <div class="login">
        <div class="login-bg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                    <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>
                    <hr>

                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="name"> Name </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter username..." value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Email..." value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password***">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>

                        <p class="text-center"> Already Member <a href="{{ route('login') }}">Login</a> </p>

                        <hr>

                        <a href="/login/facebook" class="btn btn-block btn-primary" style="background-color: #3b5998"><span class="fab fa-facebook"></span> Facebook Register </a>
                        <a href="/login/google" class="btn btn-block btn-danger" style="background-color: #ea4335"><span class="fab fa-google"></span> Gmail Register </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
