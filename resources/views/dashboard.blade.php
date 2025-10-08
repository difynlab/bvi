@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="page dashboard">
        <div class="row">
            <div class="col-12">
                <p class="title">Welcome back, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <p class="description">Here's what's happening</p>
            </div>
        </div>
    </div>
@endsection