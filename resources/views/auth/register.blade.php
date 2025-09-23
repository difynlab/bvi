@extends('layouts.guest')

@section('title', 'Registration')

@section('content')
    <img src="{{ asset('storage/global/auth-1.png') }}" class="absolute-image absolute-image-1">
    <img src="{{ asset('storage/global/auth-2.png') }}" class="absolute-image absolute-image-2">
    <img src="{{ asset('storage/global/auth-3.png') }}" class="absolute-image absolute-image-3">
    <img src="{{ asset('storage/global/auth-4.png') }}" class="absolute-image absolute-image-4">
    <img src="{{ asset('storage/global/auth-5.png') }}" class="absolute-image absolute-image-5">

    <div class="container register">
        <div class="row page-auth">
            <div class="col-12 col-md-6 d-none d-md-block">
                <img src="{{ asset('storage/global/thumbnails/registration.webp') }}" data-src="{{ asset('storage/global/registration.webp') }}" alt="Registration" class="image lazyload">
            </div>

            <div class="col-12 col-md-6 right">
                <h1 class="title">Registration Form</h1>
                <p class="description">Fill out this quick form and get started with your complete experience with us.</p>

                <form action="{{ route('register') }}" method="POST" class="form">
                    @csrf
                    <div class="row mb-0 mb-md-4">
                        <div class="col-12 mb-3 mb-md-0 col-md-6">
                            <label for="firstName" class="form-label label">First Name</label>
                            <input type="text" class="form-control input-field" id="firstName" name="first_name" value="{{ old('first_name') }}" placeholder="Enter your first name" required>
                            <x-input-error field="first_name"></x-input-error>
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-6">
                            <label for="lastName" class="form-label label">Last Name</label>
                            <input type="text" class="form-control input-field" id="lastName" name="last_name" value="{{ old('last_name') }}" placeholder="Enter your last name" required>
                            <x-input-error field="last_name"></x-input-error>
                        </div>
                    </div>

                    <div class="row mb-0 mb-md-4">
                        <div class="col-12 mb-3 mb-md-0 col-md-6">
                            <label for="email" class="form-label label">Email Address</label>
                            <input type="text" class="form-control input-field" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address" required>
                            <x-input-error field="email"></x-input-error>
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-6">
                            <label for="phone" class="form-label label">Phone</label>
                            <input type="text" class="form-control input-field" id="phone" name="phone" placeholder="Enter your phone number" value="{{ old('phone') }}">
                            <x-input-error field="phone"></x-input-error>
                        </div>
                    </div>

                    <div class="row mb-0 mb-md-4">
                        <div class="col-12 mb-3 mb-md-0 col-md-6">
                            <div class="position-relative">
                                <label for="password" class="form-label label">Password</label>
                                <input type="password" class="form-control input-field" id="password" name="password" placeholder="Enter your password" required>
                                <span class="bi bi-eye-slash-fill toggle-password"></span>
                                <x-input-error field="password"></x-input-error>
                            </div>
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-6">
                            <div class="position-relative">
                                <label for="passwordConfirmation" class="form-label label">Confirm Password</label>
                                <input type="password" class="form-control input-field" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm your password" required/>
                                <span class="bi bi-eye-slash-fill toggle-password"></span>
                                <x-input-error field="password_confirmation"></x-input-error>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-button">Register Now</button>

                    <p class="text">
                        Already have an account?
                        <a href="{{ route('login') }}" class="span-link">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection