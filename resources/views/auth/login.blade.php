@extends('layouts.app')

@section('title' , 'Login')

@section('content')
<!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('login') }}" method="POST">
                @csrf
                    <div class="login-form-head">
                        <h4>Log in</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <input name="email" type="email" placeholder="Email Address">
                            @error('email')
                                <span class="valid-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                        <div class="form-gp">
                            <input name="password" type="password" placeholder="Password">
                            @error('password')
                                <span class="valid-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror  
                        </div>
                        <div class="submit-btn-area">
                            <button type="submit">Login</button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- login area end -->
@endsection
