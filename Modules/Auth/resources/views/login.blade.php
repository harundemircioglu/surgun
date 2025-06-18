@extends('auth::layouts.master')

@section('content')
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button>Login</button>
    </form>
@endsection
