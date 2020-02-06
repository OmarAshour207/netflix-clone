@extends('layouts.app')

@section('content')
    <div class="login">

        <div class="login__bg"></div>

        <div class="container">
            <div class="row">

                <div class="col-10 mx-auto col-md-6 bg-white mx-auto p-3">
                    <h2 class="text-center">Netflix<span class="text-primary">ify</span></h2>

                    <hr>

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @method('post')

                        @include('dashboard.partials._errors')

                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email..." value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password***">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Login </button>
                        </div>

                        <p class="text-center"> Create new account <a href="{{ route('register') }}">Register</a> </p>

                        <hr>

                        <a href="/login/facebook" class="btn btn-block btn-primary" style="background-color: #3b5998"><span class="fab fa-facebook"></span> Facebook Login </a>

                        <a href="/login/google" class="btn btn-block btn-danger" style="background-color: #ea4335"><span class="fab fa-google"></span> Gmail Login </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
