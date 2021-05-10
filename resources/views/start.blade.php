@extends('layouts.default')

@section('title','Start')
@section('header','Startseite')

@section('content')
    <div>
        <p>Das ist meine Startseite</p>
        <p>{{ $globalName }}</p>
    </div>
@endsection
