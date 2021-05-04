@extends('layouts.default')
@section('title','Edit Author')
@section('header','Edit Author')

@section('content')
    <x-form :action="route('authors.update', ['author' => $author->id])">
    @bind($author)
        <x-form-input name="firstname" label="Vorname" />
        <x-form-input name="lastname" label="Nachname" />
        <x-form-submit>
            <span>Autor speichern</span>
        </x-form-submit>
    @endbind
    </x-form>
@endsection
