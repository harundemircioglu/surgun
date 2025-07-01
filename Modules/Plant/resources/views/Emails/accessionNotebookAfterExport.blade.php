@extends('dashboard::layouts.master')

@section('content')
    <h1>PATH</h1>
    <a download href="{{ asset($path) }}">İndir</a>
@endsection
