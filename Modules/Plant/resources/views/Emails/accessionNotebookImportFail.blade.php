@extends('dashboard::layouts.master')

@section('content')
    <ul>
        @foreach ($errors as $error)
            <li>Satır: {{ $error['row'] }}, Sütun: {{ $error['attribute'] }}, Hata:
                {{ implode(', ', $error['errors']) }}</li>
        @endforeach
    </ul>
@endsection
