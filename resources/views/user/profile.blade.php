<!-- resources/views/user/profile.blade.php -->
@extends('layout')

@section('content')
    <h2>User Profile</h2>
    <p>Name: {{ auth()->user()->name }}</p>
    <p>Email: {{ auth()->user()->email }}</p>
@endsection