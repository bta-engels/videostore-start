@extends('layouts.default')

@section('title','Start')
@section('header','Startseite')

@section('content')
    <div>
        <p>Das ist meine Startseite</p>
        <p>{{ $globalName }}</p>
        <p>active Route: {{ $activeRoute }}</p>
    </div>
@endsection
