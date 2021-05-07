@extends('layouts.default')
@section('title',__('Edit Todo'))
@section('header',__('Edit Todo'))

@section('content')
    <x-form :action="route('todos.update', ['todo' => $todo->id])">
    @bind($todo)
        <x-form-input name="text" label="Beschreibung" :bind="$todo->trans ?? $todo" />
        <x-form-checkbox name="done" label="Done?" />
        <x-form-submit>
            <span>Todo speichern</span>
        </x-form-submit>
    @endbind
    </x-form>
@endsection
