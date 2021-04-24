@extends('layouts.default')

@section('title','Autor')
@section('header','Autor')

@section('content')
    <div class="align-content-center">
        <h5>{{ $author->id }} {{ $author }}</h5>
        <h6>Anzahl Filme: {{ $author->movies->count() }}</h6>
        <div>
            <!-- gib alle movie titel aus -->
            <h5>Filme</h5>
            <ul class="list-group-flush">
                @forelse ($author->movies as $movie)
                    <li class="list-group-item">{{ $movie->title }}</li>
                @empty
                    <p>Keine Filme vorhanden</p>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
