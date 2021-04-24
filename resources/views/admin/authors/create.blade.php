@extends('layouts.default')
@section('title','Create Author')
@section('header','Create Author')

@section('content')
    <x-form :action="route('authors.store')">
        <x-form-input name="firstname" label="Vorname" />
        <x-form-input name="lastname" label="Nachname" />
        <x-form-submit>
            <span>Autor anlegen</span>
        </x-form-submit>
    </x-form>
@endsection
