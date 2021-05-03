@extends('layouts.default')
@section('title','Edit Movie')
@section('header','Edit Movie')

@section('content')
    <x-form :action="route('movies.update', ['movie' => $movie->id])">
    @bind($movie)
        <x-form-select name="author_id" label="Autor" :options="$authors" />
        <x-form-input name="title" label="Titel" />
        <x-form-input name="price" label="Preis" />
        <x-form-input type="file" name="image" label="Bild" />
        <x-form-submit>
            <span>Movie speichern</span>
        </x-form-submit>
    @endbind
    </x-form>
@endsection
