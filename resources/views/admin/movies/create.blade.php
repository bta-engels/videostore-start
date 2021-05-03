@extends('layouts.default')
@section('title','Create Movie')
@section('header','Create Movie')

@section('content')
    <x-form :action="route('movies.store')" enctype="multipart/form-data">
        <x-form-select name="author_id" label="Autor" :options="$auhtors" />
        <x-form-input name="title" label="Titel" />
        <x-form-input name="price" label="Preis" />
        <x-form-input type="file" name="image" label="Bild" />
        <x-form-submit>
            <span>Movie anlegen</span>
        </x-form-submit>
    </x-form>
@endsection
