@extends('layouts.default')

@section('title', __('Todo'))
@section('header', __('Todo'))

@section('content')
    <div class="align-content-center">
        <h5>{{ $todo->text }}</h5>
    </div>
@endsection
