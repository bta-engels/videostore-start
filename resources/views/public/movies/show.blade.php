@extends('layouts.default')

@section('title','Movie')
@section('header', $movie->title)

@section('content')
    <div class="align-content-center">
        <h5>ID: {{ $movie->id }}</h5>
        <h6>Autor: {{ $movie->author->name }}</h6>
        <h6>Preis: {{ $movie->price }} €</h6>
        <h6>erstellt am: {{ $movie->created_at->format('d.m.Y H:i') }} Uhr</h6>
        <h6>geändert am: {{ $movie->updated_at->format('d.m.Y H:i') }} Uhr</h6>

        @if($movie->image)
            <img src="/storage/images/{{$movie->image}}" alt="{{$movie->image}}">
        @endif


    </div>
@endsection
