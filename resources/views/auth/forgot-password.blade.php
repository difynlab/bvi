@extends('layouts.guest')

@section('title', 'Forgot Your Password')

@section('content')
    <img src="{{ asset('storage/global/auth-1.png') }}" class="absolute-image absolute-image-1">
    <img src="{{ asset('storage/global/auth-2.png') }}" class="absolute-image absolute-image-2">
    <img src="{{ asset('storage/global/auth-3.png') }}" class="absolute-image absolute-image-3">
    <img src="{{ asset('storage/global/auth-4.png') }}" class="absolute-image absolute-image-4">
    <img src="{{ asset('storage/global/auth-5.png') }}" class="absolute-image absolute-image-5">

    <div class="container forgot-password">
        <div class="row page-auth">
            <div class="col-12 col-md-6 d-none d-md-block">
                <img src="{{ asset('storage/global/thumbnails/registration.webp') }}" data-src="{{ asset('storage/global/registration.webp') }}" alt="Registration" class="image lazyload">
            </div>

            <div class="col-12 col-md-6 right">
                <h1 class="title">Forgot Your Password</h1>
                <p class="description">Don't worry! Resetting your password is easy.</p>

                <form action="{{ route('forgot-password.store') }}" method="POST" class="form">
                    @csrf
                    <div class="mb-3 mb-md-4">
                        <label for="email" class="form-label label">Email Address</label>
                        <input type="email" class="form-control input-field" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                        <x-input-error field="email"></x-input-error>
                    </div>

                    <button type="submit" class="submit-button">Send Now</button>
                </form>

                <p class="text">
                    Did you remember your password?
                    <a href="{{ route('login') }}" class="span-link">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection