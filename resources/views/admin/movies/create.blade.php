@extends('layouts.default')
@section('title','Create Movie')
@section('header','Create Movie')

@section('content')
    <x-form :action="route('movies.store')" enctype="multipart/form-data">

        <x-form-select name="author_id" :options="$authors" label="Autor" />
        <x-form-input name="title" label="Titel" />
        <x-form-input type="number" step="0.01" name="price" label="Preis" />

        <x-form-input type="file" name="image" label="Bild" />

        <x-form-submit>
            <span>Create Movie</span>
        </x-form-submit>
    </x-form>
@endsection
