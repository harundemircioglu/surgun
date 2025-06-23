@extends('auth::layouts.master')

@section('content')
    <form action="{{ route('auth.changeFirstPassword') }}" method="POST">
        @csrf
        <input type="password" name="password" placeholder="New Password" required>
        <input type="password" name="password_confirmation" placeholder="New Password Again" required>
        <button>Save</button>
    </form>
    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
@endsection
