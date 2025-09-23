@extends('layouts.guest')

@section('title', 'Login Your Account')

@section('content')
    <img src="{{ asset('storage/global/auth-1.png') }}" class="absolute-image absolute-image-1">
    <img src="{{ asset('storage/global/auth-2.png') }}" class="absolute-image absolute-image-2">
    <img src="{{ asset('storage/global/auth-3.png') }}" class="absolute-image absolute-image-3">
    <img src="{{ asset('storage/global/auth-4.png') }}" class="absolute-image absolute-image-4">
    <img src="{{ asset('storage/global/auth-5.png') }}" class="absolute-image absolute-image-5">

    <div class="container login">
        <div class="row page-auth">
            <div class="col-12 col-md-6 d-none d-md-block">
                <img src="{{ asset('storage/global/thumbnails/login.webp') }}" data-src="{{ asset('storage/global/login.webp') }}" alt="Login" class="image lazyload">
            </div>

            <div class="col-12 col-md-6 right">
                <h1 class="title">Login Your Account</h1>
                <p class="description">Login with your data that you entered during your registration</p>

                <form action="{{ route('login.store') }}" method="POST" class="form">
                    @csrf
                    <div class="mb-3 mb-md-4">
                        <label for="email" class="form-label label">Email Address</label>
                        <input type="email" class="form-control input-field" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                        <x-input-error field="email"></x-input-error>
                    </div>

                    <div class="mb-3 mb-md-4">
                        <div class="position-relative">
                            <label for="password" class="form-label label">Password</label>
                            <input type="password" class="form-control input-field" id="password" name="password" placeholder="Enter your password" required>
                            <span class="bi bi-eye-slash-fill toggle-password"></span>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3 mb-md-4">
                        <div class="col-6">
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" class="form-check-input checkbox" id="remember">
                                <label class="form-check-label remember" for="remember">Remember Me</label>
                            </div>
                        </div>

                        <div class="col-6 text-end">
                            <a href="{{ route('forgot-password') }}" class="forgot-password">Forgot Password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="submit-button">Login Now</button>
                </form>

                <p class="text">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="span-link">Register here</a>
                </p>
            </div>
        </div>
    </div>
@endsection