@extends('layouts.default')
@section('title',__('Create Todo'))
@section('header',__('Create Todo'))

@section('content')
    <x-form :action="route('todos.store')">
        <x-form-input name="text" label="Beschreibung" />
        <x-form-checkbox name="done" label="Done?" />
        <x-form-submit>
            <span>Todo anlegen</span>
        </x-form-submit>
    </x-form>
@endsection
