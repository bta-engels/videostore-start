@extends('layouts.default')

@section('title','Movies')
@section('header','Movies')

@section('content')
    <div class="m-0">
        <a role="button" class="btn btn-primary" href="{{ route('movies.create') }}">
            <i class="fas fa-plus-square"></i>Create new Movie</a>
        <div class="float-right row mr-3">
            <div class="d-inline">
                <x-form :action="route('movies')" class="row">
                    <x-form-select class="col-auto" name="selectedAuthor" :options="$authorOptions" :default="$selectedAuthor" />
                    <x-form-submit class="col-auto btn btn-sm btn-primary p-2 ml-1 h-100">
                        <span>OK</span>
                    </x-form-submit>
                </x-form>
            </div>
        </div>
    </div>
    <div class="mt-3">

        {{ $data->links() }}

        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Autor</th>
                <th>Titel</th>
                <th>Preis</th>
                <th><br></th>
            </tr>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->author }}</td>
                    <td><a href="{{ route('movies.show', ['movie' => $item->id]) }}">
                            {{ $item->title }}</a></td>
                    <td>{{ $item->price }} €</td>
                    <td class="float-right">
                        <a role="button" class="btn-sm btn-primary"
                           href="{{ route('movies.edit', ['movie' => $item->id]) }}"><i class="fas fa-edit"></i>Edit</a>
                        <a role="button" class="btn-sm btn-danger"
                           onclick="return confirm('Datensatz wirklich löschen?')"
                           href="{{ route('movies.destroy', ['movie' => $item->id]) }}"><i class="fas fa-trash-alt"></i>Löschen</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

