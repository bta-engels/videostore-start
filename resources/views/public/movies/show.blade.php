@extends('layouts.default')

@section('title','Film')
@section('header','Film')

@section('content')
    <div class="align-content-center">
        <h5>{{ $movie->id }} {{ $movie }}</h5>
        <h6>Autor: {{ $movie->author }}</h6>
        <b>Preis: {{ $movie->price }} €</b>
{{--        <div>--}}
{{--            <!-- gib alle movie titel aus -->--}}
{{--            <h5>Filme</h5>--}}
{{--            <ul class="list-group-flush">--}}
{{--                @forelse ($author->movies as $movie)--}}
{{--                    <li class="list-group-item">{{ $movie->title }}</li>--}}
{{--                @empty--}}
{{--                    <p>Keine Filme vorhanden</p>--}}
{{--                @endforelse--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
@endsection
