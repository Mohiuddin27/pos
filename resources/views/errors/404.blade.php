@extends('errors.error_layout')

@section('title')
404 - Page Not Found
@endsection

@section('error-content')
    <h2>404</h2>
    <p>Sorry ! Page Not Found !</p>
    <a href="{{ route('dashboard.view') }}">Back to Dashboard</a> Or
    <a href="{{route('admin.login.view')}}">Login Again!</a>

@endsection