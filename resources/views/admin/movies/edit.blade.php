@extends('layouts.default')
@section('title','Edit Movie')
@section('header','Edit Movie')

@section('content')
    <x-form :action="route('movies.update', ['movie' => $movie->id])" enctype="multipart/form-data">
    @bind($movie)
        <x-form-select name="author_id" label="Autor" :options="$authorOptions" />
        <x-form-input name="title" label="Titel" :bind="$movie->lang" />
        <x-form-input name="price" label="Preis" />
        <x-form-input type="file" name="image" label="Bild" />
        <x-form-submit>
            <span>Update Movie</span>
        </x-form-submit>
    @endbind
    </x-form>
@endsection
