@extends('errors.error_layout')

@section('title')
    403 - Access Denied
@endsection

@section('error-content')
    <h2>403</h2>
    <p>Access to this resource on the server is denied</p>
    <hr>
    <p class="mt-2">
        {{ $exception->getMessage() }}
    </p>
    <a href="{{ route('dashboard.view') }}">Back to Dashboard</a> Or
    <a href="{{route('admin.login.view')}}">Login Again!</a>

@endsection