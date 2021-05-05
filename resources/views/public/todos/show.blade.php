@extends('layouts.default')

@section('title',__('Todos'))
@section('header',__('Todos'))

@section('content')
    <div class="align-content-center">
        <h5>{{ $todo->id }} {{ $todo }}</h5>
        @if($todo->done)
            <h6>DONE</h6>
        @else
            <h6>NOT DONE</h6>
        @endif
        <p>Erstellt: {{ $todo->created_at->format('d.m.Y H:i') }} Uhr</p>
        <p>Aktualisert: {{ $todo->updated_at->format('d.m.Y H:i') }} Uhr</p>
    </div>
@endsection
