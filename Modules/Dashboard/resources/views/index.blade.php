@extends('dashboard::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('dashboard.name') !!}</p>

    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
@endsection
