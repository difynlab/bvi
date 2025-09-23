@extends('layouts.guest')

@section('title', 'Change Password')

@section('content')
    <img src="{{ asset('storage/global/auth-1.png') }}" class="absolute-image absolute-image-1">
    <img src="{{ asset('storage/global/auth-2.png') }}" class="absolute-image absolute-image-2">
    <img src="{{ asset('storage/global/auth-3.png') }}" class="absolute-image absolute-image-3">
    <img src="{{ asset('storage/global/auth-4.png') }}" class="absolute-image absolute-image-4">
    <img src="{{ asset('storage/global/auth-5.png') }}" class="absolute-image absolute-image-5">

    <div class="container reset-password">
        <div class="row page-auth">
            <div class="col-12 col-md-6 d-none d-md-block">
                <img src="{{ asset('storage/global/thumbnails/login.webp') }}" data-src="{{ asset('storage/global/login.webp') }}" alt="Login" class="image lazyload">
            </div>

            <div class="col-12 col-md-6 right">
                <h1 class="title">Change Password</h1>
                <p class="description">Need a new password? Fill in the details below to update it.</p>

                <form action="{{ route('reset-password.store') }}" method="POST" class="form">
                    @csrf
                    <div class="mb-3 mb-md-4">
                        <div class="position-relative">
                            <label for="password" class="form-label label">New Password</label>
                            <input type="password" class="form-control input-field" id="password" name="password" placeholder="Enter your new password" required>
                            <span class="bi bi-eye-slash-fill toggle-password"></span>
                            <x-input-error field="password"></x-input-error>
                        </div>
                    </div>

                    <div class="mb-3 mb-md-4">
                        <div class="position-relative">
                            <label for="passwordConfirmation" class="form-label label">Confirm Password</label>
                            <input type="password" class="form-control input-field" id="passwordConfirmation" name="password_confirmation" placeholder="Confirm your password" required/>
                            <span class="bi bi-eye-slash-fill toggle-password"></span>
                            <x-input-error field="password_confirmation"></x-input-error>
                        </div>
                    </div>

                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                    <button type="submit" class="submit-button">Update Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection